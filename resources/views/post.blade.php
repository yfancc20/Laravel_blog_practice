@extends('main')

@section('container')
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $post->title }}</h2>
                <p class="blog-post-meta">
                    {{ $post->create_time }} By <a href="#">{{ $username }}</a>
                </p>
                @if (Auth::check() && $username == Auth::user()->username)
                    <div class="blog-post-meta">
                        <form role="form" method="POST" action="{{ route('edit_post', ['username' => $username]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="u_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn btn-success btn-sm">Edit</button>
                        </form>
                    </div>
                @endif
                <div class="blog-post-content"> 
                    {!! nl2br($post->content) !!}
                </div>
                <p class="blog-post-last">
                    Last modified: {{ $post->update_time }}
                </p>
            </div>
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            @include('layouts.aboutme')
        </div>

    </div>
@stop
