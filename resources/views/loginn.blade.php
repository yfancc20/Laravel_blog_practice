@extends('main')

@section('css-field')
    <style type="text/css">
        #login-table {
            margin-top: 50px;
        }
        #login-button {
            float: right;
        }
    </style>
@stop

@section('container')
    <div class="col-sm-4 col-sm-offset-4">
        <form method="POST">
            {{ csrf_field() }}
            <table id="login-table" class="table" action="/login">
                <tr><th colspan="2">LOGIN</th></tr>
                <tr>
                    <td style="vertical-align: middle">E-mail</td>
                    <td><input type="text" name="username" class="form-control" required="required"></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle">Password</td>
                    <td><input type="password" name="password" class="form-control" required="required"></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="login-button" type="submit" class="btn btn-default"> Send </button></td>
                </tr>      
            </table>
        </form>
    </div>
@stop
