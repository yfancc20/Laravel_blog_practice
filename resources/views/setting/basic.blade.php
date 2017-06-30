@extends('setting.default_set')

@section('setting-title')
    設定 - 基本設定
@stop

@section('setting-area')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('update_basic', ['username' => Auth::user()->username]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="blog_title" class="col-sm-2 control-label">Blog 名稱</label>
            <div class="col-sm-5">
                <input type="text" id="blog_title" name="blog_title" class="form-control" value="{{ $blog->title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="blog_desc" class="col-sm-2 control-label">Blog 描述</label>
            <div class="col-sm-10">
                <input type="text" id="blog_desc" name="blog_desc" class="form-control" value="{{ $blog->desc }}">
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="col-sm-2 control-label">作者名稱</label>
            <div class="col-sm-5">
                <input type="text" id="author" name="author" class="form-control" value="{{ Auth::user()->username }}" disabled>
            </div>
            <span class="small"><mark>（目前作者名均與使用者名稱相同）</mark></span>
        </div>
        <div class="form-group">
            <label for="a_title" class="col-sm-2 control-label">個人簡介標題</label>
            <div class="col-sm-5">
                <input type="text" id="a_title" name="a_title" class="form-control" value="{{ $blog->a_title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="a_content" class="col-sm-2 control-label">個人簡介</label>
            <div class="col-sm-5">
                <textarea id="a_content" name="a_content" class="form-control" rows="5">{{ $blog->a_content }}</textarea>
            </div>
        </div>
        <table class="table"><th></th></table>
        @if($errors->any())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <span style="color:red">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
                <button type="submit" class="btn btn-primary">儲存設定</button>
            </div>
        </div>
    </form>
@stop