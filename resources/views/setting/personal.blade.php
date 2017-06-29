@extends('setting.default_set')

@section('setting-title')
    設定 - 個人資料
@stop

@section('setting-area')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('update_personal', ['username' => Auth::user()->username]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">使用者名稱</label>
            <div class="col-sm-5">
                <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="col-sm-2 control-label">作者名稱</label>
            <div class="col-sm-5">
                <input type="text" id="author" name="author" class="form-control" value="{{ $user->username }}" disabled>
            </div>
            <span class="small"><mark>（目前作者名均與使用者名稱相同）</mark></span>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="password_o" class="col-sm-2 control-label">原密碼</label>
            <div class="col-sm-5">
                <input type="password" id="password_o" name="password_o" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password_n" class="col-sm-2 control-label">新密碼</label>
            <div class="col-sm-5">
                <input type="password" id="password_n" name="password_n" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password_c" class="col-sm-2 control-label">再次輸入密碼</label>
            <div class="col-sm-5">
                <input type="password" id="password_c" name="password_c" class="form-control">
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