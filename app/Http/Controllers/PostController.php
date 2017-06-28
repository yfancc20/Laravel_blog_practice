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
}
