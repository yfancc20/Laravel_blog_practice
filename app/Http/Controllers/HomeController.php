<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Posts;
use App\Blogs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('main');
    }

    /* User's blog's homepage */
    public function userHome(User $user, $page = 1)
    {
        // some variables
        $userId = $user->id;
        $blog = new Blogs();

        // get total page and posts of the page (1st page)
        $pageTotal = Posts::getPageTotal($userId);
        $pagePosts = Posts::getPagePosts($userId, $page);
        $blogInfo = $blog->getBlogInfo($userId);

        return view('home')->with([
                                'post' => $pagePosts,
                                'username' => $user->username, 
                                'page' => $page,
                                'pageTotal' => $pageTotal,
                                'blog' => $blogInfo ]);
    }
}
