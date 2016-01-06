/**
 * Created by Bara on 12/26/2015.
 */

$(document).ready(function(){
   $('.order_status').on('click',function(){
      var new_status = $(this).text();
      var id_order = $(this).parent().parent().find('.id_order').val();
       $(this).siblings(".btn-success").removeClass("btn-success").addClass("btn-danger").attr("disabled",false);
       $(this).removeClass("btn-danger").addClass("btn-success").attr("disabled",true);
       $.ajax({
          url:'updateOrderStatus',
           data:{new_status:new_status,id_order:id_order},
           type:'post',
           success:function(){

           }
       });
   });
    setInterval(function(){
     location.reload();
    },30000);

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Order', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

    $(".printer").on("click", function (e) {
        e.preventDefault();

       PrintElem($(this).parents(".print-class"));
    });

});