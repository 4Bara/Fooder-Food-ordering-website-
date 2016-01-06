@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/user.js")}}" ></script>
@stop
@section('content')
    @if(isset($data['visitor_id']))
        <input type="hidden" id="visitor_id" value="{{$data['visitor_id']}}"/>
    @endif
    <div class="container">
    <div class="col-md-3" id="left-side">

        <div id="user-info-box">
                <img id="profile-picture" src="{{$aUser['user']->photo}}"/>
                {{--$aUser['user']->photo--}}
              <div class="info-box-content">

                    <h3 id="name">{{$aUser['user']->first_name}} {{$aUser['user']->last_name}}</h3>
                    {{--<p>this is a test bio that will be used in exmaining and testing the website design.</p>--}}
                      @if(isset($aUser['country']))
                          <label>    <i class="glyphicon glyphicon-home"></i></label>  {{$aUser['country']}}
                      @endif

                          <label><i class="fa fa-birthday-cake"></i> {{$aUser['user']->age}} </label>
                          <label><i class="fa fa-venus-mars"></i> {{$aUser['user']->gender}} </label>
                    <p class="bio">{{$aUser['user']->user_bio}}</p>
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
                  <div>
                      <ul class="list-inline profile-list text-center">
                          <li><span>Followers</span><br><span class="text-center">{{$aUser['followers']}}</span></li>
                          <li><span>Reviews</span><br><span class="text-center">{{$aUser['reviews_count']}}</span></li>
                      </ul>
                  </div>
        </div>
        </div>
    </div>
    <div class="col-md-6" id="middle-section">
        <div id="activities-section">
            <p id="title">Activities</p>
                @foreach($aActivities as $oActivity)
                <div class="row activity">
                    @if($oActivity['type']=="review")
                        <img id="picture" src="{{"../cover.jpg"}}"/><span>{{$aUser['user']->username}}</span>
                        <p><b>Review</b></p>
                        <p id="other-name">Wrote a review about <a href="http://localhost/fooder/public/p/{{$oActivity['username']}}">{{$oActivity['other_name']}}</a></p>

                        <p id="date">{{$oActivity['date']}}</p>
                    @endif
                </div>
                @endforeach

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
    </div>
@stop