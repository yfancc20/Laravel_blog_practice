<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Users;
use App\Blogs;
use Auth;

class UserController extends Controller
{
    /* constructor: check authentication */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /* Show the setting default page */
    public function showSetting(User $user) 
    {
        return $this->setBasic($user);
    }

    /* show basic setting */
    public function setBasic(User $user)
    {
        $userId = Auth::user()->id; // or $user->id
        $blog = new Blogs();
        $blogInfo = $blog->getBlogInfo($userId);

        return view('setting.basic')->with(['blog' => $blogInfo ]);
    }


    /* show personal setting */
    public function setPersonal(User $user)
    {
        $user = new Users();
        $userInfo = $user->getUserInfo();
        return view('setting.personal')->with([
                                        'user' => $userInfo ]);
    }


    // update blog data
    public function updateBasic(Request $request, User $user)
    {
        $blog = new Blogs();
        $blog->updateBasic($request);

        return back();
    }


    // update personal data
    public function updatePersonal(Request $request, User $user)
    {
        $user = new Users();
        $message = $user->updatePersonal($request);

        return back()->withErrors([$message]);
    }






    /* check user name */
    private function checkUser($username1, $username2)
    {
        if ($username1 != $username2) {
            return view('errors.404');
        }

    }
}
