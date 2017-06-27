<?php
    $routeName = Route::currentRouteName();
?>

<div class="blog-masthead" style="margin-bottom:50px">
    <div class="container">
        <nav class="blog-nav">
            <a id="nav-home" class="blog-nav-item" href="#">Home</a>
            <a id="nav-festure" class="blog-nav-item" href="#">New features</a>
            <a id="nav-press" class="blog-nav-item" href="#">Press</a>
            @unless (Auth::check())
                <a id="nav-login" class="blog-nav-item" href="/login">Login</a>
                <a id="nav-register" class="blog-nav-item" href="/register">Register</a>
            @endunless
            @if (Auth::check())
                <a class="blog-nav-item" href="/logout">Logout</a>
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
