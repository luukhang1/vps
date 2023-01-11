<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $domain = $request->get('id');
        $link = Link::query()->where('slug', trim($domain))->first();
        return view('site.get-link')->with(['link' => $link]);
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
        $ip = $request->ip();
        $slug = $request->get('id');
        $link = Link::query()->where('slug', $slug)->first();
        if ( empty($link)) {
            return false;
        }
        return ['ip' => $ip];
    }
}
