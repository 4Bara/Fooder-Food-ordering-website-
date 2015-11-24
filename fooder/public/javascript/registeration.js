/**
 * Created by Bara on 11/20/2015.
 */
$(document).ready(function() {
    $("#age").datepicker();
    $(".times").timepicker();
    $(".times").prop("disabled",true);
    $("#countries").selectmenu();
    $("#gender").selectmenu();
    $("#cuisines").selectmenu();
    $(".restaurant").hide();
    $("#person").on("click", function () {
        $(".restaurant").hide();
        $(".person").show();
    });
    $(".days").change(function(){
        if(this.checked) {
            var nameOfTheDay = $(this).attr("name");
            $("#"+nameOfTheDay+"_hours_from").prop("disabled",false);
            $("#"+nameOfTheDay+"_hours_to").prop("disabled",false);
        }else{
            var nameOfTheDay = $(this).attr("name");
            $("#"+nameOfTheDay+"_hours_from").prop("disabled",true);
            $("#"+nameOfTheDay+"_hours_to").prop("disabled",true);
        }
    });
    $("#restaurant").on("click",function(){
        $(".person").hide();
        $(".restaurant").show();
    });
    var base_url = "http://localhost/fooder/app/Http/Controllers";
    //This button will submit the registeration form
    $("#submit-button").on("click",function(){
        //if(!validate_form()){
        //    return false;
        //}
        var form_data = $("#registeration-form").serialize();
          $(".days:checked").each(function(){
              var dayname= $(this).attr("name");
              var from ='&'+dayname+"_from="+ $("#"+dayname+"_hours_from").val()+"&";
              var to = dayname+"_to="+ $("#"+dayname+"_hours_to").val();
              //put the results into form_data to be sent to php
            form_data+=from+to;
          });
        $.ajax({
            url:"addAccount",
            type:"POST",
            data:form_data,
            success:function(data){
                alert(data);
            }
        });
    });
    function validate_form(){
        aUserParams = ['username','password','first_name','last_name','email','id_country','date_of_birth','gender'];
        aRestaurantParams = ['username','password','restaurant_name','telephone'];
        if($("#person").is(":checked")){
           if(!checkform(aUserParams)){
               return false;
           }
        } else if($("#restaurant").is(":checked")){
            if(!checkform(aRestaurantParams)){
                return false;
            }
        }
        return true;
    }
    function checkform(aParams){
        for(i=0;i<aParams.length;i++) {
            ParamLabel = aParams[i].replace("_"," ");
            var param = $("input[name='"+aParams[i]+"']").val();
            if(param==""){
                alert("You have to fill "+ParamLabel+" Field");
                return false;
            }
        }
        //no errors in form param
        return true;
    }
});