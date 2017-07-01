<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    
    protected $table = "posts"; // table name
    protected $guarded = [];
    protected static $pageSplit = 4; // how many post per page

    /* Scopes */
    public function scopeByUserId($query, $userId)
    {
        return $query->where('u_id', $userId);
    }

    // post from new to old
    public function scopeNewToOld($query)
    {
        return $query->orderBy('create_time', 'id', 'desc');
    }

    // which page's posts
    public function scopeWhichPage($query, $page)
    {
        $offset = ($page - 1) * self::$pageSplit;
        return $query->offset($offset)->limit(self::$pageSplit);
    }



    /* functions */
    public static function getPageTotal($userId) 
    {
        $postCount = self::byUserId($userId)->count();
        $pageTotal = ceil($postCount / self::$pageSplit);
        return $pageTotal;
    }

    public static function getPagePosts($userId, $page)
    {
        $posts = self::byUserId($userId)->whichPage($page)->newToOld()->get();
        return $posts;
    }
}
