<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml>
    <head lang="es">
        <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
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
       
        

        <script>

        $(function(){               
                var userAgent = navigator.userAgent.toLowerCase();                
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
       
          <!-- Simular placeholder en internet explorer -->  <!-- FACEBOOK -->
        <script>
        window.fbAsyncInit = function() {
            FB.init({
            appId: '342711485817226',
            cookie: true,
            xfbml: true,
            oauth: true
            });
            FB.Event.subscribe('auth.login', function(response) {
            window.location.reload();
            });
            FB.Event.subscribe('auth.logout', function(response) {
            window.location.reload();
            });
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());

            function sendRequestToRecipients() {
            var user_ids = document.getElementsByName("user_ids")[0].value;
            FB.ui({method: 'apprequests',
            message: 'My Great Request',
            to: user_ids
            }, requestCallback);
        }

        function sendRequestViaMultiFriendSelector() {
            FB.ui({method: 'apprequests',
            message: 'hola <strong> caracola </strong>'
            }, requestCallback);
        }

        function requestCallback(response) {
            // Handle callback here
        }
        </script> 