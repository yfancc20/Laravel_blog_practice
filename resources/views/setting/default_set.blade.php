@extends('main')

@section('container')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="col-sm-2">
                <ul class="nav nav-pills nav-stacked text-center setting-nav">
                    <li role="presentation"><a href="#">基本設定</a></li>
                    <li role="presentation"><a href="#">文章設定</a></li>
                    <li role="presentation"><a href="#">個人資料</a></li>
                </ul>
            </div>
            <div class="col-sm-10">
                <div class="setting-area">
                    <table class="table">
                        <thead><th><h3>
                            @section('setting-title')
                                設定 - 
                            @show
                        </h3></th></thead>
                    </table>
                    @yield('setting-area')
                </div>
            </div>
        </div>
    </div>
@stop