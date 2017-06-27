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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{username}', function ($username = null) { 

    if ($username == null) {
        return view('main');
    } else {
        return view('home');
    }
});


