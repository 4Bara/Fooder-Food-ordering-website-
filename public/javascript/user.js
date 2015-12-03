/**
 * Created by Bara on 11/24/2015.
 */
$(document).ready(function(){

    $("#compliment").on("click",function(){
        id_user = $('#id_user').val();
        user_token = $("#token").val();
        data= {
            'id_user': id_user,
            '_token': user_token
        };
        $.ajax({
            url:'../addLike',
            type:'POST',
            data:data,
            success:function (data){
                $('#compliment').hide();
            }
        });
    });

    $("#follow").on("click",function(){
        id_user = $('#id_user').val();
        user_token = $("#token").val();
        id_visitor = $("#visitor_id").val();
        data= {
            'id_user': id_user,
            'id_visitor':id_visitor,
            '_token': user_token
        };
        $.ajax({
            url:'../follow',
            type:'POST',
            data:data,
            success:function (data){
                $('#follow').text("Unfollow");
            }
        });
    });

});