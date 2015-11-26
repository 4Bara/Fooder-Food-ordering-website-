@extends('layouts.default')
@section('style')
    <script src="{{asset("../public/javascript/addItemPage.js")}}" ></script>
@stop
@section('content')
<div class="col-md-12">
    <div class="col-md-6 form-add-item">
        <div class="row title">
            <h3>Add New Item Page</h3>
        </div>
        <form method="post" name="add-new-item-form" action="backend/addNewItem" enctype="multipart/form-data" id="addNewItem">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <div class="row">
                <div class="col-xs-5">
                   <label>Food Name:</label>
                </div>
                <div class="col-xs-5">
                    <input type="text"  class="form-control" name="food_name"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Description:</label>
                </div>
                <div class="col-xs-5">
                    <textarea name="food_description" rows="7"  class="form-control" ></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Price:</label>
                </div>
                <div class="col-xs-5">
                    <input type="text"  class="form-control" name="food_price"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Calories:</label>
                </div>
                <div class="col-xs-5">
                    <input type="text"   class="form-control" name="food_calories"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Active Item:</label>
                </div>
                <div class="col-xs-5">
                    <input type="checkbox"  class="form-control" value="yes" name="food_status"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Spicy:</label>
                </div>
                <div class="col-xs-5">
                    <input type="checkbox"  class="form-control" value="yes" name="food_spicy"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Healthy:</label>
                </div>
                <div class="col-xs-5">
                    <input type="checkbox"  class="form-control" value="yes" name="food_healthy"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <label>Picture:</label>
                </div>
                <div class="col-xs-5">
                    <input type="file" class="form-control" id="food-img" name="food_picture"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <input type="submit"class="form-control" value="Add Item" />
                </div>
            </div>
        </form>
    </div>
</div>
@stop