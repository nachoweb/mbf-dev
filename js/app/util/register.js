function checkUserMail(){
    document.getElementById('validated-register').value = true;
    var emailToCheck = jQuery('#register-email').val();
    if (emailToCheck != ''){
        
        jQuery.ajax({
            url: base_url + "register/check_mail/" + encodeURIComponent(emailToCheck),
            async: false,
            success: function(respuesta){
                respuesta = jQuery.trim(respuesta);
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
    var success = true; 
    var emailToCheck = jQuery('#login-email').val();
    var passToCheck = jQuery('#login-password').val();
    var invitation = jQuery('#invitation').val();   
    if (emailToCheck != ''){
        if(passToCheck != ''){
           
            jQuery.ajax({
                url: base_url + "register/check_login/" + encodeURIComponent(emailToCheck) + "/" + encodeURIComponent(passToCheck) + "/" + invitation,
                async: false,
                success: function(respuesta){
                    respuesta = jQuery.trim(respuesta);                    
                    if(respuesta == 'fail'){                        
                        jQuery("#info-login-email").text('Login incorrecto');
                        success = false;					
                    }
                    else{                      
                        success = true;
                    }
                }
            });
        }else{
             jQuery('#info-login-email').text('Debes especificar una');
        }
    }else{
        jQuery('#info-login-email').text('No has introducido ningún correo...');
        success = false;
    }   
    console.log("suecess:" + success);
    return success;
}


function form_register_validate(){
    jQuery(".form-info").text("");
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

    if (document.getElementById('register-password1').value == ""){
        jQuery("#register-info-password").text('Debes introducir una contraseña');  
        document.getElementById('validated-register').value=false;
    }else if (document.getElementById('register-password1').value != document.getElementById('register-password2').value){
        jQuery("#register-info-password").text('Las contraseñas no coinciden');       
        document.getElementById('register-password1').focus();			
        document.getElementById('validated-register').value=false;
    }
    
     if (document.getElementById('nick').value == ""){
        jQuery("#info-nick").text('Introduce un nick');  
        document.getElementById('validated-register').value=false;
     }else if(document.getElementById('nick').value.length > 10){
         jQuery("#info-nick").text('Máx. 10 caracteres');
         document.getElementById('validated-register').value=false;
     }
     if(!($("#conditions").is(":checked"))){
        jQuery("#info-register-condiciones").text('Debes aceptar las condiciones');
        document.getElementById('validated-register').value=false;
    }

    if (document.getElementById('validated-register').value == 'true'){
        
        return true;
    }

    else{
       
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
        checkUserMail();
    });
    
    $
});

