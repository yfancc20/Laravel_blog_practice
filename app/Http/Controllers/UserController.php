<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class UserController extends Controller
{
    /* constructor: check authentication */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /* Show the setting default page */
    public function showSetting($username) 
    {
        // show basic setting
        return $this->setPersonal($username);
    }


    public function setPersonal($username)
    {
        // get user's id
        $userId = Auth::user()->id;

        // get user's information
        $users = DB::table('users')
                            ->where('id', $userId)
                            ->select('username', 'email')
                            ->get();

        return view('setting.personal')->with([
                                        'user' => $users[0]]);
    }


    // update personal data
    public function updatePersonal(Request $request, $username)
    {
        // get user's id
        $userId = Auth::user()->id;

        // get inputs from the form
        $input = $request->only('username', 'password_o', 'password_n', 'password_c');

        $userCount = DB::table('users')->where([
                                            ['username', '=', $input['username']],
                                            ['id', '!=', $userId]])
                                       ->count();
        // cannout use this username
        if ($userCount > 0) {
            $message = "該名稱已有人使用";
            return back()->withErrors([$message]);
        }

        if ($input['password_o'] != "") {
            if ($input['password_n'] == "" || $input['password_c'] == "") {
                $message = "密碼欄位不得為空";
                return back()->withErrors([$message]);
            }

            $passHashed = DB::table('users')
                                    ->where('id', $userId)
                                    ->value('password');
            // original password is wrong
            if (!Hash::check($input['password_o'], $passHashed)) {
                $message = "原密碼輸入錯誤";
                return back()->withErrors([$message]);
            }

            // new password typing woring
            if ($input['password_n'] != $input['password_c']) {
                $message = "確認密碼不相符";
                return back()->withErrors([$message]);
            }
        }
        
        // success, update information
        // do not change the password
        if ($input['password_o'] == "") {
            DB::table('users')->where('id', $userId)
                              ->update(['username' => $input['username']]);
        } else {
            DB::table('users')->where('id', $userId)
                              ->update([
                                    'username' => $input['username'],
                                    'password' => Hash::make($input['password_n'])]);
        }

        return back();
    }
}
