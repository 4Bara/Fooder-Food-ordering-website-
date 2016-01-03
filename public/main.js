/**
 * Created by Bara on 11/12/2015.
 */
jQuery(document).ready(function(){
$("#food_type").selectmenu();
$("#countries").selectmenu();
var base_url = "http://localhost/fooder/app/Http/Controllers";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('#sign-up-button').on('click',function(){
        $.ajax({
            url:'registration',
            type:'get',
            success:function(response){
            }
        });
    });

    function favorite(id,type) {
        id_restaurant = $(this).val();
        $.ajax({
            url: '../favorite',
            type: "post",
            data: {'id_restaurant': id, 'type': type},
            dataType: 'json',
            success: function (response) {
                if (response.status == false) {
                }
            }
        });
    }
    $(document).on("click","#search",function(e) {
        e.preventDefault();
       // $(".search-result").html("");
        var data="";
        data = $("#search-filter-form").serialize();
        var searchTerm  = $("#main-search-term").val();
        $("#main-search-term").val("");
        data+="&searchTerm="+searchTerm;
        $.ajax({
            url:"search",
            data:data,
            type:"POST",
            dataType:"HTML",
            success:function(data){
               // console.log(data);
                //results = data;
                //$(".search-results").html("")
                //for(var i in results) {
                //    result = results[i];
                //    html = '<div class="search-result row">'
                //        + '<a href="http://localhost/fooder/public/p/' + result.username + '">' +
                //        '<img id="logo" src="' + result.logo + '"/>' +
                //        '<p id="restaurant_name">' +
                //             result.restaurant_name +
                //        '</p>' +
                //        '<p id="price_range">Price Range:<span>'
                //        + result.price_range + '</span></p><p id="restaurant_rating">Overall Rating : <span>' + result.rating + '</span></p> <p id="location">Address:' + result.address + '</p> <p id="cuisines">Cuisines:' + result.cuisines + '</p> <p id="telephone">Tel:' + result.telephone + '</p></a></div>';
                   $(".search-results").html(data);
                //}
            }
        });
        $('.main').addClass('pages').removeClass('.main');
        $('#slidehome').slideUp("fast");
    });
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        $('#lat').val(position.coords.latitude);
        $('#long').val(position.coords.longitude);
    }


    $("#shareLocation").on("click",function(e){
        e.preventDefault();
        $(".distance").show();
        $(this).find("span").html("Your Location is shared");
        $(this).removeClass("btn-primary");
        $(this).addClass("btn-success");
        getLocation();
    });



    $("#distance").on("change",function(){
        $("#kilo-dist").html($(this).val().toString());
    });
    $('login-button').on('click',function(){
       alert('yes');
    });
});