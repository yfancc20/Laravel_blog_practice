<?php
    $routeName = Route::currentRouteName();
?>

<div class="blog-masthead" style="margin-bottom:50px">
    <div class="container">
        <div class="row">
            <nav class="blog-nav col-sm-12">
                <div class="col-sm-5 col-sm-offset-1">
                    <a id="nav-home" class="blog-nav-item" href="{{ route('home', ['username' => $username]) }}">Home</a>

                    @if ($username != null)
                        <a id="nav-newpost" class="blog-nav-item" href="/{{ $username }}/postlist">Post List</a>
                    @endif

                </div>
                <div class="col-sm-6 text-right">
                    @if (Auth::check())
                        <a id="nav-myHome" class="blog-nav-item" href="/{{ Auth::user()->username }}">MyHome</a>
                        <a id="nav-newpost" class="blog-nav-item" href="/{{ Auth::user()->username }}/newpost">New Posts</a>
                        <a id="nav-setting" class="blog-nav-item" href="/{{ Auth::user()->username }}/setting">Setting</a>
                        <a class="blog-nav-item" href="{{ route('logout') }}">Logout</a>
                    @endif
                    @unless (Auth::check())
                        <a id="nav-login" class="blog-nav-item" href="/login">Login</a>
                        <a id="nav-register" class="blog-nav-item" href="/register">Register</a>
                    @endunless
                </div>
            </nav>
        </div>
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
