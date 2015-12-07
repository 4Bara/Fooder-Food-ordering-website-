@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/offers.js")}}" ></script>
@stop
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
                    <p>{{$item->healthy}}</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>spicy</h3>
                    <p>{{$item->spicy}}</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>Price</h3>
                    <p>{{$item->price}}</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-count">
                    <h3>Units</h3>
                        <input id="item_qty" class='spinner' style="width:20px" name="item_qty">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="add-to-cart">
                    <h3>(+)</h3>
                    <input type="button" name="add_item_to_cart" id="add-to-cart" value="Add">
                </div>
            </div>
        </div>
        @endforeach
</div>
</div>
@stop
