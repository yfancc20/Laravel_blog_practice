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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    protected $pageSplit = 4;

    public function index()
    {
        return view('main');
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

        // counte total pages
        $postCount = DB::table('posts')->where('u_id', $userId)->count();
        $pageTotal = ceil($postCount / $this->pageSplit);

        $posts = DB::table('posts')
                    ->where('u_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->offset(0)
                    ->limit($this->pageSplit)
                    ->get();

        // $posts = $posts->chunk(4);
        $post = $posts->toArray();
        $page = 1;

        return view('home')->with([
                                'post' => $post,
                                'username' => $username, 
                                'page' => $page,
                                'pageTotal' => $pageTotal ]);
    }


    /* change the page the post (home) */
    public function pageHome($username, $page)
    {
        // check user exists
        $userId = DB::table('users')->where('username', $username)->value('id');

        if ($userId === null) {
            echo "null person";
        }

        // count offset
        $offset = ($page - 1) * $this->pageSplit;

        // counte total pages
        $postCount = DB::table('posts')->where('u_id', $userId)->count();
        $pageTotal = ceil($postCount / $this->pageSplit);

        $posts = DB::table('posts')
                    ->where('u_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->offset($offset)
                    ->limit($this->pageSplit)
                    ->get();

        // $posts = $posts->chunk(4);
        $post = $posts->toArray();

        return view('home')->with([
                                'post' => $post,
                                'username' => $username,
                                'page' => $page,
                                'pageTotal' => $pageTotal ]);
    }
}
