<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Hash;

class Users extends Model
{

    protected $fillable = [
        'username', 'email', 'password',
    ];

    /* Scopes */
    public function scopeByUserId($query, $userId)
    {
        return $query->where('id', $userId);
    }

    public function scopeByUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    /* Functions */
    public function scopeBasic($query)
    {
        // without password
        return $query->select(['id', 'username', 'email']);
    }


    public function getUserInfo()
    {
        $userId = Auth::user()->id;
        $user = $this->byUserId($userId)->basic()->get();
        return $user[0];
    }

    public function updatePersonal($request)
    {
        $userId = Auth::user()->id;
        $input = $request->only('username', 'password_o', 'password_n', 'password_c');

        if ($input['username'] != Auth::user()->username) {
            $userCount = $this->byUsername($input['username'])->count();

            // cannout use this username
            if ($userCount > 0) {
                $message = "該名稱已有人使用";
                return $message;
            }
        }
        
        if ($input['password_o'] != "") { // have filled: original password
            if ($input['password_n'] == "" || $input['password_c'] == "") {
                $message = "密碼欄位不得為空";
            } else {
                // get hashed value
                $passHashed = $this->byUserId($userId)->value('password');

                
                if (!Hash::check($input['password_o'], $passHashed)) {
                    // original password is wrong
                    $message = "原密碼輸入錯誤";
                } else if ($input['password_n'] != $input['password_c']) {
                    // not corresponding
                    $message = "確認密碼不相符";
                } else { 
                    // success
                    $message = "更新成功！";
                    $this->byUserId($userId)->update([
                                    'username' => $input['username'],
                                    'password' => Hash::make($input['password_n']) ]);
                }
            }
        } else { // haven't filled the password fields: update directly
            $message = "更新成功！";
            $this->byUserId($userId)->update(['username' => $input['username']]);
        }

        return $message;
    }
}
