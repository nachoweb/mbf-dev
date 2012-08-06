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
            
            if(strlen($session->name) > 14){
                $session->name = substr($session->name, 0, 11)."...";
            }
    ?>
   
    <article class="sesion" onClick="prepare_session(<?php echo $session->id.",".$messages.",".$products ?>)">
        <div class="sessions-left">         
            <div class="sessions-nick">
            <?php
                if(isset($nicks[$session->id])){
                    echo $nicks[$session->id];
                }else{
                    echo "<span class='pendiente'>pendiente...</span>";
                }               
            ?>
            </div>
            <div class="sessions-left-bottom">
                <div class="sesion-title">
                    <?php echo $session->name; ?>
                </div>
                <div class="date-sesion">
                    <?php echo $session->date ?>
                </div>
            </div>
        </div>
        <div class="sessions-right">
            <!-- NOTIFICACIONES DE MENSAJES -->
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
              <?php } ?>
            <!-- NOTIFICACIONES DE PRODUCTOS -->
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
          <!--
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
          </div>-->
    </article>  
    <?php
        }
    }
    ?>
</div> <!-- END CONTAINER-SESIONES -->