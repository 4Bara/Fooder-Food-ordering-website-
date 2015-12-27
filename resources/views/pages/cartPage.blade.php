@extends('layouts.default')
@section('style')
    <script src="{{URL::asset('../public/javascript/cart.js')}}"></script>
    <style>
        .title{
            text-align: center;
            font-size:xx-large;
        }
        .cart-content{
            background-color:darkgray;
            color:white;
        }
        .restaurant #restaurant_name{
            background-color:indianred;
        }
        .restaurant {
            background-color:whitesmoke;
            color:black;
        }
        .item_qty{
            width:10%;
        }
        .row{
            margin:0px;
        }
        .tax{
            background-color:gray;
            color:whitesmoke;
            font-size:15pt;
        }
        .final-price{
            font-size:20pt;
        }
        .delete_button{
            color:white;
            border-radius: 30px;;
            border:white 2px solid;
            background-color: red;
        }
        #checkout-button{
            color:blue;
            border:1px solid white;;
            font-size: 25pt;
            text-align: center;
            width:100%;
        }
        .empty-message{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4 title">
            My Cart
        </div>
        <div class="col-md-4">

        </div>
    </div>
    <div class="row cart-content">
        <div class="col-md-3"></div>
        <div class="col-md-6 cart-content">
            @if(isset($cartData['restaurants']))
                @foreach($cartData['restaurants'] as $sRestaurant=>$aItems)
                        <div class="row restaurant">
                            <p id="restaurant_name">Restaurant Name : {{$sRestaurant}}</p>
                                @foreach($aItems as $aItem)
                                    <div class="row item">
                                            <input type="hidden" class="id_item" value="{{$aItem['idItem']}}"/>
                                             <div class="col-md-4">
                                                 <p>Meal Name:{{$aItem['name']}}</p>
                                             </div>
                                             <div class="col-xs-2">
                                                 <div class="item_qty">
                                                     <input type="hidden" value="{{$aItem['amount']}}"/>
                                                    <p>QTY:{{$aItem['amount']}}</p>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                 <div class="spicy">
                                                     <input type="hidden" value="{{$aItem['spicy']}}"/>
                                                     <p>spicy:{{$aItem['spicy']}}</p>
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                <p>Total Price :{{$aItem['total_price']}}$</p>
                                             </div>
                                             <div class="delete-button">
                                                <button class="delete_button"><span class="glyphicon glyphicon-remove"></span></button>
                                             </div>
                                    </div>
                                @endforeach
                        </div>
                @endforeach
                    <div class="row">
                        <div class="tax">
                            <p>Tax:{{$cartData['tax']}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tax">
                            <p>Price Before Tax:{{$cartData['total_price_with_out_tax']}}$</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" final-price tax">
                            <p>Total price:{{$cartData['total_price_with_tax']}}$</p>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="checkout-button">
                            <button id="checkout-button">Checkout!</button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                @else
                <div class="empty-message">
                    <h3>There's no items in the cart!</h3>
                </div>
                @endif
        </div>
        </div>
        <div class="col-md-3"></div>

    </div>
@endsection