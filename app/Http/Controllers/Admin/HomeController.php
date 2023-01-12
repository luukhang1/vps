<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Money;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $money = Money::query()
                ->where('user_id',$userId)
                ->where('status', 1)
                ->first();
        return view('home')->with(['money' => $money]);
    }

    public function configPrice(Request $request)
    {
        $role = $request->get('role');
        if ($role == 0) return 'Unauthorize';
        return view('adminlte.config');
    }

}
