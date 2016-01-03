$(document).ready(function(){
    $("#favorite").on("click",function(e){
        e.preventDefault();
        id_restaurant = $(this).val();
        favorite(id_restaurant,'restaurant');
    });
});