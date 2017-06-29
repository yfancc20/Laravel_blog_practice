@extends('main')

@section('css-field')
    <style type="text/css">
        .area-edit {
            margin-bottom: 50px;
        }
    </style>
@stop

@section('container')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">
                @if (!isset($post))
                    發表新文章
                    <? 
                        $route = route('send_post', ['username' => Auth::user()->username]);
                        $post = new stdClass();
                        $post->title = "";
                        $post->content = "";
                    ?>
                @else
                    編輯文章
                    <?  
                        $route = route('update_post', [
                                            'username' => Auth::user()->username,
                                            'post_id' => $post->id, 
                                            'u_id' => Auth::user()->id ]);
                        $routeD = route('delete_post', [
                                            'username' => Auth::user()->username,
                                            'post_id' => $post->id, 
                                            'u_id' => Auth::user()->id ]);  
                    ?>
                @endif      
            </h2>
            <div class="area-edit">
                <form role="form" method="POST" action="{{ $route }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="posttitle"><h4>文章標題</h4></label>
                        <input type="text" id="post_title" name="post_title" class="form-control" value="{{ $post->title }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="post_content"><h4>文章內容</h4></label>
                        <textarea id="post_content" name="post_content" class="form-control" rows="20">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
                <form role="form" method="POST" action="{{ $routeD }}">
                    {{ csrf_field() }}
                    @yield('delete-button')
                </form>
            </div>
        </div>
    </div>
@stop
