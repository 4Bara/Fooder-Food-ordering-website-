@extends('layouts.default')
@section('style')
    <style>
        #restuarnat-page-logo{
            width:120px;
        }
        .restaurant-name{
            font-size:35pt;
        }
        .restaurant-left{
            border:2px solid black;
        }
        .restaurant-left .row{
            margin-top:10px;
        }
        .bio-div p{
            font-size:16pt;
            border:1px solid firebrick;;
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
    </style>
@stop
@section('script')
    <script src="{{asset("../public/javascript/restaurant.js")}}" ></script>
@stop
@section('content')
    <div class="container">
    <div class="restaurant-left col-md-4">
       <div class="row">
           <div class="col-xs-4">
               <img id='restuarnat-page-logo' src="{{$restaurant->logo}}"/>
           </div>
           <div class="col-xs-8">
               <div class="restaurant-name">
                   {{$restaurant->restaurant_name}}
               </div>
               @if($data['user_type']!='restaurant' && $data['logged']=='yes')
                   <div class="send-feed-back-button">
                      <a href="{{URL::asset('p/'.$restaurant->username.'/writeReview/id='.$restaurant->id_restaurant)}}">
                          <button id="sendFeedBack" class="form-control">Write Review</button>
                      </a>
                   </div>
               @endif
               <button value="{{$restaurant->id_restaurant}}" id="favorite" class="btn btn-danger"><i class="glyphicon glyphicon-heart"></i></button>
           </div>
       </div>
       <div class="row">
           <div class="bio-div">
               <p id="about-us">About us:</p>
               <p>{{$restaurant->bio}}</p>
           </div>
       </div>
       <div class="row">
           <div class="address row">
               <div class="col-xs-3">
                  <label>Address:</label>
               </div>
               <div class="col-xs-2">
                  <span id="country-span">Amman,Jordan</span>
               </div>
           </div>
           <div class="cuisines row">
               <div class="col-xs-3">
                   <label>Cuisines:</label>
               </div>
               <div class="col-xs-4">
                   <span id="cuisines-span">{{$restaurant->cuisines}}</span>
               </div>
           </div>
           <div class="telephone row">
               <div class="col-xs-3">
                  <label>Tel:</label>
               </div>
               <div class="col-xs-2">
                   <span id="tel-span">{{$restaurant->telephone}}</span>
               </div>
           </div>
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
       <div class="reviews row">
           <div class="col-xs-3">
               <label>Reviews:</label>
           </div>
           <div class="col-xs-3">
               <span id="tel-span">{{$restaurant->telephone}}</span>
           </div>
       </div>
           <div class="rating row">
               <div class="col-xs-3">
                   <label>Rating :</label>
               </div>
               <div class="col-xs-2">
                   <span>{{$restaurant->rating}}/5</span>
               </div>
           </div>
        <div class="row">
            <div class=" restaurant-status col-xs-12">
                @if(!isset($extra['restaurant-status']))
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
           {{--<label>Reviews:<span id="reviews-span">4334</span></label>--}}
           {{--<label>Rating:<span id="rating-span">****</span></label>--}}
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
                {{--value="{{$restaurant->username}}"--}}
                <a id='showMenus' href="{{URL::asset('p/'.$restaurant->username.'/menus?username='.$restaurant->username)}}"><img id="offers-box-logo" src="http://tiffanythai.com/wp-content/uploads/2014/02/Menu_Relief_Logo_cmyk_V1-380x380.jpg"/></a>
            </div>
            <div class="offers-box col-md-6">
                <p>Reviews about us</p>
                <a id="showReviews" href="{{URL::asset('/p/'.$restaurant->username.'/reviews?username='.$restaurant->username)}}"><img id="offers-box-logo" src="{{URL::asset('reviews.jpg')}}"/></a>
            </div>
        </div>

        <div class="images-box row">
            <p>Images</p>
            <div class="images">
                <img src="http://www.thelalit.com/d/the-lalit-new-delhi/media/TheLalitNewDelhi/FoodBeverage_Restaurants/24_7Restaurant/24-7RestaurantDelhi.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://singlegrain.com/wp-content/uploads/2010/04/restaurants-image-243.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
            </div>
        </div>
    </div>
    </div>
@stop
