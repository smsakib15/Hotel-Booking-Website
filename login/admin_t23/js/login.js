jQuery(document).ready(function($){
    $('.show-password').on('click',function(){
       if($(this).hasClass('fa-eye')) {
           $(this).removeClass('fa-eye');
           $(this).addClass('fa-eye-slash');
           $(this).parent('.relative').find('input').attr('type','text');
       }else{
           $(this).addClass('fa-eye');
           $(this).removeClass('fa-eye-slash');
           $(this).parent('.relative').find('input').attr('type','password');
       }
    });
});