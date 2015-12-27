/**
 * Created by Bara on 12/26/2015.
 */

$(document).ready(function(){
   $('.order_status').on('change',function(){
      var new_status = $(this).val();
      var id_order = $(this).parent().parent().find('.id_order').val();

       $.ajax({
          url:'updateOrderStatus',
           data:{new_status:new_status,id_order:id_order},
           type:'post',
           success:function(){
               
           }
       });
   });
});