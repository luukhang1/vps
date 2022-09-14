<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
       return view('user.register');
    }

}
