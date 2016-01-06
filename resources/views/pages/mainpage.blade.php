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
                            <p>
                                <label for="amount">Price range:</label>
                                <input name="price_range" type="text" id="amount" readonly style="border:0; color:cornflowerblue; font-weight:bold;">
                            </p>
                            <div id="slider-range"></div>
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
                        <div class="offers-box">
                            @foreach($aRandomOffers as $oOffer)
                                <div class="offer-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img id="offer-picture" src="{{$oOffer->picture}}"/>
                                    </div>
                                </div>
                                <p id="restaurant_id" value="{{$oOffer->id_restaurant}}" hidden></p>
                                <p id="offer_id" value="{{$oOffer->id_offer}}" hidden>
                                    <div class="row">
                                        <div id="offer_description">
                                            <p id="offer_title">Offer Name:{{$oOffer->name}}</p>
                                            <p>Details:</p>
                                            <p id="offer_price">Price:<span>${{$oOffer->price}}</span></p>
                                            <p>From <span id="restaurant_name"><a href="p/{{$oOffer->id_restaurant}}">{{$oOffer->id_restaurant}}</a></span></p>
                                            <p id="">{{$oOffer->description}}</p>
                                        </div>
                                    </div>
                                <a href="offer?id={{$oOffer->id_offer}}">More Details....</a>
                                </div>
                            @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
