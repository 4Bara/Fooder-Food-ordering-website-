@extends('layouts.default')
@section('style')
  <script src="{{asset("../public/javascript/registeration.js")}}" ></script>
@stop
@section('content')
    <div class="col-md-4">
    </div>
    <div id="registeration_page_content" class="col-md-4">
        <h1>Registeration Page</h1>
        <div id="form-container">
        <form id="registeration-form" class="form-horizontal"  method="post">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <div class="form-group">
                <label id="question-user">What account type you are?</label>
                <div class="radio">
                      <label class="control-label radio-inline pull-left">Person<input type="radio" id="person" name="user_kind" value="person" checked/></label>
                </div>
                <div class="radio">
                      <label class="control-label radio-inline pull-left" >Restaurant<input type="radio" id="restaurant" value="restaurant" name="user_kind"/></label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Username</label> <input class="form-control" type="text" name="username"/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Password</label><input class="form-control" type="password" name="password"/>
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Restaurant Name</label><input class="form-control" type="text" name="restaurant_name">
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Telephone</label><input class="form-control" type="text" name="telephone">
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Restaurant Bio</label><textarea rows="5" class="form-control" type="text" name="bio"></textarea>
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Food Type "Cusine"</label>
                <select name="cuisines" id="cuisines">
                    @foreach($aData['aCuisines'] as $oCuisine)
                            <option id="{{$oCuisine->id_cuisine}}" value="{{$oCuisine->id_cuisine}}">{{$oCuisine->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="restaurant form-group">
              <label class="control-label col-sm-2">Opening Days</label>
                <div class="opening_days form-group">
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="sunday" value="true">SUNDAY</label>
                    <input type="text" class="times" id="sunday_hours_from"/> to <input type="text" class="times" id="sunday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="monday" value="true">MONDAY</label>
                    <input type="text" class="times" id="monday_hours_from"/> to <input type="text" class="times" id="monday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="tuesday" value="true">TUESDAY</label>
                    <input type="text" class="times" id="tuesday_hours_from"/> to <input type="text" class="times" id="tuesday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="wednesday" value="true">WEDNESDAY</label>
                    <input type="text" class="times" id="wednesday_hours_from"/> to <input type="text" class="times" id="wednesday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="thursday" value="true">THURSDAY</label>
                    <input type="text" class="times" id="thursday_hours_from"/> to <input type="text" class="times" id="thursday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="friday" value="true">FRIDAY</label>
                    <input type="text" class="times" id="friday_hours_from"/> to <input type="text" class="times" id="friday_hours_to"/>
                    <label class="checkbox-inline"><input class="days" type="checkbox" name="saturday" value="true">SATURDAY</label>
                    <input type="text" class="times" id="saturday_hours_from"/> to <input type="text" class="times" id="saturday_hours_to"/>
                </div>
                {{--<label class="control-label col-sm-2">Sunday</label> <input type="checkbox" name="sunday">--}}
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2 checkbox-inline pull-left">Smoking is allowed?
                <input type="checkbox" name="smoking_allowed"/></label>
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2 checkbox-inline pull-left">Provide Delivery Service
                <input type="checkbox" name="delivery"/></label>
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Website</label>
                <input type="text" class="form-control" name="website"/>
            </div>
            <div class="restaurant form-group">
                <label class="control-label col-sm-2">Location</label>
                <label class="control-label col-sm-2">Add Map HERE</label>
            </div>
            <div class="person form-group">
        <label class="control-label col-sm-4">First Name</label> <input  class="form-control"  type="text" name="first_name"/>
            </div>
            <div class="person form-group">
        <label class="control-label col-sm-4">Last Name</label> <input  class="form-control" type="text" name="last_name"/>
            </div>
            <div class="form-group">
        <label class="control-label col-sm-2">Email</label> <input class="form-control"  type="email" name="email"/>
            </div>
            <label class="person control-label col-sm-2">Date of Birth</label>
            <input class="person form-control" type="text" name="date_of_birth" id="age"/>
        <label class="control-label col-sm-2">Country</label>
            <select name="id_country" id="countries">
                {{--HERE YOU SHOULD PRINT THE VALUE OF COUNTRIES ARRAY--}}
                @foreach($aData['aCountries'] as $oCountry)
                <option id="{{$oCountry->id_country}}" value="{{$oCountry->id_country}}">{{$oCountry->country_name}}</option>
                @endforeach
            </select>
            <div class="person">
                <label class="control-label col-sm-2">Gender</label>
                <select name="gender" id="gender">
                    @foreach($aData['aGender'] as $oGender_id => $oGender_name)
                        <option id="{{$oGender_id}}">{{$oGender_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn .btn-primary" id="submit-button">Done</button>
        </form>
        </div>
    </div>
    <div class="col-md-4">
    </div>
@stop