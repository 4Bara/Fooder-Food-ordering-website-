$(document).ready(function(){
    $("#favorite").on("click",function(e){
        e.preventDefault();
        id_restaurant = $(this).val();
        favorite(id_restaurant,'restaurant');
    });


    function initialize() {
        var latitude = $('#latitude').val();
        var longitude= $('#longitude').val();
        var myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        var mapProp = {
            center:new google.maps.LatLng(myLatLng),
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("location-map"),mapProp);

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Our location!'
        });

    }

      google.maps.event.addDomListener(window, 'load', initialize);
$(window).on("l")

});