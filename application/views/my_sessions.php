<div id="add_session_div">
    <a href="#" id="add_session"> + Crear sesión </a>
</div>
<div id="container-sesiones">	
    <?php
    foreach($sessions as $session){   
        if($session->name != "myself"){
            if(isset($notifications['messages'][$session->id])){
                $messages = $notifications['messages'][$session->id];
            }else{
                $messages = 0;
            }
            if(isset($notifications['products'][$session->id])){
                $products = $notifications['products'][$session->id];
            }else{
                $products = 0;
            }
    ?>
   
    <article class="sesion" onClick="prepare_session(<?php echo $session->id.",".$messages.",".$products ?>)">
          <!--  <div class="bandera-naranja"></div> -->
            <!--<span class="sesion-title"><?php echo $session->name ?></span>-->
          <!--  <div class="container-avatar-sesion">
                    <img src="<?php echo $base_url_image ?>/avatar_sesion.jpg" />
            </div>
            <!-- <span class="name-sesion">Rufino</span> -->
            <!-- <span class="date-sesion"><?php echo $session->date ?></span> -->
          
          <div class="sessions-top">
              <div class="sessions-avatar">
                  
              </div>
              <div class="sessions-nick">
                <?php
                if(isset($nicks[$session->id])){
                    echo $nicks[$session->id];
                }else{
                    echo "<span class='pendiente'>Pendiente...</span>";
                }               
                ?>
              </div>
          </div>
          <div class="sessions-bot">
              <div class="sessions-notifications">
                 
                <?php
                if(isset($notifications['messages'][$session->id])){ 
                ?>
                    <div class="contenedor_not_mensajes">
                        <div class="not-messages"> <?php echo $notifications['messages'][$session->id]; ?></div>
                    </div>
                <?php    
                }else{ ?>
                    <div class="contenedor_not_mensajes_0">
                        <div class="not-messagess"></div>
                    </div>
              <?php }
                ?>                       
                       
                 <?php
                    if(isset($notifications['products'][$session->id])){?>
                    <div class="contenedor_not_products">
                        <div class="not-products"> <?php echo $notifications['products'][$session->id]; ?></div>
                    </div>
                  <?php
                  }else{?>
                    <div class="contenedor_not_products_0">
                        <div class="not-products"></div>
                    </div>
                  <?php
                  }
                  ?>    
                
              </div>
              <div class="date-sesion">
                 <?php echo $session->date ?>
              </div>
          </div>
    </article>  
    <?php
        }
    }
    ?>
</div> <!-- END CONTAINER-SESIONES -->