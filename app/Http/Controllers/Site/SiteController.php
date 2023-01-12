<?php

namespace App\Http\Controllers\Site;

use App\ConfigPrice;
use App\Http\Controllers\Controller;
use App\Link;
use App\Money;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $domain = $request->get('id');
        $link = Link::query()->where('slug', trim($domain))->first();
        return view('site.get-link')->with(['link' => $link]);
    }

    public function getLink(Request $request)
    {
        $domain = $request->get('id');
        $link = Link::query()->where('slug', trim($domain))->first();
        return view('site.get-link-add')->with(['link' => $link]);
    }

    public function getViewFile(Request $request)
    {
        $checkUrl = $request->get('check-url');
        $domain = $request->get('id');
        $link = Link::query()->where('slug', $domain)->first();
        if (!isset($checkUrl) || empty($link)) {
            return redirect()->route('home.index');
        }
        return view('site.get-file')->with(['link'=> $link]);
    }

    public function submit(Request $request)
    {
        try {
            DB::beginTransaction();
            $ip = $request->ip();
            $slug = $request->get('id');
            $link = Link::query()->where('slug', $slug)->first();
            if ( empty($link)) {
                return false;
            }
            if (!Cache::has('ip_connect_'.trim($ip).$link->user_id)) {
                $now = Carbon::now();
                $target = Carbon::today()->setTime(23, 59, 59);
                $minute = $now->diffInMinutes($target);
                Cache::put('ip_connect_'.trim($ip).$link->user_id, 'has_ip_user',now()->addMinutes($minute));
                $config = ConfigPrice::query()->where('user_id', $link->user_id)
                            ->where('status', 1)
                            ->first();
                if (empty($config)) return ['message' => 'loi roi'];
                $money = Money::query()->where('user_id', $link->user_id)
                                ->where('status', 1)
                                ->first();
                $data = [
                    'user_id' => $link->user_id,
                    'status' => 1,
                    'view' => 1,
                    'price' => $config->config_price
                ];
                if (empty($money)) {
                    $mm = Money::query()->create($data);
                    DB::commit();
                    return $mm;
                }
                $money->view += $money->view;
                $money->save();
            }
            DB::commit();
            return ['hello babe' => "hehe"];
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return ['message' => 'loi'];
        }
    }
}
