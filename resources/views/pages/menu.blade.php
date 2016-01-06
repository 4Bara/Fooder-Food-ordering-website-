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
    <div class="container">
        <div class="col-md-2">
            </div>
        <div class="col-md-8">
        <div class="row">
        </div>
        <div class="row menu_header">
                <div class="restaurant-name">
                    {{$restaurant->restaurant_name}}
                </div>
                <div class="menu_name">
                    @if($data['page_type']=='menu')
                        <p>{{$menu->name}} Menu</p>
                    @elseif($data['page_type']=='offer')
                        <p>{{$offer->name}} Offer</p>
                    @endif
                </div>
            <div class="col-xs-12">
                @if($data['logged']=='yes')
                    @if($data['page_type']=='menu')
                        <button value="{{$menu->id_menu}}" id="favorite" class="btn btn-danger"><i class="glyphicon glyphicon-heart"></i></button>
                    @elseif($data['page_type']=='offer')
                        <button value="{{$offer->id_offer}}" id="favorite" class="btn btn-danger"><i class="glyphicon glyphicon-heart"></i></button>
                    @endif
                @endif
            </div>
            @if($data['page_type']=='offer')
                <div class="offer_price">
                    <p>Price:${{$offer->price}}</p>
                </div>
            @endif
        </div>
        <div class="items">
            @foreach($items as $item)
            <div class="row item">
                <div class="col-md-2 padding0">
                    <img width="150" style="margin-right:10px;" height="150" src="{{$item->picture}}"/>
                </div>
                <div class="col-md-4 ">
                    <div class="col-md-12">
                        <div class="item-title">
                            <p>{{$item->name}}</p>
                        </div>
                        <div class="item-description">
                            <p>{{$item->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 padding0">
                    <div class="item-healthy ">
                        @if($item->healthy)
                            <p><b>Healthy:</b>YES</p>
                        @else
                            <p><b>Healthy:</b>NO</p>
                        @endif
                    </div>
                        @if($data['page_type']=='menu')
                                <div class="item-spicy">
                                    <p><b>Price:</b>{{$item->price}}$</p>
                                </div>
                        @endif
                    <div class="item-spicy">
                            <b>Spicy:</b>
                            @if($item->spicy == "yes")
                                <select class="spicy">
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            @else
                                <p>
                                    NO
                                </p>
                            @endif
                    </div>
                    @if($data['showUnits'])
                        <div class="item-count">
                               <p><b>QTY:</b></p> <input id="item_qty" class='spinner' style="width:20px" name="item_qty">
                        </div>

                    @endif
                </div>
                <div class="col-md-3">
                    <div id="add-to-cart" class="col-md-5 text-center">
                        <input type="button" name="add_item_to_cart" class="btn add-to-cart" value="Add">
                    </div>
                    <div class="information" style="">
                        <input id="id_item" value="{{$item->id_item}}" />
                        <input id="id_restaurant" value="{{$item->id_restaurant}}"/>
                    </div>
                </div>
                </div>
            @endforeach
            </div>
        </div>
      </div>
    </div>
@stop
