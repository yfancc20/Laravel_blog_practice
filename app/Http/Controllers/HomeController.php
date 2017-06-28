<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
                    ->join('users', 'posts.u_id', '=', 'users.id')
                    ->where('posts.u_id', '=', $userId)
                    ->select('posts.*', 'users.username')
                    ->orderBy('posts.created_at', 'desc')
                    ->get();

        return view('home')->with('posts', $posts);
    }
}
