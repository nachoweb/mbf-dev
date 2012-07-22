<div id="add_session_div">
    <a href="#" id="add_session"> + Crear sesión </a>
</div>
<div id="container-sesiones">	
    <?php
    foreach($sessions as $session){   
        if($session->name != "myself"){
    ?>
   
    <article class="sesion" onClick="prepare_session(<?php echo $session->id; ?>)">
          <!--  <div class="bandera-naranja"></div> -->
            <span class="sesion-title"><?php echo $session->name ?></span>
            <div class="container-avatar-sesion">
                    <img src="<?php echo $base_url_image ?>/avatar_sesion.jpg" />
            </div>
            <!-- <span class="name-sesion">Rufino</span> -->
            <span class="date-sesion"><?php echo $session->date ?></span>
    </article>  
    <?php
        }
    }
    ?>
</div> <!-- END CONTAINER-SESIONES -->