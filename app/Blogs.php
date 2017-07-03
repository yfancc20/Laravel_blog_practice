<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Blogs extends Model
{
    protected $guarded = ['id'];

    public function scopeByUserId($query, $userId)
    {
        return $query->where('u_id', $userId);
    }


    public function getBlogInfo($userId)
    {
        $blog = $this->byUserId($userId)->get();
        return $blog[0];
    }

    public function updateBasic($request)
    {
        $userId = Auth::user()->id;
        $input = $request->only('blog_title', 'blog_desc', 'a_title', 'a_content');

        $this->byUserId($userId)->update([
                                    'title' => $input['blog_title'],
                                    'desc' => $input['blog_desc'],
                                    'a_title' => $input['a_title'],
                                    'a_content' => $input['a_content']
                                    ]);
        return $this;

    }


}
