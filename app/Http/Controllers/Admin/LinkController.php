<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Link;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{

    public function createLink() {
        return view('user.link.create-link');
    }

    public function createLinkAjax(Request  $request) {
        try {
            if(!$request->ajax()){
                throw new \Exception('error');
            }
            $data = $request->all();
            $dataInsert = [
                'user_id' => intval($data['user_id']),
                'linkfile' => $data['linkfile'],
                'linkyoutube' => $data['linkyoutube'],
                'title' => time(),
                'slug' => SlugService::createSlug(Link::class, 'slug', time())
            ];
            Link::query()->create($dataInsert);
            return response()->json([
                'status' => 'success',
                'message' => 'success',
                'data' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'cocainit',
                'data' => []
            ], 500);
        }

    }
    public function getLinks(Request $request)
    {
        $user_id = $request->get('user_id');
        $links = Link::query()->where('user_id',$user_id)->paginate(10);
        return view('site.link')->with(['links' => $links]);
    }

}
