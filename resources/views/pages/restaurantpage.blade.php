@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/restaurant.js")}}" ></script>
@stop
@section('content')

   <div class="restaurant-left col-md-4">
       <div class="row">
           <div class="col-xs-4">
               <img id='restuarnat-page-logo' src="https://cdn3.iconfinder.com/data/icons/social-circle/512/pinterest-512.png"/>
           </div>
           <div class="col-xs-8">
               <div class="restaurant-name">
                   {{$restaurant->restaurant_name}}
               </div>
               <div class="send-feed-back-button">
                   <button id="sendFeedBack" class="form-control">Got Feedback ?</button>
               </div>
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
               <div class="col-xs-2">
                  <label>Address:</label>
               </div>
               <div class="col-xs-2">
                  <span id="country-span">Amman,Jordan</span>
               </div>
           </div>
           <div class="cuisines row">
               <div class="col-xs-2">
                   <label>Cuisines:</label>
               </div>
               <div class="col-xs-4">
                   <span id="cuisines-span">{{$restaurant->cuisines}}</span>
               </div>
           </div>
           <div class="telephone row">
               <div class="col-xs-1">
                  <label>Tel:</label>
               </div>
               <div class="col-xs-2">
                   <span id="tel-span">{{$restaurant->telephone}}</span>
               </div>
           </div>
       </div>
       <div class="row">
           <div class="price-range row">
               <div class="col-xs-2">
                   @if(!empty($restaurant->price_range))
                       <label>Price:</label>
                   </div>
                   <div class="col-xs-1">
                     <span id="price-span">{{$restaurant->price_range}}</span>
                   </div>
                   @else
                       <label>Price:</label>
                       </div>
                       <div class="col-xs-2">
                           <span id="price-span">???</span>
                       </div>
                   @endif
       </div>
       <div class="reviews row">
           <div class="col-xs-2">
               <label>Reviews:</label>
           </div>
           <div class="col-xs-3">
               <span id="tel-span">43534</span>
           </div>
       </div>
           <div class="rating row">
               <div class="col-xs-3">
                   <label>Rating :</label>
               </div>
               <div class="col-xs-2">
                   <span>Goooood!!</span>
               </div>
           </div>
        <div class="row">
            <div class=" restaurant-status col-xs-12">
                @if(isset($extra['restaurant-status']))
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
        <div class="row restaurant-admin-panel">
           <span>Control Panel:</span> <a href="{{URL::asset('p/'.$restaurant->username.'/newMenu')}}">New Menu</a>|<a href="{{URL::asset('p/'.$restaurant->username.'/newOffer')}}">New Offer</a>|<a href="{{URL::asset('p/'.$restaurant->username.'/addNewItemPage')}}">New Item</a>
        </div>
        <div class="row">
            <div class="offers-box col-md-6">
               <p>Our Offers:</p>
                <img id="offers-box-logo" src="http://englishsuccessacademy.com/wp-content/uploads/2015/03/iStock_000019127111XSmall.jpg"/>
            </div>
            <div class="offers-box col-md-6">
                <p>Our Menus:</p>
                {{--value="{{$restaurant->username}}"--}}
                <a id='showMenus' href="{{URL::asset('p/'.$restaurant->username.'/menus?username='.$restaurant->username)}}"><img id="offers-box-logo" src="http://tiffanythai.com/wp-content/uploads/2014/02/Menu_Relief_Logo_cmyk_V1-380x380.jpg"/></a>
            </div>
        </div>
        <div class="images-box row">
            <p>Images</p>
            <div class="images">
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
                <img src="http://www.houstonlocal.news/wp-content/uploads/2015/09/bjs-free-pizookie-600p.jpg"/>
            </div>
        </div>
        <div class="reviews-box row">
            <p>Reviews:</p>
            <div class="reviews">
                <img src="http://image.slidesharecdn.com/joureviews-121017114810-phpapp02/95/journalism-writing-reviews-13-638.jpg?cb=1353312095"/>
                <img src="http://image.slidesharecdn.com/joureviews-121017114810-phpapp02/95/journalism-writing-reviews-13-638.jpg?cb=1353312095"/>
                <img src="http://image.slidesharecdn.com/joureviews-121017114810-phpapp02/95/journalism-writing-reviews-13-638.jpg?cb=1353312095"/>
            </div>
        </div>
    </div>
@stop