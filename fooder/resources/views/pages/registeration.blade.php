@extends('layouts.default')
@section('style')
  <script src="{{asset("../public/javascript/registeration.js")}}" ></script>
@stop
@section('content')
    <div class="col-md-3">
    </div>
    <div id="registeration_page_content" class="col-md-6">
        <div class="row title-row">
        <p>Registeration Page</p>
        </div>
        <div id="form-container">
        <form id="registeration-form" class="form-horizontal"  method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ Session::getToken() }}">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                    <label id="question-user">What account type you are?</label>
                    </div>
                </div>
                    <div class="row">
                        <div class="radio">
                            <div class="col-xs-4">
                             <label class="control-label pull-right">Person</label>
                            </div>
                            <div class="col-xs-2">
                             <input type="radio" id="person" name="user_kind" value="person" checked/>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="radio">
                        <div class="col-xs-4">
                            <label class="control-label radio-inline pull-right" >Restaurant</label>
                        </div>
                        <div class="col-xs-2">
                            <input type="radio" id="restaurant" value="restaurant" name="user_kind"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Username</label>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control" type="text" name="username"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-5">
                         <label class="control-label">Password</label>
                    </div>
                    <div class="col-xs-6">
                         <input class="form-control" type="password" name="password"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                            <div class="col-xs-5"><label class="control-label">Restaurant Name</label>
                    </div>
                    <div class="col-xs-6">
                            <input class="form-control" type="text" name="restaurant_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                            <label class="control-label">Telephone</label>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control" type="text" name="telephone">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                    <label class="control-label">Restaurant Bio</label>
                    </div>
                    <div class="col-xs-6">
                    <textarea rows="5" class="form-control" type="text" name="bio"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Logo</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="file" class="form-control" name="logo"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label class="control-label">Country</label>
                </div>
                <div class="col-xs-6">
                    <select name="id_country" id="countries">
                        {{--HERE YOU SHOULD PRINT THE VALUE OF COUNTRIES ARRAY--}}
                        @foreach($aData['aCountries'] as $oCountry)
                            <option id="{{$oCountry->id_country}}" value="{{$oCountry->id_country}}">{{$oCountry->country_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                       <label class="control-label">Food Type "Cusine"</label>
                    </div>
                    <div class="col-xs-6">
                        <select name="cuisines" id="cuisines">
                            @foreach($aData['aCuisines'] as $oCuisine)
                                    <option id="{{$oCuisine->id_cuisine}}" value="{{$oCuisine->id_cuisine}}">{{$oCuisine->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                         <label class="control-label">Opening Days</label>
                    </div>
                    <div class="opening_days col-xs-7">
                            <div class="row">
                                <div class="col-xs-1 days-checkboxes">
                                    <input class="days" type="checkbox" name="sunday" value="true">
                                </div>
                                <div class="col-xs-2 day-title">
                                    <label>SUNDAY</label>
                                </div>
                                <div class="col-xs-3 time-picker">
                                    <label>From:<input type="text" class="times" id="sunday_hours_from"/></label>
                                </div>
                                <div class="col-xs-3 time-picker no-margin">
                                    <label>To: <input type="text" class="times" id="sunday_hours_to"/></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1 days-checkboxes">
                                    <input class="days" type="checkbox" name="monday" value="true">
                                </div>
                                <div class="col-xs-2 day-title">
                                    <label>MONDAY</label>
                                </div>
                                <div class="col-xs-3 time-picker">
                                    <label>From:<input type="text" class="times" id="monday_hours_from"/></label>
                                </div>
                                <div class="col-xs-3 time-picker no-margin">
                                    <label>To:
                                        <input type="text" class="times" id="monday_hours_to"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1 days-checkboxes">
                                    <input class="days" type="checkbox" name="tuesday" value="true">
                                </div>
                                <div class="col-xs-2 day-title">
                                    <label>TUESDAY</label>
                                </div>
                                <div class="col-xs-3 time-picker">
                                    <label>From:<input type="text" class="times" id="tuesday_hours_from"/></label>
                                </div>
                                <div class="col-xs-3 time-picker no-margin">
                                    <label>To:
                                        <input type="text" class="times" id="tuesday_hours_to"/>
                                    </label>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-xs-1 days-checkboxes">
                                <input class="days" type="checkbox" name="wednesday" value="true">
                            </div>
                            <div class="col-xs-2 day-title">
                                <label>WEDNESDAY</label>
                            </div>
                            <div class="col-xs-3 time-picker">
                                <label>From:<input type="text" class="times" id="wednesday_hours_from"/></label>
                            </div>
                            <div class="col-xs-3 time-picker no-margin">
                                <label>To:
                                    <input type="text" class="times" id="wednesday_hours_to"/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 days-checkboxes">
                                <input class="days" type="checkbox" name="thursday" value="true">
                            </div>
                            <div class="col-xs-2 day-title">
                                <label>THURSDAY</label>
                            </div>
                            <div class="col-xs-3 time-picker">
                                <label>From:<input type="text" class="times" id="thursday_hours_from"/></label>
                            </div>
                            <div class="col-xs-3 time-picker no-margin">
                                <label>To:<input type="text" class="times" id="thursday_hours_to"/></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 days-checkboxes">
                                <input class="days" type="checkbox" name="friday" value="true">
                            </div>
                            <div class="col-xs-2 day-title">
                                <label>FRIDAY</label>
                            </div>
                            <div class="col-xs-3 time-picker">
                                <label>From:<input type="text" class="times" id="friday_hours_from"/></label>
                            </div>
                            <div class="col-xs-3 time-picker no-margin">
                                <label>To:
                                    <input type="text" class="times" id="friday_hours_to"/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 days-checkboxes">
                                <input class="days" type="checkbox" name="saturday" value="true">
                            </div>
                            <div class="col-xs-2 day-title">
                                <label>SATURDAY</label>
                            </div>
                            <div class="col-xs-3 time-picker">
                                <label>From:<input type="text" class="times" id="saturday_hours_from"/></label>
                            </div>
                            <div class="col-xs-3 time-picker no-margin">
                                <label>To:
                                    <input type="text" class="times" id="saturday_hours_to"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    </div>
                    {{--<label class="control-label col-sm-2">Sunday</label> <input type="checkbox" name="sunday">--}}
                </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Smoking is allowed?</label>
                    </div>
                    <div class="col-xs-1">
                        <input type="checkbox" name="smoking_allowed"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Provide Delivery Service</label>
                    </div>
                    <div class="col-xs-1">
                        <input type="checkbox" name="delivery"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Website</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="website"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Location</label>
                    </div>
                    <div class="col-xs-6">
                        Add Map HERE
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="person form-group">
                    <div class="col-xs-5">
                         <label class="control-label">First Name</label>
                    </div>
                    <div class="col-xs-6">
                        <input  class="form-control"  type="text" name="first_name"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="person form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Last Name</label>
                    </div>
                    <div class="col-xs-6">
                        <input  class="form-control" type="text" name="last_name"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="person form-group">
                    <div class="col-xs-5">
                        <label class="control-label"> Date of Birth</label>
                    </div>
                    <div class="col-xs-6">
                        <input class="person form-control" type="text" name="date_of_birth" id="age"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Email</label>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control"  type="email" name="email"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="person">
                    <div class="col-xs-5">
                        <label class="control-label">Gender</label>
                    </div>
                    <div class="col-xs-6">
                        <select name="gender" id="gender">
                            @foreach($aData['aGender'] as $oGender_id => $oGender_name)
                                <option id="{{$oGender_id}}">{{$oGender_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn .btn-primary" id="registeration-form-submit-button">Done</button>
        </form>
        </div>
    </div>
    <div class="col-md-3">
    </div>
@stop