<div id="menu-productos" class="menu-my-stores">
    <nav>
        <ul id="stores_filters">
            <li><a href="#section=tiendas&cat=todas" id="button-tiendas-mbf" class="button-small active" data-filter=".1,.2, .3,.4, .5,.6,.7">todo</a></li>
            <li><a href="#section=tiendas&cat=moda" class="button-small" data-filter=".1,.2,.3" id="st-menu-moda">moda</a></li>
            <li><a href="#section=tiendas&cat=deporte" class="button-small" data-filter=".7">deporte</a></li>
            <li><a href="#section=tiendas&cat=electronica" class="button-small" data-filter=".6">electrónica</a></li>
            <li><a href="#section=tiendas&cat=ocio" class="button-small" data-filter=".5">ocio</a></li>
            <li><a href="#section=tiendas&cat=hogar|" class="button-small" data-filter=".4">hogar</a></li> 
        </ul>
    </nav>
    <!--
    <div class="bg-botonera_N">
            <div class="bg-botonera-left_N">						
            </div>
            <div class="bg-botonera-mid_N">							
            </div>
            <div class="bg-botonera-right_N">							
            </div>
    </div>
    -->
</div>
<div class="menu-my-stores" id="menu-mis-tiendas">
    <nav>
        <ul>
            <li><a href="#section=tiendas&cat=mis_tiendas" id="button-mis-tiendas" class="button-small">MIS TIENDAS</a></li>
        </ul>
    </nav>     
    <!--
    <div class="bg-botonera_N">
            <div class="bg-botonera-left_N">						
            </div>
            <div class="bg-botonera-mid_N">							
            </div>
            <div class="bg-botonera-right_N">							
            </div>
    </div>
    -->
</div>
<div id="submenu-stores">
    <div id="submenu-moda">
        <ul>
            <li> <a id="submenu-todo" href="#section=tiendas&cat=moda_todo" data-filter=".1,.2,.3">todo</a> </li>
            <li> <a href="#section=tiendas&cat=hombre" data-filter=".2">hombre</a> </li>
            <li> <a href="#section=tiendas&cat=mujer" data-filter=".1">mujer</a> </li>
            <li> <a href="#section=tiendas&cat=complementos" data-filter=".3">complementos</a> </li>
            
        </ul>
    </div>
</div>
<div id="container-stores">
        <section id="tiendas-mbf">
                <?php foreach($members as $member){ 

                    $cat_class = "";
                    foreach($member->categories as $cat){
                        $cat_class .= " $cat";
                    }

                ?>
                <article class="store <?php echo $cat_class ?>" id="store_<?php echo $member->id; ?>">
                    <?php
                    if ($member->offer == 1){
                        echo '<div class="bandera-verde"></div>';
                    }
                    if( $member->notification == 1){
                        echo '<div class="bandera-naranja"></div>';
                    }
                    ?>
                    <div class="options-store">
                        <a href="" class="sesion"><div></div></a>
                        <a href="<?php echo $member->url ?>" class="ir-tienda" target="_blank"><div></div></a>
                        <a href="#" onClick="add_store_user(<?php echo $member->id ?>)" class="suscribirse"><div></div></a>
                        <span class="tooltip-sesion"></span>
                        <span class="tooltip-tienda"></span>
                        <span class="tooltip-guardar" ></span>
                    </div>
                    <div class="container-img-store">
                        <a href="<?php echo $member->url ?>" onClick="track_store('click','<?php echo $member->name ?>')" target="_blank">
                            <img src="<?php echo $base_url_image."/".$member->logo ?>" data-original="<?php echo $base_url_image."/".$member->logo ?>" />
                        </a>
                    </div>
                    <!--<div class="container-description-store">
                        <p>
                            <?php 
                                echo $member->description;
                            ?>
                        </p>
                    </div>-->
                </article>
                <?php } ?>
        </section>
 

        <section id="mis-tiendas">
            <?php foreach($my_stores as $my_store){ ?>
          
                <article class="my_store" id="my_store_<?php echo $my_store->id ?>">
                    <div class="container-img-store">
                        <?php
                            if($my_store->logo == ""){ 
                        ?>
                            <a href="<?php echo $my_store->url ?>" target="_blank">
                                <img src="<?php echo $base_url_image."/bolsa.png" ?>" />
                            </a>       
                        </div>
                        <div class="my_store_name">
                        <a href="<?php echo $my_store->url ?>" target="_blank">
                                <?php echo $my_store->name; ?>
                            </a> 
                        </div>
                        <?php
                            }else{ ?>
                                    <a href="<?php echo $my_store->url ?>" onClick="track_store('click','<?php echo $my_store->name ?>')" target="_blank">
                                        <img src="<?php echo $base_url_image."/".$my_store->logo ?>" />
                                    </a> 
                                    </div>
                        <?php   } ?>
                                               
                    
                </article>
            <?php } ?>
        </section>
    </div>
</div>