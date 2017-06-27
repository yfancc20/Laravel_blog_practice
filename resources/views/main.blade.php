<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    @yield('css-field')
</head>

<body>
    @include('layouts.header')

    <div class="container">
        @section('container')
        <div align="center" style="height: 500px">
            <h3>This is main page</h3>
        </div>
        @show
    </div>

    @include('layouts.footer')
</body>

</html>
