@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/writeReview.js")}}" ></script>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <h1>Write a review</h1>
            </div>
            <form name="review" action="backend/submitReview" id="review-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input type="hidden" name="username" value="{{$data['username']}}"/>
                <div class="row">
                    <div class="col-md-8">
                        <textarea name="review" id="review-body" class="form-control" style="overflow: hidden; resize: none" cols="20" rows="12"></textarea>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <h3>How was it?</h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                             <input type="radio" name="rating" value="poor" class="form-control radio rating"/>
                            </div>
                            <div class="col-xs-6">
                                <p class="radio-text">POOR</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="radio" name="rating" value="good" class="form-control radio rating"/>
                            </div>
                            <div class="col-xs-6">
                                <p class="radio-text">Good</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="radio" name="rating" value="vGood" class="form-control radio rating"/>
                            </div>
                            <div class="col-xs-6">
                                <p class="radio-text" >Very Good</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="radio" name="rating" value="excellent" class="form-control radio rating"/>
                            </div>
                            <div class="col-xs-6">
                                <p class="radio-text">Excellent</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="radio" name="rating" value="extraordinary" class="form-control radio rating"/>
                            </div>
                            <div class="col-xs-6">
                                <p class="radio-text">Extraordinary</p>
                            </div>
                            <div class="col-xs-12">
                                <label>Upload an image:</label>
                                <input type="file" id="review-picture" name="review-picture" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <button class="form-control btn-success" type="submit" id="submit-review-buttion">Done</button>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@stop