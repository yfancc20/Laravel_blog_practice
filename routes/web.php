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


Route::get('/', 'HomeController@index')->name('index');

// login, logout, password/email, password/reset, register
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

// user's homepage
Route::prefix('{user}')->group(function () {  
    Route::get('/', 'HomeController@userHome')->name('home');
    Route::get('page_{page}', 'HomeController@userHome')->where('page', '[0-9]+')
                                                        ->name('page_post');
    Route::get('postlist', 'PostController@postlist');
    Route::get('postlist/page_{page}', 'PostController@postlist')->where('page', '[0-9]+')
                                                                 ->name('page_postlist');

    Route::get('{url}', 'PostController@showPost')
                                                ->where('url', '[0-9]+')
                                                ->name('show_post');

    // these actions need auth and username corresponding.
    Route::middleware(['auth', 'auth.username'])->group(function () {
        // about posts
        Route::get('newpost', 'PostController@newPost');
        Route::post('newpost', 'PostController@sendPost')->name('send_post');
        Route::post('editpost', 'PostController@editPost')->name('edit_post');
        Route::post('updatepost', 'PostController@updatePost')->name('update_post');
        Route::post('deletepost', 'PostController@deletePost')->name('delete_post');

        // about setting
        Route::prefix('setting')->group(function () {
            Route::get('/', 'UserController@showSetting');
            Route::get('personal', 'UserController@setPersonal');
            Route::get('basic', 'UserController@setBasic');
            Route::post('updatePersonal', 'UserController@updatePersonal')->name('update_personal');
            Route::post('updateBasic', 'UserController@updateBasic')->name('update_basic');
        });
    });
});
