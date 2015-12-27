@extends('layouts.default')
@section('style')
    <style>
        .title{
            text-align: center;
            font-size:20pt;
        }
        .info{
            font-size:15pt;
        }
        .order{
            font-size:12pt;
            border:1px solid black;
        }
    </style>
    <script src="{{asset("../public/javascript/order.js")}}" ></script>
@stop

@section('content')
<div  class="col-md-2">

</div>
    <div class="col-md-8">
        <div class="row title">My Orders</div>
        <div class="orders row">
            <div class="row info">
                <div class="col-xs-2">
                    <p>Order id</p>
                </div>
                <div class="col-xs-2">
                    @if($data['isRestaurant'])
                        <p>Customer</p>
                    @else
                        <p>Restaurant Name</p>
                    @endif
                </div>
                @if($data['isRestaurant'])
                <div class="col-xs-2">
                        <p>Mobile #</p>
                </div>
                @endif
                <div class="col-xs-3">
                    <p>Order Status</p>
                </div>
                <div class="col-xs-3">
                    <p>Ordered on</p>
                </div>
            </div>
            @foreach($orders as $aOrder)
                <div class="row order">
                    <div class="col-xs-2">
                        <input type="hidden" class="id_order" value="{{$aOrder['info']->id_order}}"/>
                       {{$aOrder['info']->id_order}}
                    </div>
                    <div class="col-xs-2">
                       {{isset($aOrder['restaurant_name']->restaurant_name)?$aOrder['restaurant_name']->restaurant_name:$aOrder['customer']->first_name.' '.$aOrder['customer']->last_name}}
                    </div>
                    @if($data['isRestaurant'])
                        <div class="col-xs-2">
                            <p>{{$aOrder['customer']->user_mobile}}</p>
                        </div>
                    @endif
                    <div class="col-xs-3">
                        @if($data['isRestaurant'])
                            <select class="order_status">
                                @foreach($data['status'] as $status)
                                    <option @if($aOrder['info']->status==$status) selected @endif value="{{$status}}">{{$status}}</option>
                                    @endforeach
                            </select>
                        @else
                            {{$aOrder['info']->status}}
                        @endif
                    </div>
                    <div class="col-xs-3">
                        <p>{{$aOrder['info']->date_inserted}}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <p>Total Amount:<span>{{$aOrder['info']->order_details['total_price']}}$</span></p>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Order Details
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" class="id_item" value="432"/>
                                    <div class="col-md-4">
                                       Meal Name:
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="item_qty">
                                            <input type="hidden" value="413241"/>
                                            QTY:
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="spicy">
                                            <input type="hidden" value="321"/>
                                            spicy:
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Total Price:
                                    </div>
                                </div>
                            @foreach($aOrder['info']->order_details['items'] as $item)
                                <div class="row">
                                    <input type="hidden" class="id_item" value="{{$item['id_item']}}"/>
                                    <div class="col-md-4">
                                    {{$item['name']}}
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="item_qty">
                                            <input type="hidden" value="{{$item['qty']}}"/>
                                            {{$item['qty']}}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="spicy">
                                            <input type="hidden" value="{{$item['spicy']}}"/>
                                            {{$item['spicy']}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Total Price:
                                    </div>
                                </div>
                             @endforeach
                            </div>
                        </div>
                    </div>
            @endforeach
                </div>

        </div>
    </div>
    <div class="col-md-2">

    </div>
@endsection