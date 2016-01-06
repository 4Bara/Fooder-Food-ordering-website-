@extends('layouts.default')
@section('style')

@stop
@section('script')
    <script src="{{asset("../public/javascript/registeration.js")}}" ></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
@stop
@section('content')
    <input type="hidden" id="latitude" value="0"/>
    <input type="hidden" id="longitude" value="0"/>
    <div id="registeration_page_content" class="white-box">
            <h1 class="text-center m-b-30" >Registration Page</h1>
        <div id="form-container">
            <div class="row">
                <div class="col-md-12 question">
                    <div class="row">
                        <h3 class="m-b-30">What account type you are?</h3>
                    </div>
                    <div class="row">
                            <div class="col-md-6"><a class="btn btn-primary btn-block" id="person"><i class="glyphicon glyphicon-user"></i> Person</a></div>
                            <div class="col-md-6"><a class="btn btn-danger btn-block" id="restaurant"><i class="glyphicon glyphicon glyphicon-map-marker"></i> Restaurant</a></div>
                    </div>
                </div>
            </div>

        <form id="registeration-form" style="display:none"class="form-horizontal"  method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ Session::getToken() }}">
            <input type="hidden" style="display:none" id="person_option"     value="0" name="person"/>
            <input type="hidden" style="display:none" id="restaurant_option" value="0" name="restaurant"/>
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
                <div class="restaurant form-group">
                            <div class="col-xs-5"><label class="control-label">Restaurant Name</label>
                    </div>
                    <div class="col-xs-6">
                            <input class="form-control" type="text" name="restaurant_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
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
                    <label class="control-label">About us</label>
                    </div>
                    <div class="col-xs-6">
                    <textarea rows="5" class="form-control" type="text" name="bio"></textarea>
                    </div>
                </div>
                <div class="person form-group">
                    <div class="col-xs-5">
                        <label class="control-label">About me:</label>
                    </div>
                    <div class="col-xs-6">
                        <textarea rows="5" class="form-control" type="text" name="user_bio"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Profile Picture</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <img width="150px" id="photo" src="{{asset("../public/black-white.png")}}"/>
                            </div>
                            <div class="col-md-6">
                                <span class="btn btn-success btn-upload">
                                    Upload Picture
                                     <input type="file" class="form-control" id="photo-upload" name="logo"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label class="control-label">Country</label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <select name="id_country" id="countries">
                            {{--HERE YOU SHOULD PRINT THE VALUE OF COUNTRIES ARRAY--}}
                            @foreach($aData['aCountries'] as $oCountry)
                                <option id="{{$oCountry->id_country}}" value="{{$oCountry->id_country}}">{{$oCountry->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-md-5">
                       <label class="control-label">Food Type"Cuisine"</label>
                    </div>
                    <div class="col-md-6">
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
                                <div class="col-xs-2 time-picker no-margin">
                                    <label>To: <input  type="text" class="times" id="sunday_hours_to"/></label>
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
                                <label>To:
                                    <input type="text" class="times" id="thursday_hours_to"/>
                                </label>
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
                    <div class="col-xs-6">
                        <div class="row">
                       <label>
                           <input type="checkbox" name="smoking_allowed"/>
                           Check if the restaurant allows smoking inside!
                       </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="restaurant form-group">
                    <div class="col-xs-5">
                        <label class="control-label">Provide Delivery Service</label>
                    </div>
                    <div class="col-xs-6">
                        <div class="row">
                            <label>
                            <input type="checkbox" name="delivery"/>
                              Check if restaurant provide delivery!
                            </label>
                        </div>
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
                        <div id="googleMap" style="width: 350px; height: 350px"></div>
                        <input type="hidden" name="lat" id='marker-lat'/>
                        <input type="hidden" name="long"  id='marker-long'/>
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
            <button type="button" class="btn btn-success btn-block m-t-30" id="registeration-form-submit-button">Create Account</button>
        </form>
        </div>
    </div>
@stop