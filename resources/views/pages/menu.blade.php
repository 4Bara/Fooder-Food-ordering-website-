@extends('layouts.default')
@section('style')
    <style>
        .information{
            display:none;
            visibility: hidden;
        }
    </style>
@stop
@section('script')
    <script src="{{asset("../public/javascript/offers.js")}}" ></script>
@endsection
@section('content')
<div class="col-lg-12 menu-page-container">
    <div class="col-md-9 menu-page">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title">
                    @if($data['page_type']=='menu')
                    <p>{{$menu->name}}</p>
                    @elseif($data['page_type']=='offer')
                        <p>{{$offer->name}}</p>
                    @endif
                </div>
                <button value="{{$menu->id_menu}}" id="favorite" class="btn btn-danger"><i class="glyphicon glyphicon-heart"></i></button>
            </div>
        </div>
        <div class="row">
             <div class="col-xs-4">
                <div class="restaurant-name">
                    {{$restaurant->restaurant_name}}
                </div>
             </div>
             <div class="col-xs-4">

             </div>
            <div class="col-xs-4">
                @if($data['page_type']=='offer')
                    <div class="offer-price">
                        <p>PRICE:123$</p>
                    </div>
                @endif
            </div>
        </div>
        @foreach($items as $item)
        <div class="row item">
            <div class="col-xs-2 ">
                <img id="item-img" src="{{$item->picture}}"/>
            </div>
            <div class="col-xs-2">
                <div class="item-tile">
                    <h3>Name</h3>
                    <p>{{$item->name}}</p>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="item-description">
                    <h3>Description</h3>
                    <p>{{$item->description}}</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-healthy">
                    <h3>Healthy</h3>
                    @if($item->healthy)
                        <p>YES</p>
                    @else
                        <p>NO</p>
                    @endif
                </div>
            </div>
            <div class="item-spicy">
            <div class="col-xs-1">
                    <h3>spicy</h3>
                    @if($item->spicy == "yes")
                        <select class="spicy">
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                    @else
                        <select class="spicy" disabled="disabled">
                            <option value="no" selected>NO</option>
                        </select>
                    @endif
                </div>
            </div>
            @if($data['page_type']=='menu')
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>Price</h3>
                    <p>{{$item->price}}$</p>
                </div>
            </div>
            @endif
            @if($data['showUnits'])
                <div class="item-count">
                    <div class="col-xs-1">
                        <h3>Units</h3>
                        <input id="item_qty" class='spinner' style="width:20px" name="item_qty">
                    </div>
                </div>
                <div id="add-to-cart">
                    <h3>(+)</h3>
                    <input type="button" name="add_item_to_cart" class="add-to-cart" value="Add">
                </div>
                <div class="information" style="">
                    <input id="id_item" value="{{$item->id_item}}" />
                    <input id="id_restaurant" value="{{$item->id_restaurant}}"/>
                </div>
            @endif
        </div>
        @endforeach
        </div>
    </div>
@stop
