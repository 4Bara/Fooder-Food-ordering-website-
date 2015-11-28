/**
 * Created by Bara on 11/12/2015.
 */
jQuery(document).ready(function(){

var base_url = "http://localhost/fooder/app/Http/Controllers";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('#sign-up-button').on('click',function(){
        $.ajax({
            url:'registration',
            type:'get',
            data:{name:'bara'},
            success:function(data){
            }
        });
    });

    $('login-button').on('click',function(){
       alert('yes');
    });
});