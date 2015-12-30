/**
 * Created by Bara on 11/12/2015.
 */
jQuery(document).ready(function(){

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

    $(document).on("click","#search",function(e) {
        e.preventDefault();
        $(".search-result").html("");
        var data="";
        data = $("#search-filter-form").serialize();
        var searchTerm  = $("#search-term").val();
        data+="&searchTerm="+searchTerm;
        $.ajax({
            url:"search",
            data:data,
            type:"POST",
            success:function(data){
                results = JSON.parse(data);
                $(".search-results").html("")
                for(var i in results) {
                    result = results[i];
                    html = '<div class="search-result row">' + '<a href="http://localhost/fooder/public/p/' + result.username + '"><img id="logo" src="' + result.logo + '"/><p id="restaurant_name">' + result.restaurant_name + '</p><p id="price_range">Price Range:<span>' + result.price_range + '</span></p><p id="restaurant_rating">Overall Rating : <span>' + result.rating + '</span></p> <p id="location">Address:' + result.address + '</p> <p id="cuisines">Cuisines:' + result.cuisines + '</p> <p id="telephone">Tel:' + result.telephone + '</p></a></div>';
                    $(".search-results").append(html);
                }
            }
        });
        $('.main').addClass('pages').removeClass('.main');
        $('#slidehome').slideUp("fast");
    });
    $('login-button').on('click',function(){
       alert('yes');
    });
});