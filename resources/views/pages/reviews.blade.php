@extends('layouts.default')
@section('style')
    <style>
        .reviews{
            text-align: center;
        }
        .review-row{
            border:1px solid black;
            margin:5px;
        }
        .review-row{
            padding:0px;
        }
        .review-image{
           width:100%;
        }
        .image-row{
            padding:2px;
        }
        .glyphicon-star{
            color:yellow;
        }
        .review-content{
            text-align: left;
        }
        .review-by,.rating,.body,.created-on{
            font-size:15pt;
         border:1px solid floralwhite;
        }

    </style>
@endsection
@section('content')
    <div class="col-md-2"></div>
    <div class="reviews col-md-8">
        <div class="row">
          <h2>Reviews</h2>
        </div>
        @foreach($aReviews as $aReview)
                <div class="review-row col-md-12 row">
                    <div class="col-md-3 image-row">
                        <img class="review-image" src="{{$aReview['image']}}"/>
                    </div>
                    <div class="col-md-9 review-content">
                        <div class="row">
                            <div class="col-md-6">
                              <p class="review-by">Review By :<span><a href="{{URL::asset('p/'.$aReview['username'])}}">{{$aReview['username']}}</a></span></p>
                            </div>
                            <div class="col-md-6">
                              <p class="created-on">{{$aReview['date_created']}}</p>
                            </div>
                        </div>
                        <div class="row rating">
                            Rating:
                            @for($i=0;$i<5;$i++)
                                @if($i<$aReview['rating'])
                                    <span class="glyphicon glyphicon-star"></span>
                                @else
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                @endif
                            @endfor
                        </div>
                        <div class="row body">
                            <p>{{$aReview['body']}} HAHAHAHAH this is my fake review just to test how it will be going</p>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
    <div class="col-md-2"></div>
@endsection
