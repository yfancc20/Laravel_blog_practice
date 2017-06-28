@extends('main')

@section('css-field')
    <style type="text/css">
        .area-edit {
            margin-bottom: 50px;
        }
    </style>
@stop

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">發表新文章</h2>
            <div class="area-edit">
                <form role="form" method="POST" action="/<?=Auth::user()->username;?>/newpost">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="posttitle"><h4>文章標題</h4></label>
                        <input type="text" id="post_title" name="post_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="post_content"><h4>文章內容</h4></label>
                        <textarea id="post_content" name="post_content" class="form-control" rows="20"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
