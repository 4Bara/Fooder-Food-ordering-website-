@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/user.js")}}" ></script>
@stop
@section('content')

    @if(isset($data['visitor_id']))
    <input type="hidden" id="visitor_id" value="{{$data['visitor_id']}}"/>
    @endif

    <div class="col-md-3" id="left-side">
        <img id="profile-picture" src="https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-xaf1/v/t1.0-9/10628249_10152393424262462_9177899944359276523_n.jpg?oh=e1ecf09dcc256fae98f9b0457b007a35&oe=56B16FDE&__gda__=1458004842_9780c4fe105b588eecc6e094fe9044d6"/>
        <div id="user-info-box">
            <div class="row">
                <div class="col-xs-12">
                    <label>Name: <span>{{$aUser['user']->first_name}} {{$aUser['user']->last_name}}</span></label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <label>Bio:</label> <p>this is a test bio that will be used in exmaining and testing the website design.</p>
                    {{--{{$user->user_bio}}--}}
                </div>
            </div>
            @if(isset($data['country']))
                <div class="row">
                    <div class="col-xs-12">
                        <label>Find me in:</label><p>{{$data['country']}}</p>
                        {{--{{$user->user_bio}}--}}
                    </div>
                </div>
            @endif
            <input id="token" type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="hidden" id="id_user" value="{{$aUser['user']->id_user}}"/>
            @if(isset($data['profileOwner']) && $data['profileOwner']=='no')
                @if(!empty($data['visitor_id']))
                <div class="row">
                    <div class="col-xs-12">
                        <Button id="compliment">Give me a like <img src="{{asset("../public/like.jpg")}}"/></Button>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <Button id="follow">Follow me!</Button>
                        </div>
                    </div>
                @endif
            @endif
            @if(isset($aUser['rating']))
                <div class="row">
                    <div class="col-xs-12">
                        <label>I Have <span>{{$aUser['rating']}} Likes</span></label>
                        {{--{{$user->user_bio}}--}}
                    </div>
                </div>
            @endif
            {{--<p id="user_location"></p>--}}
            <p id="user-followers">24k Followers</p>
        </div>
    </div>
    <div class="col-md-6" id="middle-section">
        <div id="activities-section">
            <h2>My Activities</h2>
            <div class="row" id="activity">
                <img id="activity-picture" src="https://upload.wikimedia.org/wikipedia/commons/1/13/Facebook_like_thumb.png"/>
                <p id="activity-content">Bara,Wrote a reivew about <a href="">Macdonalds</a></p>
                <p id="activity-date">2015-11-11 12:30:22</p>
            </div>
        </div>
    </div>
    <div class="col-md-3" id="right-side">
        <div class="row">
            <h3>Favorite Offers</h3>
            <div id="favorite-offers">
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
                <img src="https://upload.wikimedia.org/wikipedia/en/8/85/Pizza_brain_restaurant_square_logo_design.jpg"/>
            </div>
        </div>
        <div class="row">
            <h3>Favorite Menus</h3>
            <div id="favorite-menus">
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
                <img src="http://www.ushgnyc.com/wp-content/media/USC_LogoMaster1-232x232.jpg"/>
            </div>
        </div>
        <div class="row">
            <h3>Favorite Restaurants</h3>
            <div id="favorite-restaurants">
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>
                <img src="https://www.habitburger.com/wp-content/themes/habitburger/images/logo-habit.jpg"/>

            </div>
        </div>
    </div>
@stop