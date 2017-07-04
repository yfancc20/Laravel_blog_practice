{{-- 
Variable passing here:
    $post (stdClass)
    $username (string)
    $page (int)
    $pageTotal (int)
 --}}
 <?
    $nextPage = "/$username" . "/page_" . ($page + 1);
    if ($page - 1 == 1) {
        $prevPage = "/$username";
    } else {
        $prevPage = "/$username" . "/page_" . ($page - 1);
    }
 ?>

@extends('main')

@section('container')

    @include('layouts.title')
    <div class="row">
        <div class="col-sm-8 blog-main">

             @for ($i = 0; $i < count($post); $i++)
                <div class="blog-post-home">
                    <h3>{{ $post[$i]->title }}</h3>
                    <div class="blog-post-content col-sm-6"> 
                        {!! nl2br($post[$i]->content) !!}
                    </div>
                    <div class="col-sm-2 blog-post-read">
                        <a href="{{ route('show_post', [
                                                    'username' => $username, 
                                                    'url' => $post[$i]->url ]) }}" 
                            style="text-decoration: none">
                            ・・⋯⋯
                        </a>
                    </div>
                    <p class="blog-post-meta col-sm-4">{{ $post[$i]->create_time }} By <a href="/{{ $username }}">{{ $username }}</a></p>
                    
                </div>
            @endfor

            @if ($pageTotal > 1)
                <nav>
                    <ul class="pager">
                        @if ($page == 1)
                            <li><a href="#" class="btn btn-xs disabled">Newer</a></li>
                            <li><a href="{{ $nextPage }}" class="btn btn-xs">Older</a></li>   
                        @elseif ($page == $pageTotal)
                            <li><a href="{{ $prevPage }}" class="btn btn-xs">Newer</a></li>
                            <li><a href="#" class="btn btn-xs disabled">Older</a></li>
                        @else
                            <li><a href="{{ $prevPage }}" class="btn btn-xs">Newer</a></li>
                            <li><a href="{{ $nextPage }}" class="btn btn-xs">Older</a></li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            @include('layouts.aboutme')
        </div>

    </div>
@stop

