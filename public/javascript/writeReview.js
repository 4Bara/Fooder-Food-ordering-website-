/**
 * Created by Bara on 12/8/2015.
 */

/**
 * Created by Bara on 11/24/2015.
 */
$(document).ready(function(){
    $("#submit-review-buttion").on('click',function(){
        var img = $('#review-picture').val();
        var data = new FormData($("#review-form"));
        $(":file").each(function(){
            data.append("picture",this);
        });
        $.ajax({
            url:'/backend/submitReview',
            data:data+encodeURIComponent(img),
            type:'POST',
            cache:false,
            contentType: false,
            processData: false,
            success:function(result){
                alert(result);
            }
        });
    });
});
