/**
 * Created by Bara on 12/25/2015.
 */
$(document).ready(function(){
    $('.spinner').each(function(){
        $(this).spinner();
    });
    $("#shopping_cart_button").on("click",function(){
        $("#shopping_cart").toggle();
    });
    $("#checkout-button").on("click",function(){
        var items=[];
        $(".item").each(function(){
            var qty=    $(this).children().find(".item_qty input").val();
            var id_item=$(this).children(".id_item").val();
            var spicy = $(this).children().find(".spicy input").val();
            var item={
                id_item:id_item,
                qty:qty,
                spicy:spicy
            };
            items.push(item);
        });

        $.ajax({
            url:'checkout',
            type:'post',
            data:{items:items},
            success:function(response){
                console.log(response);
            }
        });
    });
    $(".delete_button").on("click",function(){
        var remainSiblings = $(this).parent().parent().siblings(".item").length;
        if(remainSiblings == 0){
            $(this).parent().parent().parent().remove();
        }
        $(this).parent().parent().remove();
    });


});