$(document).ready(function(){
    $("#add_new_item_button").on('click',function(){
        var img = $('#food-img').val();
        //data = $('#addNewItem').serialize();
        data= new FormData($('#add-new-item-form'));
        $(':file').each(function() {
                data.append(this);
            });
        $.ajax({
            url:'/backend/addNewItem',
            type:'post',
            cache:false,
            contentType: false,
            processData: false,
            data:data+'r='+encodeURIComponent(img),
            success:function(data){
                alert(data);
            }
        });
    });


});
