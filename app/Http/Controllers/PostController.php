<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use stdClass;


class PostController extends Controller
{

    protected $pageSplit = 10;

    /* Show a post page */
    public function newPost($username) 
    {
        // check user
        if (Auth::user()->username == $username) {
            $post = new stdClass();
            $post->id = "";
            $post->title = "";
            $post->content = "";
            $post->createDate = date("Y-m-d");
            $post->updateDate = date("Y-m-d");

            // two types of route in newpost.blade.php
            $route = route('send_post', ['username' => $username]);
            $routeDelete = "";

            return view('/newpost')->with([
                                        'post' => $post,
                                        'route' => $route,
                                        'routeDelete' => $routeDelete ]);
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
            $input = $request->only('post_title', 'post_content', 'post_date', 'update_date');

            $url = date('Ymd') * rand() - date('Hs'). date('His') * 12;

            DB::table('posts')->insert([
                'u_id' => $userId,
                'title' => $input['post_title'], 
                'content' => $input['post_content'],
                'created_at' => $now,
                'updated_at' => $now,
                'create_time' => $input['post_date'],
                'update_time' => $input['update_date'],
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

        // check wrong
        $this->checkWrong($userId, $username);

        // counte total pages
        $postCount = DB::table('posts')->where('u_id', $userId)->count();
        $pageTotal = ceil($postCount / $this->pageSplit);

        $posts = DB::table('posts')
                    ->where('u_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->limit($this->pageSplit)
                    ->get();

        $posts = $posts->toArray();
        $page = 1;

        return view('postlist')->with([
                                    'username' => $username,
                                    'posts' => $posts,
                                    'page' => $page,
                                    'pageTotal' => $pageTotal ]);

    }


    /* show the post */
    public function showPost(Request $request, $username, $url)
    {
        // get user id
        $userId = DB::table('users')->where('username', $username)->value('id');

        // check wrong
        $this->checkWrong($userId, $username);

        // get this post's information
        $post = DB::table('posts')
                    ->where([
                        ['u_id', '=', $userId],
                        ['url', '=', $url]])
                    ->get();

        return view('post')->with([
                                'username' => $username,
                                'post' => $post[0]]);

    }


    /* edit the post */
    public function editPost(Request $request, $username)
    {
        // get inputs from form
        $input = $request->only('post_id', 'u_id');
        
        // get the post's information
        $post = DB::table('posts')
                    ->where([
                        ['id', '=', $input['post_id']],
                        ['u_id', '=', $input['u_id']]])
                    ->get();

        // check wrong
        $this->checkWrong(Auth::user()->id, $username);

        // two types of route in editpost.blade.php
        $route = route('update_post', [
                            'username' => $username,
                            'post_id' => $post[0]->id, 
                            'u_id' => Auth::user()->id ]);
        $routeDelete = route('delete_post', [
                            'username' => $username,
                            'post_id' => $post[0]->id, 
                            'u_id' => Auth::user()->id ]);

        // assign create and update values
        $post[0]->createDate = $post[0]->create_time;
        $post[0]->updateDate = $post[0]->update_time; 

        return view('editpost')->with([
                                    'post' => $post[0],
                                    'route' => $route,
                                    'routeDelete' => $routeDelete ]);
    }


    /* update the post */
    public function updatePost(Request $request, $username)
    {
        // get inputs from form
        $input = $request->only('post_id', 'u_id', 'post_title', 'post_content', 
            'post_date', 'update_date');

        // get user id
        $userId = Auth::user()->id;

        // get current time
        $now = date("Y-m-d H:i:s");
        
        // updating
        DB::table('posts')
            ->where([
                ['id', '=', $input['post_id']],
                ['u_id', '=', $userId] ])
            ->update([
                'title' => $input['post_title'],
                'content' => $input['post_content'],
                'create_time' => $input['post_date'],
                'update_time' => $input['update_date'],
                'updated_at' => $now
                ]);

        // get url
        $url = DB::table('posts')->where('id', $input['post_id'])->value('url');
        $redirectTo = "/$username" . "/$url";

        return redirect($redirectTo);
    }


    /* delete the post */
    public function deletePost(Request $request, $username)
    {
        // get user id
        $userId = DB::table('users')->where('username', $username)->value('id');

        // check wrong
        $this->checkWrong($userId, $username);

        // get inputs from form
        $input = $request->only('post_id', 'u_id');

        $updatedAt = $this->getUpdatedAt();

        // mark the post
        DB::table('posts')
            ->where([
                ['id', '=', $input['post_id']],
                ['u_id', '=', $userId] ])
            ->update([
                'updated_at' => $updatedAt,
                'mark' => 1
                ]);

        $redirectTo = "/$username";

        return redirect($redirectTo);

    }


    /* change the page the post (home) */
    public function pagePostlist($username, $page)
    {
        // check user exists
        $userId = DB::table('users')->where('username', $username)->value('id');

        $this->checkWrong($userId, $username);

        // count offset
        $offset = ($page - 1) * $this->pageSplit;

        // counte total pages
        $postCount = DB::table('posts')->where('u_id', $userId)->count();
        $pageTotal = ceil($postCount / $this->pageSplit);


        $posts = DB::table('posts')
                    ->where('u_id', $userId)
                    ->orderBy('create_time', 'desc')
                    ->offset($offset)
                    ->limit($this->pageSplit)
                    ->get();

        $posts = $posts->toArray();

        return view('postlist')->with([
                                    'username' => $username,
                                    'posts' => $posts,
                                    'page' => $page,
                                    'pageTotal' => $pageTotal ]);

    }


    /* check wrong url */
    private function checkWrong($userId, $username)
    {
        if ($userId === null || $username == null) {
            // return view('error_page')
        }
    }

    private function getUpdatedAt()
    {
        return date("Y-m-d H:i:s");
    }
}
