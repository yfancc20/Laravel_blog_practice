<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Posts;
use App\Blogs;


class PostController extends Controller
{

    protected $pageSplit = 10;

    /* Show a post page */
    public function newPost(User $user) 
    {
        $post = Posts::getNewPost();

        // two types of route in newpost.blade.php
        $route = route('send_post', ['username' => $user->username]);
        $routeDelete = "";

        return view('/newpost')->with([
                                    'post' => $post,
                                    'route' => $route,
                                    'routeDelete' => $routeDelete ]);
    }

    /* Send a post from the form */
    public function sendPost(Request $request, User $user) 
    {
        $post = new Posts;
        $post->storePost($request);

        return redirect()->route('home', ['username' => $user->username]);
    }


    /* edit the post */
    public function editPost(Request $request, User $user)
    {
        $post = Posts::getPostInfo($request);

        // two types of route in editpost.blade.php
        $route = route('update_post', [
                            'username' => $user->username,
                            'post_id' => $post->id, 
                            'u_id' => Auth::user()->id ]);
        $routeDelete = route('delete_post', [
                            'username' => $user->username,
                            'post_id' => $post->id, 
                            'u_id' => Auth::user()->id ]);

        return view('editpost')->with([
                                    'post' => $post,
                                    'route' => $route,
                                    'routeDelete' => $routeDelete ]);
    }


    /* update the post */
    public function updatePost(Request $request, User $user)
    {
        $post = new Posts;
        $url = $post->updatePost($request); // with type 2, update

        $redirectTo = "/" . $user->username . "/$url";

        return redirect($redirectTo);
    }


    /* delete the post */
    public function deletePost(Request $request, User $user)
    {
        $post = new Posts;
        $post->removePost($request);

        $redirectTo = "/" . $user->username;

        return redirect($redirectTo);

    }


    /* show the list of posts */
    public function postlist(User $user, $page = 1)
    {
        // some variables
        $userId = $user->id;
        $split = 10; // how many posts per page
        $blog = new Blogs();

        // get total page and posts of the page (1st page)
        $pageTotal = Posts::getPageTotal($userId, $split);
        $pagePosts = Posts::getPagePosts($userId, $page, $split);
        $blogInfo = $blog->getBlogInfo($userId);

        return view('postlist')->with([
                                    'username' => $user->username,
                                    'posts' => $pagePosts,
                                    'page' => $page,
                                    'pageTotal' => $pageTotal,
                                    'blog' => $blogInfo ]);

    }


    /* show the post */
    public function showPost(Request $request, User $user, $url)
    {
        $blog = new Blogs();
        // get this post's information
        $post = Posts::getPostInfo($request, $url);
        $blogInfo = $blog->getBlogInfo($user->id);

        return view('post')->with([
                                'username' => $user->username,
                                'post' => $post,
                                'blog' => $blogInfo ]);

    }

}
