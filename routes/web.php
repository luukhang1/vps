<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['check.auth']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
});
//Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/login', 'HomeController@login')->name('home.login');
Route::get('/register', 'HomeController@register')->name('home.register');
Route::post('/register', 'LoginController@register')->name('register');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/admin', 'Admin\HomeController@index')->name('admin.home.index');
Route::post('/subscribe', '\App\Http\Controllers\SubscriberController@subscribe')->name('admin.home.send-mail');
