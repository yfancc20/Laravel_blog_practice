<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class PostController extends Controller
{
    /* Show a post page */
    public function newPost($username) 
    {
        // check user
        if (Auth::user()->username == $username) {
            return view('/newpost');
        }
    }

    /* Send a post from the form */
    public function sendPost(Request $request, $username) 
    {
        // check user
        if (Auth::user()->username == $username) {
            // get user's id
            $userId = Auth::user()->id;

            // get current time
            $now = date('Y-m-d H:i:s');

            // get inputs from the form
            $input = $request->only('post_title', 'post_content');

            $url = date('Ymd') * 7 . date('His') * 12;

            DB::table('posts')->insert([
                'u_id' => $userId,
                'title' => $input['post_title'], 
                'content' => $input['post_content'],
                'created_at' => $now,
                'updated_at' => $now,
                'url' => $url
            ]);

            return redirect()->route('home', ['username' => $username]);
        }
    }


    /* show the list of posts */
    public function postlist($username)
    {
        // get user id
        $userId = DB::table('users')->where('username', $username)->value('id');

        // wrong page
        if ($userId === null || $username == null) {
            // return view('error_page')
        }

        // can edit the lists or not
        $admin = false;
        if ($userId == Auth::user()->id) {
            $admin = true;
        }

        $posts = DB::table('posts')
                    ->join('users', 'posts.u_id', '=', 'users.id')
                    ->where('posts.u_id', '=', $userId)
                    ->select('posts.*', 'users.username')
                    ->orderBy('posts.created_at', 'desc')
                    ->get();

        return view('postlist')->with([
                                    'posts' => $posts,
                                    'admin' => $admin]);

    }
}
