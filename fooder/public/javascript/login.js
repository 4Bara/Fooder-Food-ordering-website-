/**
 * Created by Bara on 11/23/2015.
 */
$(document).ready(function(){

    $("#login-button").on("click",function(){
        var data = $("#login-form").serialize();
        $.ajax({
            url:'login',
            type:'POST',
            data:data,
            success:function(data){

            }
        });
    });
});