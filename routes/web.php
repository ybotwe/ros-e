<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/mission', function () {
    return view('mission');
});

Route::get('/news', function () {
    return view('news', [
        'articles' => App\Article::take(3)->latest()->get()
    ]);
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/news/{article}', 'ArticlesController@show');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)');