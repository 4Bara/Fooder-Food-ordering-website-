/**
 * Created by Bara on 11/20/2015.
 */

$(document).ready(function() {
    $("#age").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2005',
        dateFormat: 'dd-mm-yy',
        defaultDate: new Date(1989, 00, 01)
    });
    $(".times").timepicker();
    $(".times").prop("disabled",true);
    $("#countries").selectmenu();
    $("#gender").selectmenu();
    $("#cuisines").selectmenu();
    $("#person").on("click", function (e) {
        e.preventDefault();
        $("#registeration-form").show();
        $(".restaurant").hide();
        $("#person_option").val(1);
        $("#restaurant_option").val(0);
        $(".person").show();
        $(".question").hide();
    });

    input = document.getElementById("photo-upload");
    if (input) {
        input.onchange = function () {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#photo').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    }

    $("#restaurant").on("click", function (e) {
        e.preventDefault();
        $("#registeration-form").show();
        $(".restaurant").show();
        $("#restaurant_option").val(1);
        $("#person_option").val(0);
        $(".person").hide();
        $(".question").hide();
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

    var base_url = "http://localhost/fooder/app/Http/Controllers";
    //This button will submit the registeration form
    $("#registeration-form-submit-button").on("click",function(e){
        e.preventDefault();
        if(!validate_form()){
            return false;
        }
        var form_data = new FormData($("#registeration-form")[0]);
       // form_data=$("#registeration-form").serialize();
          $(".days:checked").each(function(){
              var dayname= $(this).attr("name");
              var from ='&'+dayname+"_from="+ $("#"+dayname+"_hours_from").val()+"&";
              var to = dayname+"_to="+ $("#"+dayname+"_hours_to").val();
              //put the results into form_data to be sent to php
            form_data.append("from",from);
            form_data.append("to",to);
          });
        //$(":file").each(function(){
        //    var file = this.files[0];
        //});
        //console.log(form_data);
        $.ajax({
            url:"addAccount",
            type:"POST",
            processData: false,
            contentType: false,
            data:form_data,
            success:function(data){
                alert(data);
            }
        });
    });

    function validate_form(){
        aUserParams = ['username','password','first_name','last_name','email','id_country','date_of_birth','gender'];
        aRestaurantParams = ['username','password','restaurant_name','telephone'];
        if($("#person_option").val()==1){
           if(!checkform(aUserParams)){
               return false;
           }

        } else if($("#restaurant_option").val()==1){
            if(!checkform(aRestaurantParams)){
                return false;
            }
        }
        return true;
    }
    function onlyCharactersAllowed(param,sParam){
        if(!/^[a-zA-Z]+$/.test(param)){
            alert(sParam+' is not allowed');
            return false;
        }
    }
    function checkDate(date){
       var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
       if(!date_regex.test(date)){
           alert("Date value is wrong!");
           return false;
       }
    }
    function checkEmail(param){
        var re = /^(([^<>({)[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(param)){
            alert("Please enter a valid email format eg. : email@email.com");
            return false;
        }
    }

    function checkform(aParams){
        for(i=0;i<aParams.length;i++) {
            ParamLabel = aParams[i].replace("_"," ");
            var param = $("input[name='"+aParams[i]+"']").val();
            if(param==""){
                alert("You have to fill "+ParamLabel+" Field");
                return false;
            }
            switch(aParams[i]){
                case 'username':
                    onlyCharactersAllowed(param,aParams[i]);
                    break;
                case 'password':
                    if(param.length<8){
                        alert('The password must be at least 8 characters!');
                        return false;
                    }else if(param.length>50){
                        alert('The password must be less than 50 characters!');
                    }
                    break;
                case 'first_name':
                    onlyCharactersAllowed(param,"First Name");
                    break;
                case 'last_name':
                    onlyCharactersAllowed(param,"Last Name");
                    break;
                case 'date_of_birth':
                  //  checkDate(param);
                    break;
            }
        }
        //no errors in form param
        return true;
    }
    function getLocation() {
        if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
        initialize();
    }

    function initialize(){
        var latitude = $('#latitude').val();
        var longitude= $('#longitude').val();
        console.log("lat:"+latitude+" Longitude:"+longitude);
        var mapProp = {
            center:new google.maps.LatLng(latitude,longitude),
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        map.addListener('click',function(event){
            console.log(event.latLng.lat());
            console.log(event.latLng.lng());
        });
    }

   // google.maps.event.addDomListener(window, 'load', getLocation);
});


