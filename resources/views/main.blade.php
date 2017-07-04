<?
    // ex: login, register page
    if (!isset($username)) {
        $username = null;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

@yield('css-field')

</head>

<body>
    {{-- need $username, $blog --}}
    @include('layouts.header') 

    <div class="container">
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
        @show
    </div>

    @include('layouts.footer')
</body>

@yield('js-field')

</html>
