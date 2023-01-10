<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
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

    public function profile()
    {
        return view('profile');
    }

    public function about()
    {
        return view('profile.about');
    }

    public function gallery()
    {
        return view('profile.gallery');
    }

    public function blog()
    {
        return view('profile.blog');
    }

    public function vrsp()
    {
        return view('profile.vrsp');
    }

    public function contact()
    {
        return view('profile.contact');
    }

    public function story()
    {
        return view('profile.story');
    }

    public function landing()
    {
        return view('profile.langding');
    }
}
