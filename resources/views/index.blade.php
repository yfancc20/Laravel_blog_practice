@extends('main')

@section('container')
    <div class="row text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <h1>歡迎來到 Mos Blogger</h1>
            <h4>還未擁有帳戶？</h4>
            <button class="btn btn-info" onclick="location.href='{{ route('register') }}'">註冊去</button>
            <h4>已有帳戶？</h4>
            <button class="btn btn-info" onclick="location.href='{{ route('login') }}'">登入去</button>
        </div>
    </div>
@stop