@if(empty($aTopRestaurants))
    <h3>We couldn't find any results</h3>
@else
@foreach($aTopRestaurants as $oRestaurant)
    <div class="top-restaurant-box row">
        <a  href="http://localhost/fooder/public/p/{{$oRestaurant->username}}">
            <div class="col-md-3">
                @if(empty($oRestaurant->logo))
                    <img id="logo" style="margin-top:10px" src="{{asset("../public/noimage.jpg")}}"/>
                @else
                    <img id="logo" src="{{$oRestaurant->logo}}"/>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <h3 class="pull-left" id="restaurant_name">{{$oRestaurant->restaurant_name}}</h3>
                        @if($oRestaurant->opening_days)
                            <span class="label restaurant_status label-success">opened</span>
                        @else
                            <span class="label restaurant_status label-danger">closed</span>
                        @endif
                        <h4 class="pull-right" id="price_range"><i>$$$$$</i></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 starspos">
                        <div class="row">
                            @for($i=0;$i<5;$i++)
                                @if($i<$oRestaurant->rating)
                                    <span class="glyphicon star glyphicon-star yellow"></span>
                                @else
                                    <span class="glyphicon star glyphicon-star gray"></span>
                                @endif
                            @endfor
                            <label id="reviews-count" class="star">
                                <i> {{$aReviews[$oRestaurant->id_restaurant]}} Reviews</i>
                            </label>
                        </div>
                        @if(isset($oRestaurant->cuisines))
                            <div class="row">
                                <p><i class="glyphicon glyphicon-cutlery"/></i> {{$oRestaurant->cuisines}}</p>
                            </div>
                        @endif
                        <div class="row">
                            <p><i class="glyphicon glyphicon-phone-alt"/></i> {{$oRestaurant->telephone}}</p>
                        </div>
                    </div>
                </div>

            </div>

        </a>
    </div>

@endforeach
@endif