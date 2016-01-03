@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/login.js")}}" ></script>
@stop
@section('content')
    <div class="col-md-4">
    </div>
    <div id="login-page" class="col-md-4">

        @if($errors->any())
            <div class="row">
                <div class="col-xs-12">
                    <label class="label-warning" id="error">ERROR:{{$errors->first()}}</label>
                </div>
            </div>
        @endif
        <form name="login-form" class=" white-box form-group " method="post" id="login-form">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            <h1>Login</h1>
            <div class="row">
                <div class="col-xs-6">
                    <label>username:</label>
                </div>
                <div class="col-xs-6">
                    <input class="form-control" type="text" name="username"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                     <label>password:</label>
                </div>
                <div class="col-xs-6">
                    <input class="form-control" type="password" name="password"/>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-success" id="login-button">Login</button>
            </div>
        </form>
    </div>
    </div>
    <div class="col-md-4">
    </div>
@stop