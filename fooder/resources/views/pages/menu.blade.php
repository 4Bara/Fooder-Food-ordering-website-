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
                    <p>Page Title{offers/Menus}</p>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-xs-4">
                <div class="restaurant-name">
                    Restaurant Name Goes HERE!!
                </div>
             </div>
             <div class="col-xs-4">

             </div>
            <div class="col-xs-4">
                    <div class="offer-price">
                        <p>PRICE:123$</p>
                    </div>
            </div>
        </div>
        <div class="row item">
            <div class="col-xs-2 ">
                <img id="item-img" src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
            </div>
            <div class="col-xs-2">
                <div class="item-tile">
                    <h3>Title</h3>
                    <p>Title Goes HERE!!</p>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="item-description">
                    <h3>Description</h3>
                    <p>Descriotuin goes here,so the description of an item should be inserted!!</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-healthy">
                    <h3>Healthy</h3>
                    <p>YYES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>spicy</h3>
                    <p>YES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>Price</h3>
                    <p>5 JD</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-count">
                    <h3>Units</h3>
                        <input id="spinner"  class='spinner' style="width:20px" name="value">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="add-to-cart">
                    <h3>(+)</h3>
                    <input type="button" name="add_item_to_cart" id="add-to-cart" value="Add">
                </div>
            </div>

        </div>
        <div class="row item">
            <div class="col-xs-2 ">
                <img id="item-img" src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
            </div>
            <div class="col-xs-2">
                <div class="item-tile">
                    <h3>Title</h3>
                    <p>Title Goes HERE!!</p>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="item-description">
                    <h3>Description</h3>
                    <p>Descriotuin goes here,so the description of an item should be inserted!!</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-healthy">
                    <h3>Healthy</h3>
                    <p>YYES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>spicy</h3>
                    <p>YES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>Price</h3>
                    <p>5 JD</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-count">
                    <h3>Units</h3>
                    <input id="spinner" class='spinner'  style="width:20px" name="value">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="add-to-cart">
                    <h3>(+)</h3>
                    <input type="button" name="add_item_to_cart" id="add-to-cart" value="Add">
                </div>
            </div>

        </div>
        <div class="row item">
            <div class="col-xs-2 ">
                <img id="item-img" src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
            </div>
            <div class="col-xs-2">
                <div class="item-tile">
                    <h3>Title</h3>
                    <p>Title Goes HERE!!</p>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="item-description">
                    <h3>Description</h3>
                    <p>Descriotuin goes here,so the description of an item should be inserted!!</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-healthy">
                    <h3>Healthy</h3>
                    <p>YYES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>spicy</h3>
                    <p>YES</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-spicy">
                    <h3>Price</h3>
                    <p>5 JD</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="item-count">
                    <h3>Units</h3>
                    <input class='spinner' id="spinner" style="width:20px" name="value">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="add-to-cart">
                    <h3>(+)</h3>
                    <input type="button" name="add_item_to_cart" id="add-to-cart" value="Add">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
