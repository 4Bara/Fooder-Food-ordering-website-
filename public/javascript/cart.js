/**
 * Created by Bara on 12/25/2015.
 */
$(document).ready(function() {
    $('.spinner').each(function () {
        $(this).spinner();
    });
    $("#shopping_cart_button").on("click", function () {
        $("#shopping_cart").toggle();
    });
    $("#checkout-button").on("click", function () {
        var items = [];
        $(".item").each(function () {
            var qty = $(this).children().find(".item_qty input").val();
            var id_item = $(this).children(".id_item").val();
            var spicy = $(this).children().find(".spicy input").val();
            var item = {
                id_item: id_item,
                qty: qty,
                spicy: spicy,
            };
            items.push(item);
        });
        var note=$("#note").val();
        var lat= $("#marker-lat").val();
        var long= $("#marker-long").val();
        var loc = {
            long:long,
            lat:lat
        };
        alert(note);
        $.ajax({
            url: 'checkout',
            type: 'post',
            data: {items: items,note:note,location:loc},
            success: function (response) {
                window.location.replace("/fooder/public");
            }
        });
    });
    $(".delete_button").on("click", function () {
        var remainSiblings = $(this).parent().parent().siblings(".item").length;
        if (remainSiblings == 0) {
            $(this).parent().parent().parent().remove();
        }
        $(this).parent().parent().remove();
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
        $("#marker-lat").val(position.coords.latitude);
        $("#marker-long").val(position.coords.longitude);
        initialize();
    }

    function initialize() {
        setTimeout(function () {
        }, 1000);
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        var mapProp = {
            center: new google.maps.LatLng(myLatLng),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        setTimeout(function () {
        }, 1000);
        google.maps.event.addListener(map, "idle", function () {
            google.maps.event.trigger(map, 'resize');
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            draggable: true,
            map: map,
            title: 'Move it to the location!'
        });

        google.maps.event.addListener(marker, 'dragend', function () {
            $("#marker-lat").val(marker.getPosition().lat);
            $("#marker-long").val(marker.getPosition().lng);
        });

    }
   google.maps.event.addDomListener(window, 'load', getLocation());
});