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
        Route::get('newpost', 'PostController@newPost');
        Route::post('newpost', 'PostController@sendPost')->name('send_post');
        Route::post('editpost', 'PostController@editPost')->name('edit_post');
        Route::post('updatepost', 'PostController@updatePost')->name('update_post');
        Route::post('deletepost', 'PostController@deletePost')->name('delete_post');
    });
});








Route::get('/{username}/setting', 'UserController@showSetting');


Route::post('/{username}/setting/updatePersonal', 'UserController@updatePersonal')
                                                            ->name('update_personal');
Route::post('/{username}/setting/updateBasic', 'UserController@updateBasic')
                                                            ->name('update_basic');
Route::post('/{username}/setting/updatePosts', 'UserController@updatePosts')
                                                            ->name('update_posts');
Route::get('/{username}/setting/personal', 'UserController@setPersonal');
Route::get('/{username}/setting/basic', 'UserController@setBasic');
Route::get('/{username}/setting/posts', 'UserController@setPosts');
