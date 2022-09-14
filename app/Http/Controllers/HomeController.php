<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        Auth::logout();
        return view('user.login');
    }

    public function register()
    {
       return view('user.register');
    }

}
