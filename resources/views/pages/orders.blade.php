@extends('layouts.default')
@section('style')
    <style>
        .title{
            text-align: center;
            font-size:25pt;
            margin-bottom:25px;
        }
        .info{
            font-size:15pt;
            float:left;
            width:100%;
            border-radius: 4px 4px 0px 0px;
            text-align:center;
            color:black;
            background-color:#CCCCCC;
        }
        .info p{
            margin-top:10px;
            margin-left:15px;
        }
        .order{
            background-color: white;;
            margin-bottom:20px;

            width:100%;
            padding:15px;
        }
        .padding0{
            padding:0px;
        }
        .col-md-2{
            padding:0px;
        }
        .total_amount{
            font-weight: bold;
            color: #fff;
        }

    .items-info{
        text-align: center;
        background-color: #73AF73;
        color:white;
        border-radius: 4px;
    }
        .order-item > .row:nth-child(even){
        background-color: #CCCCCC;
        }
        .order-item > .row:nth-child(odd){
            background-color: #fcfcfc
        }
    </style>
    <script src="{{asset("../public/javascript/order.js")}}" ></script>
@stop

@section('content')
<div class="container">
        @if($data['isRestaurant'])
            <div class="row title">Orders Screen</div>
        @else
            <div class="row title">My Orders</div>
        @endif
        <div class="orders">
            @foreach($orders as $aOrder)
                <div class="print-class">
                <div class=" info">
                    <div class="col-md-2 padding0">
                        <p>Order</p>
                    </div>
                    <div class="col-md-2">
                        @if($data['isRestaurant'])
                            <p>Customer</p>
                        @else
                            <p>Restaurant Name</p>
                        @endif
                    </div>

                    <div class="col-md-2">
                        <p>Status</p>
                    </div>
                    <div class="col-md-2">
                        <p>Details</p>
                    </div>
                    @if($data['isRestaurant'])
                        <div class="col-md-2">
                           <p title="click here to print the order"><a href='' style='background-color: mediumpurple' class='btn btn-primary printer' ><i class="glyphicon glyphicon-print"></i></a></p>
                        </div>
                    @endif
                </div>
                <div class="row order white-box">
                    <div class="col-md-2 padding0">
                        <input type="hidden" class="id_order" value="{{$aOrder['info']->id_order}}"/>
                      <p style="font-size:25px;color:cornflowerblue">#{{$aOrder['info']->id_order}}</p>
                      <p class="order-time"><i class="glyphicon glyphicon-time"></i> {{$aOrder['info']->date_inserted}}</p>
                      <p style="padding:5px;">Note:{{$aOrder['info']->note}}</p>
                    </div>
                    <div class="col-md-2">
                       @if(isset($aOrder['restaurant']->restaurant_name))
                           <p><i class="glyphicon glyphicon-cutlery"></i><a href="p/{{$aOrder['restaurant']->username}}">{{$aOrder['restaurant']->restaurant_name}}</a></p>
                           <p><i class="glyphicon glyphicon-phone-alt"></i> {{$aOrder['restaurant']->telephone}}</p>
                            <p><i class="glyphicon glyphicon-envelope"></i>  <a href="mailto:{{$aOrder['restaurant']->email}}"> {{$aOrder['restaurant']->email}}</a></p>
                            <p><i class=""></i>{{$aOrder['restaurant']->website}}</p>
                          @else
                            <p><i class="glyphicon glyphicon-user"></i> <a href="p/{{$aOrder['customer']->username}}">{{$aOrder['customer']->first_name.' '.$aOrder['customer']->last_name}}</a></p>
                        @endif
                        @if($data['isRestaurant'])
                               <p> <i class="glyphicon glyphicon-phone"></i> {{$aOrder['customer']->user_mobile}}</p>
                               <p><i class="glyphicon glyphicon-envelope"> </i><a href="mailto:{{$aOrder['customer']->email}}">Email</a></p>
                               @if(isset($aOrder['location']))
                                   <p><i class="glyphicon glyphicon-map-marker"> </i><a target="_blank" href="{{$aOrder['location']}}">Location</a> </p>
                               @endif
                        @endif
                    </div>

                    <div class="col-md-2">
                        @if($data['isRestaurant'])
                                @foreach($data['status'] as $status)
                                    @if($aOrder['info']->status==$status)
                                        <a class="btn btn-block btn-success order_status" disabled='disabled' style="">{{$status}}</a>
                                    @else
                                        <a class="btn btn-block btn-danger order_status" style="">{{$status}}</a>
                                    @endif
                                @endforeach
                        @else
                        <p class="btn btn-block">{{$aOrder['info']->status}}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row items-info" style="">
                                <div class="col-md-5">
                                    <p>NAME</p>
                                </div>
                                    <div class="col-md-2">
                                        QTY
                                    </div>
                                <div class="col-md-2">
                                     <div class="spicy">
                                        SPICY
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    PRICE
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="order-item">

                        @foreach($aOrder['info']->order_details['items'] as $item)
                            <div class="row ">
                                <input type="hidden" class="id_item" value="{{$item['id_item']}}"/>
                                <div class="col-md-5">
                                    {{$item['name']}}
                                </div>
                                <div class="col-md-2">
                                    <div class="item_qty text-center">
                                        <input type="hidden" value="{{$item['qty']}}"/>
                                        {{$item['qty']}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="spicy text-center">
                                        <input type="hidden" value="{{$item['spicy']}}"/>
                                        {{$item['spicy']}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="price text-center">
                                        <input type="hidden" value="{{$item['price']}}"/>
                                        ${{$item['price']}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        </div>
                            <div class="col-md-9">
                            </div>
                            <div class="col-md-3" style="background-color: #f9f9f9;margin-bottom: 20px;padding: 5px;text-align: center;">
                                 <span style="color: red;font-weight: bold;">Total with tax: ${{0.16*$aOrder['info']->order_details['total_price']+$aOrder['info']->order_details['total_price']}}</span>
                            </div>
                        @if($data['isRestaurant'])
                             <a class="btn pull-right btn-primary order_status" style="">DONE</a>
                        @endif
                    </div>
                    </div>
                </div>
            @endforeach
                </div>

        </div>
@endsection