<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /* User's blog's homepage */
    public function userHome($username = null)
    {
        if ($username == null) {
            echo "null!!!";
        } 

        // check user exists
        $userId = DB::table('users')->where('username', $username)->value('id');

        if ($userId === null) {
            echo "null person";
        }

        $posts = DB::table('posts')
                    ->where('u_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->offset(0)
                    ->limit(4)
                    ->get();

        // $posts = $posts->chunk(4);
        $post = $posts->toArray();

        return view('home')->with([
                                'post' => $post,
                                'username' => $username ]);
    }
}
