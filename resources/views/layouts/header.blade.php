<?php
    $routeName = Route::currentRouteName();
?>

<div class="blog-masthead" style="margin-bottom:50px">
    <div class="container">
        <nav class="blog-nav">
            <a id="nav-home" class="blog-nav-item" href="#">Home</a>
            @unless (Auth::check())
                <a id="nav-login" class="blog-nav-item" href="/login">Login</a>
                <a id="nav-register" class="blog-nav-item" href="/register">Register</a>
            @endunless
            @if (Auth::check())
                <a id="nav-newpost" class="blog-nav-item" href="/<?=Auth::user()->username;?>/newpost">New Posts</a>
                <a id="nav-newpost" class="blog-nav-item" href="/<?=Auth::user()->username;?>/postlist">Post List</a>
                <a class="blog-nav-item" href="{{ route('logout') }}">Logout</a>
            @endif
        </nav>
    </div>
</div>

@section('js-field')
<script type="text/javascript">
    $(document).ready(function() {
        var actualId = "nav-" + "<?=$routeName;?>";
        $("a.blog-nav-item").each(function() {
            var thisId = $(this).attr("id");
            if (actualId == thisId) {
                $(this).addClass("active");
            }

        });
    });
</script>
@stop
