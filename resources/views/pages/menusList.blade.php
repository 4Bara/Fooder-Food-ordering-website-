@extends('layouts.default')
@section('style')
    <style>
        .menu-box #menu-cover{
           height:250px;
        }
    </style>
@stop
@section('content')
    <div  class="col-lg-12 menus">
        @if(isset($data) && $data['page_type']=="offer")
        <h1>Offers</h1>
        @else
        <h1>Menus</h1>
        @endif
        <div class="col-md-2"></div>
        <div class="col-md-8">

        @if(isset($menus) &&count($menus)==0 && isset($data) && $data['page_type']!='offer')
                <h2>There's no Menus</h2>
            @elseif(isset($menus) && count($menus)==0  && isset($data) && $data['page_type']=='offer')
                <h2>There's no Offers</h2>
            @endif
            <div class="menus-list">
                @foreach($menus as $menu)
                <div class="col-md-6">
                    <div class="menu-box">
                        <div class="row">
                            @if(isset($menu->id_menu))
                                <a href="{{asset('/menu?id='.$menu->id_menu)}}">
                            @elseif(isset($menu->id_offer))
                                <a href="{{asset('/offer?id='.$menu->id_offer)}}">
                            @endif
                            <img id="menu-cover" src="{{$menu->picture}}" />
                        </div>
                        <div class="row">
                            <p id="menu-title">{{$menu->name}}</p>
                        </div>
                        <div class="row">
                            <p id="menu-description">{{$menu->description}}</p>
                        </div>
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