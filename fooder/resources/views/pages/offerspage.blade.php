@extends("layouts.default")
@section("style")
    <script src="{{asset("../public/javascript/offers.js")}}" ></script>
@stop
@section("content")
    <div class="col-md-3">
        Search Filter Form
    </div>
    <div class="col-md-6 offers-list">
        <div class="row">
          <label>Offers List</label>
        </div>
        <div class="row offer-list">
            <input type="hidden" name="id_offer" value="id_offer"/>
            <div class="col-xs-3">
                <img id="offer-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Wiktionary_small.svg/350px-Wiktionary_small.svg.png"/>
            </div>
            <div class="col-xs-9">
                <div class="col-xs-12">
                    <div class="row offer-title">
                        <p>Test Title</p>
                    </div>
                </div>
                <div class="row offer-desc">
                    <div class="col-xs-12">
                        <p>This is the offer's description,we might put a limit on the length of the offer's description later.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-9">
                        <button id="seeOffer" name="seeOffer">See Offer</button>
                        {{--<button id="saveOffer" name="getOffer">Save it!</button>--}}
                    </div>
                    <div class="col-lg-3">
                        <p>Rating:<span>2/5</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop