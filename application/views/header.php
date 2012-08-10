<div id="bg-header">
    <header id="header">
        <div id="container-logo">
            <h1><a href="#section=inicio"><img id="logo" src="images/logotipo.png" alt="Mybuyfriends" /></a></h1>
            <?php 
                if($close_session){
            ?>
            <div id="header-tool">
                <div id="nick"> <span id="span-nick"><?php echo $nick ?></span> ▼ </div>
                <div id="user-options">
                    <ul id="menu-user">             
                        <li><a href="" id="menu_bookmarklet">Instalar botón MBF</a></li>
                        <li><a href="" onClick="close_session(); return false;">Cerrar sesión</a></li>                        
                   </ul>
                </div>
            <!--
                
                <div id="close-session">
                    <a href="#" onClick="close_session()" > Cerrar sesión </a>
                </div>
                <div>
                    <a href="#" id="menu_bookmarklet"> Mi BookMarklet </a>
                </div>
                <div id="refresh">
                 <!--   <a href="#" onClick="refresh()"> Actualizar <img id="img-refresh" src="<?php echo $site_url."images/refresh.png" ?>" </a> -->
             <!--   </div> 
            -->
            </div>
            
            
            <?php
                }
            ?>
        </div>
        <!-- ANALITICS -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-32182458-1']);
            _gaq.push(['_setDomainName', 'mybuyfriends.com']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
       
    </header>
</div>
 <div id="page">
    <div id="shadow" onClick="closePopup()">
    </div>
    <div id="popup">
    </div>
    <div id="popup-content">
    </div>