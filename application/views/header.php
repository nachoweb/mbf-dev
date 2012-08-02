<div id="bg-header">
    <header id="header">
        <div id="container-logo">
            <h1><a href=""><img id="logo" src="images/logotipo.png" alt="Mybuyfriends" /></a></h1>
            <?php 
                if($close_session){
            ?>
            <div id="header-tool">
                <div id="close-session">
                    <a href="#" onClick="close_session()" > Cerrar sesión </a>
                </div>
                <div>
                    <a href="#" id="menu_bookmarklet"> Mi BookMarklet </a>
                </div>
                <div id="refresh">
                 <!--   <a href="#" onClick="refresh()"> Actualizar <img id="img-refresh" src="<?php echo $site_url."images/refresh.png" ?>" </a> -->
                </div>
            </div>
            <?php
                }
            ?>
        </div>
       
    </header>
</div>
 <div id="page">
    <div id="shadow" onClick="closePopup()">
    </div>
    <div id="popup">
    </div>
    <div id="popup-content">
    </div>