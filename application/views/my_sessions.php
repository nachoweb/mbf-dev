<div id="add_session_div">
    <a href="#" id="add_session" class="button">  Crear sesión </a>
</div>
<?php
    if(count($sessions)==1){ ?>
      <div class="tipsy tipsy-w" id="tool-tip-pedrito"><div class="tipsy-arrow"></div><div class="tipsy-inner">Crea una sesión, y podrás compartir tus productos con tus amigos</div></div>
<?php
    }
?>
<div id="container-sesiones">	
    
    <?php
    if(count($sessions)==1){        
        //echo "<img id='session_fake' src='".$base_url."/images/sessions_fake.png' >";
    }else{
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

    <a href="#section=session&id=<?php echo $session->id?>"><article id="session_<?php echo $session->id ?>" class="sesion"  data-messages="<?php echo $messages ?>" data-products="<?php echo $products ?>">
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
                   <!-- <div class="sesion-title">
                        <?php echo $session->name; ?>
                    </div> -->
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
        </article>  </a>
        <?php
            }
        }
        ?>
    <?php } /* END ELSE */ ?>
</div> <!-- END CONTAINER-SESIONES -->