$(document).ready(function(){
    $(".js-multiselect").multiselect({
        right: '#js_multiselect_to_1',
        rightAll: '#js_right_All_1',
        rightSelected: '#js_right_Selected_1',
        leftSelected: '#js_left_Selected_1',
        leftAll: '#js_left_All_1'
    });

    $('#menu-submit-button').on('submit',function(){

        data= new FormData($('#add-new-menu'));
        $(':file').each(function() {
            data.append(this);
        });
        $.ajax({
            url:'/backend/addNewMenu',
            type:'POST',
            cache:false,
            contentType: false,
            processData: false,
            data:data+'r='+encodeURIComponent(img),
            success:function(data){
                alert(data);
            }
        });
    });
    //$(".multiselect").multiselect({sortable: false, searchable: false});

});