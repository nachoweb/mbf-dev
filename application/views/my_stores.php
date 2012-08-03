<div class="menu-stores">
    <nav>
        <ul id="stores_filters">
            <li><a href="#" id="button-tiendas-mbf" class="button active" data-filter=".1,.2, .3,.4, .5,.6,.7">todo</a></li>
            <li><a href="#" class="button" data-filter=".1,.2,.3" id="st-menu-moda">moda</a></li>
            <li><a href="#" class="button" data-filter=".7">deporte</a></li>
            <li><a href="#" class="button" data-filter=".6">electrónica</a></li>
            <li><a href="#" class="button" data-filter=".5">ocio</a></li>
            <li><a href="#" class="button" data-filter=".4">hogar</a></li> 
        </ul>
    </nav>
    <div class="bg-botonera_N">
            <div class="bg-botonera-left_N">						
            </div>
            <div class="bg-botonera-mid_N">							
            </div>
            <div class="bg-botonera-right_N">							
            </div>
    </div>
</div>
<div class="menu-stores" id="menu-mis-tiendas">
    <nav>
         <li><a href="#" id="button-mis-tiendas" class="button">MIS TIENDAS</a></li>
    </nav>     
    <div class="bg-botonera_N">
            <div class="bg-botonera-left_N">						
            </div>
            <div class="bg-botonera-mid_N">							
            </div>
            <div class="bg-botonera-right_N">							
            </div>
    </div>
</div>
<div id="submenu-stores">
    <div id="submenu-moda">
        <ul>
            <li> <a href="#" data-filter=".1,.2,.3">todo</a> </li>
            <li> <a href="#" data-filter=".2">hombre</a> </li>
            <li> <a href="#" data-filter=".1">mujer</a> </li>
            <li> <a href="#" data-filter=".3">complementos</a> </li>
            
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
                        <a href="<?php echo $member->url ?>" target="_blank">
                            <img src="<?php echo $base_url_image."/".$member->logo ?>" />
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
                        <a href="<?php echo $member->url ?>" target="_blank">
                           <img src="<?php echo $base_url_image."/".$my_store->logo ?>" />
                        </a>                        
                    </div>
                </article>
            <?php } ?>
        </section>
    </div>
</div>