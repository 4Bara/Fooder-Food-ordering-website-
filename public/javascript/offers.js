$(document).ready(function(){
    $("#favorite").on("click",function(e){
        e.preventDefault();
        id_menu = $(this).val();
        favorite(id_menu,'menu');
    });
    $('.spinner').each(function(){
        $(this).spinner();
        $(this).val(1);
    });
    $(".add-to-cart").on("click",function(){
        var dItemUnits   = $(this).parent().siblings().find(".item-count").find("input").val()
        var spicy        = $(this).parent().siblings().find(".item-spicy").find("select").val()
        var idItem       = $(this).parent().siblings(".information").find("#id_item").val();
        var idRestaurant = $(this).parent().siblings(".information").find("#id_restaurant").val();


        $.ajax({
            url:'addToCart',
            type:"POST",
            data:{
                    idItem:idItem,
                    amount:dItemUnits,
                    spicy:spicy,
                    idRestaurant:idRestaurant,
            },
            success:function(response){
                $('#shopping_cart_button').html(parseInt($('#shopping_cart_button').html())+1);
            }
         });
    });
});
