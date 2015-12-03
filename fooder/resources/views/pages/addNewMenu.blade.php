@extends('layouts.default')
@section('style')
    <script type="text/javascript" src="{{asset('../public/javascript/addNewMenu.js')}}" ></script>
    <link type="text/css" href="{{asset('../public/multi/css/multi-select.css)')}}" />
    <script src="{{asset('../public/javascript/multi/js/multiselect.js')}}"></script>
@stop
@section('content')
<div class="col-lg-3">
</div>
<div class="col-lg-6 add-menu">
        <div class="row">
            <div class="add-menu-title">
                @if($data['page_type']=='offer')
                    <h3>Make a New Offer</h3>
                @elseif($data['page_type']=='menu')
                    <h3>Make a New Menu</h3>
                @endif
            </div>
        </div>
    @if($data['page_type']=='menu')
        <form method="post" action="backend/addNewMenu" enctype="multipart/form-data" name="newMenuForm" id="add-new-menu">
    @else
        <form method="post" action="backend/addNewOffer" enctype="multipart/form-data" name="newMenuForm" id="add-new-menu">
    @endif
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <div class="row">
            <div class="col-xs-6">
                <p>Title</p>
            </div>
            <div class="col-xs-6">
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <p>Description</p>
            </div>
            <div class="col-xs-6">
                <textarea type="text" rows="5" name="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <p>Status<span style="color:lightgray">(Checked=active)</span></p>
            </div>
            <div class="col-xs-6">
                <input type="checkbox" value="active" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
               <p>Cover Picture</p>
            </div>
            <div class="col-xs-6">
                <input type="file" class="form-control" name="cover_picture"/>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4" style="text-align: center">
              <p>All Items</p>
            </div>
            <div class="col-xs-4" style="text-align: center">
                <p></p>
            </div>
            <div class="col-xs-4" style="text-align: center">
                @if($data['page_type']=='menu')
                 <p>Menu Items</p>
                @elseif($data['page_type']=='offer')
                 <p>Offer Items</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <select id="my-select" class="js-multiselect form-control" size="8" multiple="multiple">
                    @foreach($items as $item)
                        <option value="{{$item->id_item}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-4">
                    <button type="button" id="js_right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="js_right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    <button type="button" id="js_left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="button" id="js_left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>
            <div class="col-xs-4">
                <select name="food[]" id="js_multiselect_to_1" class="form-control" size="8" multiple="multiple"></select>
            </div>
        </div>
        @if($data['page_type']=='offer')
            <div class="row">
                <div class="col-xs-6"><p>Total Price:</p></div>
                <div class="col-xs-3"><input type="text" name="offer_price" class="form-control"/></div>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                @if($data['page_type']=='offer')
                    <button type="submit" id="menu-submit-button" class="form-control">Create Offer</button>
                @elseif($data['page_type'=='menu'])
                    <button type="submit" id="menu-submit-button" class="form-control">Create Offer</button>
                @endif
            </div>
        </div>
    </form>
</div>
<div class="col-lg-3">

</div>
@stop