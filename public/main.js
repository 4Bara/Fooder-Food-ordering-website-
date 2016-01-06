/**
 * Created by Bara on 11/12/2015.
 */
jQuery(document).ready(function(){
$("#food_type").selectmenu();
$("#countries").selectmenu();
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 100,
        values: [ 5, 30 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );

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
                         $(".search-results").html(data);
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