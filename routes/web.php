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
    $pass = array();
    $pass['title'] = "testing!";
    $pass['greeting'] = "Hi!!!!!";
    return view('main', $pass);
});

// login, logout, password/email, password/reset, register
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('index');

Route::get('/{username}', 'UserController@userHome')->name('home');

Route::get('/{username}/newpost', 'PostController@newPost');

Route::post('/{username}/newpost', 'PostController@sendPost')->name('send_post');

Route::post('/{username}/editpost', 'PostController@editPost')->name('edit_post');

Route::post('/{username}/updatepost', 'PostController@updatePost')->name('update_post');

Route::get('/{username}/postlist', 'PostController@postlist');

Route::get('/{username}/{url}', 'PostController@showPost')->name('show_post');


