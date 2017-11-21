{{-- 
Varaible passed:
    $posts (Array)
    $page (int)
    $pageTotal (int)
    $username (string)
--}}

<?
    $nextPage = "/$username" . "/postlist/page_" . ($page + 1);
    if ($page - 1 == 1) {
        $prevPage = "/$username" . "/postlist";
    } else {
        $prevPage = "/$username" . "/postlist/page_" . ($page - 1);
    }
?>

@extends('main')

@section('container')
    <div class="row">
        <div class="col-sm-8 blog-main">
            <table class="table table-hover table-postlist">
                <thead>
                    <th colspan="3">
                        <h3 class="text-center">文章列表</h3>
                    </th>
                </thead>
                @for ($i = 0; $i < count($posts); $i++)
                    <tr>
                        <td><a href="{{ route('show_post',[
                                                        'username' => $username,
                                                        'url' => $posts[$i]->url]) }}">
                            {{ $posts[$i]->title }}
                            </a>
                        </td>
                        <td width="20%">{{ $posts[$i]->create_time }}</td>
                        <td width="10%">{{ $username }}</td>
                    </tr>
                @endfor
            </table>

            @if ($pageTotal > 1)
                <nav>
                    <ul class="pager">
                        @if ($page == 1 && $pageTotal == 1)
                            <li><a href="#" class="btn btn-xs disabled">Newer</a></li>
                            <li><a href="#" class="btn btn-xs disabled">Older</a></li>
                        @elseif ($page == 1)
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
