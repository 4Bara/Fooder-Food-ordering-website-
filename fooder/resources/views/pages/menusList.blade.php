@extends('layouts.default')
@section('style')
@stop
@section('content')
    <div  class="col-lg-12 menus">
        <h1>Menus</h1>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="menus-list">
                @foreach($menus as $menu)
                <div class="col-md-6">
                    <div class="menu-box">
                        <a href="{{asset('/menu?id='.$menu->id_menu)}}">
                        <img id="menu-cover" src="{{$menu->picture}}" />
                        <p id="menu-title">{{$menu->name}}</p>
                        <p id="menu-description">
                           {{$menu->description}}
                        </p>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="row">
                 {!! $menus->render() !!}
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@stop