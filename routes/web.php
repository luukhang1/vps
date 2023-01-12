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
    Route::get('/admin', 'Admin\HomeController@index')->name('admin.home.index');
    Route::get('/admin/config', 'Admin\HomeController@configPrice')->name('admin.home.config');
    Route::get('/profile', 'HomeController@profile')->name('home.profile');
    Route::get('/profile/about', 'HomeController@about')->name('profile.about');
    Route::get('/profile/gallery', 'HomeController@gallery')->name('profile.gallery');
    Route::get('/profile/blog', 'HomeController@blog')->name('profile.blog');
    Route::get('/profile/vrsp', 'HomeController@vrsp')->name('profile.vrsp');
    Route::get('/profile/contact', 'HomeController@contact')->name('profile.contact');
    Route::get('/profile/story', 'HomeController@story')->name('profile.story');
    Route::get('/profile/landing', 'HomeController@landing')->name('profile.landing');
    Route::get('/create-link', 'Admin\LinkController@createLink')->name('user.create-link');
    Route::get('site/all-link', 'Admin\LinkController@getLinks')->name('site.all-link');
    Route::get('/payment-method', 'Admin\PaymentController@getPayment')->name('site.get-payment');
    Route::post('/payemt-method','Admin\PaymentController@addPaymentMethod')->name('site.add-payment');
    Route::post('/payemt-method/edit','Admin\PaymentController@editPaymentMethod')->name('site.edit-payment');
});
Route::get('/', 'HomeController@index')->name('home.index');
//Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/login', 'HomeController@login')->name('home.login');
Route::get('/register', 'HomeController@register')->name('home.register');
Route::post('/register', 'LoginController@register')->name('register');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');
Route::post('/subscribe', '\App\Http\Controllers\SubscriberController@subscribe')->name('admin.home.send-mail');
Route::get('/site/view', 'Site\SiteController@index')->name('site.get-link');
Route::get('/site/view/get-link', 'Site\SiteController@getLink')->name('site.get-link-add');
Route::get('/site/view/get-file', 'Site\SiteController@getViewFile')->name('site.get-file');
Route::post('/site/submit', 'Site\SiteController@submit')->name('site.submit');
