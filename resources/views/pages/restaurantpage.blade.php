@extends('layouts.default')
@section('style')
    <style>
        #restuarnat-page-logo{
            width:120px;
        }
        .restaurant-left{
            border:2px solid black;
        }
        .restaurant-left .row{
            margin-top:10px;
        }
        .bio-div p{
            font-size:16pt;
            padding:5px;
        }
        .bio-div #about-us{
            color:white;
            background-color: firebrick;;
        }
        .address div,.telephone div,.reviews div,.rating div,.price-range div,.cuisines div{
            margin:5px;
        }
        .address,.telephone,.reviews,.rating,.price-range ,.cuisines{
            font-weight: bold;
            font-size: large;
        }
        .price-range span{
            color:darkgreen;
            font-size:15pt;
        }
        .restaurant-open{
            background-color:green;
            color:white;
        }
        .restaurant-close{
            background-color: darkred;
            color:white;
        }
        .restaurant-status p{
            padding:2px;
            text-align: center;
            font-size:20px;
        }
        .offers-box{
            border:1px solid black;
            text-align: center;
        }
        .offers-box p{
            font-size:25pt;
        }

        #offers-box-logo{
            height:200px;
        }
        .images-box .images img,.reviews-box .reviews img{
            width:250px;
            padding:2px;
        }
        .images-box,.reviews-box{
            border:1px solid lightgray;
            text-align: center;
        }
        .images-box p,.reviews-box p {
            font-size:xx-large;
        }
        .restaurant-admin-panel{
            background-color:cornflowerblue;
            font-size:15pt;
            text-align: center;
        }
        .restaurant-admin-panel span{
            float:left;
            color:white;
        }
        .restaurant-admin-panel a{
            padding:5px;
            margin:5px;
            color:white;
        }
        #gray-dollars{
            color:gray;
        }

        .restaurant-info-box{
            background-color:white;
            border-radius: 4px;
            border:1px solid #f0f0f0;
        }
        #restaurant-logo{
            width:100%;
        }
        #restaurant-name{
            margin-top:20px;
            font-size:20pt;
        }
        .restaurant-name{
            padding:0px;
        }
        .restaurant-logo{
            padding:0px;
        }
        #sendFeedBack{
            font-size:14pt;
            margin-bottom:10px;
        }
        .location{
            text-align: center;;
        }
        .row{
            margin-bottom:5px;
        }
    </style>
@stop
@section('script')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="{{asset("../public/javascript/restaurant.js")}}" ></script>
@stop
@section('content')
    <div class="container">
    <div class="restaurant-info-box col-md-4">

        <div class="row">
            <div class="col-md-4 restaurant-logo">
                   <img id='restaurant-logo' src="{{$restaurant->logo}}"/>
            </div>
            <div class="col-md-8 restaurant-name">
                  <p id="restaurant-name">{{$restaurant->restaurant_name}}</p>
            </div>
        </div>

        @if($data['user_type']!='restaurant' && $data['logged']=='yes')
            <div class="row">
                       <div class="send-feed-back-button col-md-9">
                          <a href="{{URL::asset('p/'.$restaurant->username.'/writeReview/id='.$restaurant->id_restaurant)}}">
                              <button id="sendFeedBack" class="form-control"><i class="glyphicon glyphicon-pencil"></i> Write Review about us</button>
                          </a>
                       </div>
                <div class="col-md-3">
                       <button title="Click to favorite this restaurant" value="{{$restaurant->id_restaurant}}" id="favorite" class="btn btn-danger"><i class="glyphicon glyphicon-heart"></i></button>
                </div>
            </div>
        @endif

       <div class="row">
           <div class="bio-div">
               <p id="about-us">About us:</p>
               <p>{{$restaurant->bio}}</p>
           </div>
       </div>
       <div class="row">
           @if(isset($restaurant->location))
           <div class="location">
               <label>Our Location</label>
               <input type="hidden" id="latitude" value="{{$restaurant->location->lat}}"/>
               <input type="hidden" id="longitude" value="{{$restaurant->location->long}}"/>
               <div id="location-map" style="width: 378px; height: 350px"></div>
               <div class="col-xs-2">
                  <span id="country-span">Amman,Jordan</span>
               </div>
           </div>
          @endif
       </div>
           <div class="cuisines row">
                   <label>Cuisines:</label>
                   <span id="cuisines-span">{{$restaurant->cuisines}}</span>
           </div>
           <div class="telephone row">
                  <label>Tel:</label>
                   <span id="tel-span">{{$restaurant->telephone}}</span>
           </div>
            <div class="reviews row">
                <label>Reviews:</label>
                    <span id="tel-span">{{$data['reviews_count']}}</span>
            </div>
        <div class="rating row">
                <label>Rating :</label>
                <span>{{$restaurant->rating}}/5</span>
        </div>
        <div class="row">
            <div class="price-range row">
                <div class="col-xs-3">
                    <label>Price:</label>
                </div>
                @if(!empty($restaurant->price_range))
                    {{--$restaurant->price_range--}}
                    <div class="col-xs-4">
                        @for($i=0;$i<4;$i++)
                            <span id="price-span" class="glyphicon glyphicon glyphicon-usd"></span>
                        @endfor
                        @for($i=0;$i<1;$i++)
                            <span id="gray-dollars" class="glyphicon glyphicon glyphicon-usd"></span>
                        @endfor
                    </div>
                @else
                    <div class="col-xs-7">
                        <span>Price Wasn't provided</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class=" restaurant-status col-xs-12">
                @if($restaurant->opening_days)
                <div class="restaurant-open">
                    <p>we are open NOW!</p>
                </div>
                @else
                    <div class="restaurant-close">
                        <p>we are closed!</p>
                    </div>
                @endif
            </div>
        </div>
       </div>
    <div class="col-md-8">
        @if($data['logged']=="yes" && $data['profileOwner']=='yes')
            <div class="row restaurant-admin-panel">
               <span>Control Panel:</span> <a href="{{URL::asset('p/'.$restaurant->username.'/newMenu')}}">New Menu</a>|<a href="{{URL::asset('p/'.$restaurant->username.'/newOffer')}}">New Offer</a>|<a href="{{URL::asset('p/'.$restaurant->username.'/addNewItemPage')}}">New Item</a>
            </div>
        @endif
        <div class="row">
            <div class="offers-box col-md-6">
               <p>Our Offers:</p>
               <a id="showOffers" href="{{URL::asset('p/'.$restaurant->username.'/offers?username='.$restaurant->username)}}"><img id="offers-box-logo" src="http://englishsuccessacademy.com/wp-content/uploads/2015/03/iStock_000019127111XSmall.jpg"/></a>
            </div>
            <div class="offers-box col-md-6">
                <p>Our Menus:</p>
                <a id='showMenus' href="{{URL::asset('p/'.$restaurant->username.'/menus?username='.$restaurant->username)}}"><img id="offers-box-logo" src="http://tiffanythai.com/wp-content/uploads/2014/02/Menu_Relief_Logo_cmyk_V1-380x380.jpg"/></a>
            </div>
            <div class="offers-box col-md-6">
                <p>Reviews about us</p>
                <a id="showReviews" href="{{URL::asset('/p/'.$restaurant->username.'/reviews?username='.$restaurant->username)}}"><img id="offers-box-logo" src="{{URL::asset('reviews.jpg')}}"/></a>
            </div>
        </div>
    </div>
    </div>
@stop