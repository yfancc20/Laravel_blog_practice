@extends('main')

@section('css-field')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    <style type="text/css">
        .area-edit {
            margin-bottom: 50px;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop

@section('container')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">
                @section('page-title')
                    發表新文章
                @show     
            </h2>
            <div class="area-edit">
                <form role="form" method="POST" action="{{ $route }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="post_title"><h4>文章標題</h4></label>
                        <input type="text" id="post_title" name="post_title" class="form-control" value="{{ $post->title }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="post_content"><h4>文章內容</h4></label>
                        <textarea id="post_content" name="post_content" class="form-control" rows="20">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="post_date"><h4>發布日期</h4></label>
                        <input type="text" id="post_date" name="post_date" class="form-control" style="width:auto" value="{{ $post->createDate }}">
                    </div>
                    <div class="form-group">
                        <label for="update_date"><h4>更新日期</h4></label>
                        <input type="text" id="update_date" name="update_date" class="form-control" style="width:auto" value="{{ $post->updateDate }}">
                    </div>
                    <div class="form-group">
                        <label for="author"><h4>作者</h4></label>
                        <input type="text" id="author" name="author" class="form-control" style="width:auto" value="{{ Auth::user()->username }}" disabled>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
                <form role="form" method="POST" action="{{ $routeDelete }}">
                    {{ csrf_field() }}
                    @yield('delete-button')
                </form>
            </div>
        </div>
    </div>
@stop

@section('js-field')
    <script type="text/javascript">
        $(function() {
            var postDate = new Date("{{ $post->createDate }}");
            $('#post_date').datepicker({ 
                dateFormat: 'yy-mm-dd',
                defaultDate: postDate
            });

            var updateDate = new Date("{{ $post->updateDate }}");
            $('#update_date').datepicker({ 
                dateFormat: 'yy-mm-dd',
                defaultDate: updateDate
            });
        });
    </script>
@stop