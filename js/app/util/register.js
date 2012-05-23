function checkUserMail(){
    document.getElementById('validated-register').value = true;
    var emailToCheck = jQuery('#register-email').val();
    if (emailToCheck != ''){
        console.log("http://localhost/closure/server/dev/register/check_mail/" + encodeURIComponent(emailToCheck));
        jQuery.ajax({
            url: "http://localhost/closure/server/dev/register/check_mail/" + encodeURIComponent(emailToCheck),
            async: false,
            success: function(respuesta){
                respuesta = jQuery.trim(respuesta);
                console.log(respuesta);
                if(respuesta == 'fail'){
                        jQuery("#register-info-email").text('Email ya en uso');
                        document.getElementById('validated-register').value=false;						
                }
                else{
                        jQuery("#register-info-email").text('');
                        if (document.getElementById('validated-register').value == 'true'){
                                document.getElementById('validated-register').value = true;
                        }
                }
            }
        });
    }
}


function checkLogin(){
    var correct = true; 
    var emailToCheck = jQuery('#register-email').val();
    if (emailToCheck != ''){
        console.log("http://localhost/closure/server/dev/register/check_mail/" + encodeURIComponent(emailToCheck));
        jQuery.ajax({
            url: "http://localhost/closure/server/dev/register/check_mail/" + encodeURIComponent(emailToCheck),
            async: false,
            success: function(respuesta){
                respuesta = jQuery.trim(respuesta);
                console.log(respuesta);
                if(respuesta == 'fail'){
                        jQuery("#register-info-email").text('Email ya en uso');
                        document.getElementById('validated-register').value=false;						
                }
                else{
                        jQuery("#register-info-email").text('');
                        if (document.getElementById('validated-register').value == 'true'){
                                document.getElementById('validated-register').value = true;
                        }
                }
            }
        });
    }
}


function form_register_validate(){
    document.getElementById('validated-register').value = true;
      
        if(document.getElementById('register-email').value==''){
            jQuery("#register-info-email").text('Rellene el campo email');
            document.getElementById('register-email').focus();
            document.getElementById('validated-register').value=false;
        }
        else if (!checkEmail(document.getElementById('register-email').value)){
            jQuery("#register-info-email").text('Correo no válido');
            document.getElementById('register-email').focus();
            document.getElementById('validated-register').value=false;
        }
        else{
            jQuery("#register-info-email").text('');
            checkUserMail();
        }
        
        if (document.getElementById('register-password1').value != document.getElementById('register-password2').value){
            jQuery("#register-info-password").text('Las contraseñas no coinciden');
            console.log("contraseñas no coinciden");
            document.getElementById('register-password1').focus();			
            document.getElementById('validated-register').value=false;
        }
       		
        if (document.getElementById('validated-register').value == 'true'){
            console.log("true");
            return true;
        }
        else{
            console.log("false");
            return false;
        }
}


function checkEmail(email){
    exp=/[a-zA-Z0-9ñÑ]+@[a-zA-Z0-9ñÑ]+\.[a-zA-Z]{2,3}$/;
    if (exp.test(email)){
            return true;
    }
    else{
            return false;
    };
}

$(document).ready(function() {
    $("#register-email").blur(function() { 
        console.log("email blur");
        checkUserMail();
    });
});