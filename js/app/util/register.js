function checkUserMail(){
    document.getElementById('validated-register').value = true;
    var emailToCheck = jQuery('#register-email').val();
    if (emailToCheck != ''){
        console.log(base_url + "register/check_mail/" + encodeURIComponent(emailToCheck));
        jQuery.ajax({
            url: base_url + "register/check_mail/" + encodeURIComponent(emailToCheck),
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
    var success = true; 
    var emailToCheck = jQuery('#login-email').val();
    var passToCheck = jQuery('#login-password').val();
    var invitation = jQuery('#invitation').val();
    console.log("INVITATION" + invitation);
    if (emailToCheck != ''){
        if(passToCheck != ''){
            console.log(base_url + "register/check_login/" + encodeURIComponent(emailToCheck) + "/" + encodeURIComponent(passToCheck) + "/" + invitation);
            jQuery.ajax({
                url: base_url + "register/check_login/" + encodeURIComponent(emailToCheck) + "/" + encodeURIComponent(passToCheck) + "/" + invitation,
                async: false,
                success: function(respuesta){
                    respuesta = jQuery.trim(respuesta);
                    if(respuesta == 'fail'){
                        console.log("fail1");
                        jQuery("#info-login-email").text('Login incorrecto');
                        success = false;					
                    }
                    else{
                        console.log("success");
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
    return success;
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

    if (document.getElementById('register-password1').value == ""){
        jQuery("#register-info-password").text('Debes introducir una contraseña');  
        document.getElementById('validated-register').value=false;
    }else if (document.getElementById('register-password1').value != document.getElementById('register-password2').value){
        jQuery("#register-info-password").text('Las contraseñas no coinciden');
        console.log("contraseñas no coinciden");
        document.getElementById('register-password1').focus();			
        document.getElementById('validated-register').value=false;
    }
    
     if (document.getElementById('nick').value == ""){
        jQuery("#info-nick").text('Introduce un nick');  
        document.getElementById('validated-register').value=false;
    }

    if (document.getElementById('validated-register').value == 'true'){
        console.log("true");
        return true;
    }
    if(!($("#conditions").is(":checked"))){
        jQuery("#info-register-condiciones").text('Debes introducir una contraseña');
        document.getElementById('validated-register').value=false;
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
        checkUserMail();
    });
    
    $
});

function show_conditions(){
    myRef = window.open('condiciones','mywin',
'left=20,top=20,width=800,height=500,toolbar=1,resizable=0');
myRef.focus()
}