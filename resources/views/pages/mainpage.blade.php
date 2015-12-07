@extends('layouts.default')
@section('content')
    <div class="col-md-3">
       <h3>Offers</h3>
        <div class="offer-box">
            <img id="offer-picture" src="http://s3images.coroflot.com/user_files/individual_files/original_452976_OEirjUTLAZCVu32XX70Lngk6N.jpg"/>
            <p id="restaurant_id" value="1" hidden></p>
            <p id="offer_id" value="1" hidden></p>
            <p id="offer_title">WaFFER!! 50%</p>
            <p id="offer_price">Offer Price:<span>12$</span></p>
            <p id="offer_restaurant">From:<a href="restaurant_page">Macdonalds</a></p>
            <a href="offer_page">More Details....</a>
        </div>
    </div>
    <div class="col-md-5">
        <div class='row'>
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" id="search-term" class="form-control" placeholder="Enter a Restaurant Name,Food Name, Location ...">
                    <span class="input-group-btn">
                        <button id="search" class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="search-results">
            {{--<div class="search-result row">--}}
                {{--<img id="logo" src="http://www.browsermedia.co.uk/wp-content/uploads/macdonalds.jpg"/>--}}
                {{--<p id="restaurant_id" value="1" hidden></p>--}}
                {{--<p id="restaurant_name">Macdonalds</p>--}}
                {{--<p id="price_range">Price Range:<span>$$$$</span></p>--}}
                {{--<p id="restaurant_rating">Overall Rating : <span>5/5</span></p>--}}
                {{--<p id="location">Address: Amman,Jordan</p>--}}
                {{--<p id="cuisines">Cuisines: Fast Food</p>--}}
                {{--<p id="telephone">Tel:0799110599</p>--}}
                {{--<a>Visit Restaurant Page</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="col-md-4">
       <div class="search-filter">
           <label id="search-filter-title">Search Filter</label>
           <form id="search-filter-form" role="form">
               <input type="hidden" name="_token" value="{{ Session::token() }}">
               <div class="row">
                   <div class="col-xs-2">
                         <label>Prices:</label>
                   </div>
                   <div class="col-xs-2">
                        <label>FROM</label>
                   </div>
                   <div class="col-xs-3">
                      <input class="form-control" type="text" name="from_price"/>
                   </div>
                   <div class="col-xs-1">
                        <label>To</label>
                   </div>
                   <div class="col-xs-3">
                        <input class="form-control" type="text" name="to_price"/>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-3">
                       <label>Location:</label></div>
                   <div class="col-xs-6">
                       <input class="form-control" type="text" name="location"/>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-3">
                       <label>Food Type:</label></div>
                   <div class="col-xs-6">
                       <input  class="form-control" type="text" name="food_type"/>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-3">
                       <label>Healthy Food:</label>
                   </div>
                   <div class="col-xs-2">
                       <input class="form-control" type="checkbox" value="yes" name="food_health"/>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xs-3">
                       <label>Smoke Free:</label>
                   </div>
                   <div class="col-xs-2">
                       <input class="form-control" type="checkbox" value="yes" name="no_smoking"/>
                   </div>
               </div>
           </form>
       </div>
    </div>
@stop