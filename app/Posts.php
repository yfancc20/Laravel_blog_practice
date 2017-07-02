<?php

namespace App;

use App\Scopes\MarkScope;
use Illuminate\Database\Eloquent\Model;
use stdClass;
use Auth;

class Posts extends Model
{
    
    protected $table = "posts"; // table name
    protected $guarded = [];

    /* "booting" method of the model */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarkScope);
    }


    /* Scopes */
    public function scopeByUserId($query, $userId)
    {
        return $query->where('u_id', $userId);
    }

    public function scopeByPostId($query, $postId)
    {
        return $query->where('id', $postId);
    }

    // post from new to old
    public function scopeNewToOld($query)
    {
        return $query->orderBy('create_time', 'desc')
                     ->orderBy('id', 'desc');
    }

    // which page's posts
    public function scopeWhichPage($query, $page, $split)
    {
        $offset = ($page - 1) * $split;
        return $query->offset($offset)->limit($split);
    }



    /* functions */
    public static function getPageTotal($userId, $split = 4) 
    {
        // default split is four page (for home)
        $postCount = self::byUserId($userId)->count();
        $pageTotal = ceil($postCount / $split);
        return $pageTotal;
    }

    public static function getPagePosts($userId, $page, $split = 4)
    {
        $posts = self::byUserId($userId)->whichPage($page, $split)->newToOld()->get();
        return $posts;
    }

    public static function getNewPost()
    {
        $post = new stdClass();
        $post->id = "";
        $post->title = "";
        $post->content = "";
        $post->create_time = date("Y-m-d");
        $post->update_time = date("Y-m-d");

        return $post;
    }

    public static function getPostInfo($request, $url = "")
    {
        // get inputs from form
        if ($url == "") {
            $input = $request->only('post_id');
            $postId = $input['post_id'];
        } else { // with url
            $url;
            $postId = self::where('url', $url)->value('id');
        }

        // get the post's information
        $post = self::byPostId($postId)->get();
        

        return $post[0];
    }

    // store post, returning url
    public function storePost($request)
    {
        // request inputs
        $input = $request->only('post_title', 'post_content', 'post_date', 'update_date');

        $url = date('Ymd') * rand() - date('Hs'). date('His') * 12;

        $this->u_id = Auth::user()->id;
        $this->title = $input['post_title'];
        $this->content = $input['post_content'];
        $this->create_time = $input['post_date'];
        $this->update_time = $input['update_date'];
        $this->url = $url;

        $this->save();

        return $this->url;
    }

    // update post, returning url
    public function updatePost($request)
    {   
        // request inputs
        $input = $request->only('post_id', 'post_title', 'post_content', 'post_date', 'update_date');
        $postId = $input['post_id'];
        $this->byPostId($postId)->update([
                                    'title' => $input['post_title'],
                                    'content' => $input['post_content'],
                                    'create_time' => $input['post_date'],
                                    'update_time' => $input['update_date']
                                    ]);

        return $this->byPostId($postId)->value('url');
    }

    // delete post
    public function removePost($request)
    {
        $input = $request->only('post_id');
        $postId = $input['post_id'];
        $this->byPostId($postId)->update(['mark' => 1]);
        return $this;
    }
}
