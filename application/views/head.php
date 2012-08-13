<!doctype html>
<html>
    <head lang="es">
   <!--     <title>Mybuyfriends</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css"> -->
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
   <!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    
        <script src="./js/app/ui/popup.js"></script>
        <script src="./js/app/ui/sliders.js"></script>
        <script src="./js/app/ui/image_adjuster.js"></script>        
        <script src="./js/app/util/register.js"></script>
        <script src="./js/config.js"></script>
        <script src="./js/app/util/ajax.js"></script>
        <script src="./js/isotope.js"></script>
        <script src="./js/jquery-ui-1.8.21.custom.js"></script>-->
        
        
        <title>Mybuyfriends</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script src="./js/isotope.js"></script>
        <?php 
            if(isset($mbfjs) && !$mbfjs){
               
            }else{
                echo '<script src="./js/mbf.js"></script>';
            }
        ?>       
        <script src="./js/app/util/register.js"></script>
        <script src="./js/config.js"></script>
        <script src="./js/jquery.tipsy.js"></script>
        <script src="./js/jquery.ba-bbq.min.js"></script>
       
        <!-- Simular placeholder en internet explorer -->

        <script>

        $(function(){
                console.log("OLA");
                var userAgent = navigator.userAgent.toLowerCase();
                console.log(userAgent);
                jQuery.browser = {
                        version: (userAgent.match( /.+(?:rv|it|ra|ie|me)[\/: ]([\d.]+)/ ) || [])[1],
                        chrome: /chrome/.test( userAgent ),
                        safari: /webkit/.test( userAgent ) && !/chrome/.test( userAgent ),
                        opera: /opera/.test( userAgent ),
                        msie: /msie/.test( userAgent ) && !/opera/.test( userAgent ),
                        mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent )
                };
                if (jQuery.browser.msie){
                        console.log("ola");
                        if(!jQuery.support.placeholder) {
                                console.log("no soporta");
                                var active = document.activeElement;
                                jQuery(':text,textarea, :password').focus(function () {
                                        if (jQuery(this).attr('placeholder') != '' && jQuery(this).val() == jQuery(this).attr('placeholder')) {
                                                jQuery(this).val('').removeClass('hasPlaceholder');
                                        }
                                }).blur(function () {
                                        if (jQuery(this).attr('placeholder') != '' && (jQuery(this).val() == '' || jQuery(this).val() == jQuery(this).attr('placeholder'))) {
                                                jQuery(this).val(jQuery(this).attr('placeholder')).addClass('hasPlaceholder');
                                        }
                                });
                                jQuery(':text, textarea, :password').blur();
                                jQuery(active).focus();
                                jQuery('form').submit(function () {
                                        jQuery(this).find('.hasPlaceholder').each(function() {jQuery(this).val('');});
                                });
                        }
                }
        });

        </script>

        
        
        
      
    </head>
    <body>
       
           