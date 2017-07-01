<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Posts;

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
    public function userHome(User $user, $page = 1)
    {
        // some variables
        $userId = $user->id;
        \Debugbar::info($page);

        // get total page and posts of the page (1st page)
        $pageTotal = Posts::getPageTotal($userId);
        $pagePosts = Posts::getPagePosts($userId, $page);

        return view('home')->with([
                                'post' => $pagePosts,
                                'username' => $user->username, 
                                'page' => $page,
                                'pageTotal' => $pageTotal ]);
    }
}
