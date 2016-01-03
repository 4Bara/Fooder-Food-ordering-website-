@extends('layouts.default')
@section('content')
    <div id="slidehome" class="slidehome">
        <div class="centerup">
            <form method="POST" action="/">
                <input type="text" id="main-search-term" class="form-control w-300 inline" placeholder="Enter a Restaurant Name,Food Name, Location ..." />
                <input type="submit" id="search" value="Go!" class="btn btn-default btn-search" />
            </form>
        </div>
    </div>

    <div class="container">
        <div class="col-md-7">
            <div class="search-results">
                <div class="row">
                    <h3>Top Restaurants</h3>
                </div>
                <div class="col-md-12">
                    @include("pages.restaurant-box")
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="search-filter col-md-12">
                        <label id="search-filter-title"><i class="glyphicon glyphicon-filter"></i>Search...</label>
                    <form id="search-filter-form" role="form">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="shareLocation"><i class="glyphicon glyphicon-map-marker"></i><span>Share My Location</span></button>
                                <input type="hidden" value="0" id="lat"  name="userlat"/>
                                <input type="hidden" value="0" id="long" name="userlong"/>
                            </div>
                            <div class="distance" style="display: none">
                                <div  class="col-md-12">Distance</div>
                                <div class="col-md-10">
                                    <input type="range" id="distance" value="2" min="1" max="15" step="1" name="distance" class="input-group"/>
                                </div>
                                <div class="col-md-6">
                                    <label> Less than <span id="kilo-dist">2</span>KM</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label>Prices:</label>
                            </div>
                            <div class="col-xs-2">
                                <label>FROM:</label>
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
                                <select name="location" id="countries">
                                    {{--HERE YOU SHOULD PRINT THE VALUE OF COUNTRIES ARRAY--}}
                                        @foreach($aFilterData['countries'] as $oCountry)
                                            <option id="{{$oCountry->id_country}}" value="{{$oCountry->id_country}}">{{$oCountry->country_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <label>Food Type:</label></div>
                            <div class="col-xs-6">
                                <select name="food_type" id="food_type">
                                    {{--HERE YOU SHOULD PRINT THE VALUE OF Food Type ARRAY--}}
                                    <option id="0" value="0">Any Type</option>
                                    @foreach($aFilterData['food_type'] as $oType)
                                        <option id="{{$oType->id_cuisine}}" value="{{$oType->id_cuisine}}">{{$oType->name}}</option>
                                    @endforeach
                                </select>
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
                                <label>Smoking Allowed:</label>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="checkbox" value="yes" name="no_smoking"/>
                            </div>
                        </div>
                        <div class="row">
                          <input type="submit" id="search" value="Search" class="btn btn-success btn-search" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                    <h3>Offers</h3>
                    <div class="offer-box">
                        <img id="offer-picture" stlye="height:300px"src="http://s3images.coroflot.com/user_files/individual_files/original_452976_OEirjUTLAZCVu32XX70Lngk6N.jpg"/>
                        <p id="restaurant_id" value="1" hidden></p>
                        <p id="offer_id" value="1" hidden></p>
                        <p id="offer_title">WaFFER!! 50%</p>
                        <p id="offer_price">Offer Price:<span>12$</span></p>
                        <p id="offer_restaurant">From:<a href="restaurant_page">Macdonalds</a></p>
                        <a href="offer_page">More Details....</a>
                    </div>
        </div>
    </div>
    </div>
@stop
