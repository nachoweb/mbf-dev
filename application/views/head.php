<!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
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
        <!-- start Mixpanel --><script type="text/javascript">(function(c,a){window.mixpanel=a;var b,d,h,e;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src=("https:"===c.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.1.min.js';d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d);a._i=[];a.init=function(b,c,f){function d(a,b){var c=b.split(".");2==c.length&&(a=a[c[0]],b=c[1]);a[b]=function(){a.push([b].concat(Array.prototype.slice.call(arguments,0)))}}var g=a;"undefined"!==typeof f?
        g=a[f]=[]:f="mixpanel";g.people=g.people||[];h="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config people.identify people.set people.increment".split(" ");for(e=0;e<h.length;e++)d(g,h[e]);a._i.push([b,c,f])};a.__SV=1.1})(document,window.mixpanel||[]);
        mixpanel.init("0eaa229d09b331b0d650d1668b9ac53f");</script><!-- end Mixpanel -->
        <script>
        mixpanel.people.identify("<?php echo $user['id'] ?>");
        mixpanel.people.set({
            "$email": "<?php echo $user['email'] ?>",    // only special properties need the $
            "$last_login": new Date(),                   // properties can be dates...
            "gender": "<?php if($user['gender']==1) echo "male"; else echo "female"; ?>",    // feel free to define your own properties
            "name": "<?php echo $user['name'] ?>"
        });
        </script>
        
        

    </head>
    <body>
         <div id="fb-root"></div>
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
            console.log("ola");
            window.location('/main/checkFb');
            
            });
            FB.Event.subscribe('auth.logout', function(response) {
            window.location.reload();
            });         
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
            '//connect.facebook.net/en_ES/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=342711485817226";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

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