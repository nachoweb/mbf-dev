<div id="menu-stores">
    <nav>
        <ul>
            <li><a href="#" id="button-tiendas-mbf" class="button active">TIENDAS MBF</a></li>
            <li><a href="#" id="button-mis-tiendas" class="button">MIS TIENDAS</a></li>
        </ul>
    </nav>
    <div class="bg-botonera">
            <div class="bg-botonera-left">						
            </div>
            <div class="bg-botonera-mid">							
            </div>
            <div class="bg-botonera-right">							
            </div>
    </div>
    </div>
    <div id="container-stores">
    <section id="tiendas-mbf">
            <?php foreach($members as $member){ ?>
            <article class="store" id="store_<?php echo $member->id; ?>">
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
                    <img src="<?php echo $base_url_image."/".$member->logo ?>" />
                </div>
                <div class="container-description-store">
                    <p>
                        <?php 
                            echo $member->description;
                        ?>
                    </p>
                </div>
            </article>
            <?php } ?>
    </section>
    <section id="mis-tiendas">
        <?php foreach($my_stores as $my_store){ ?>
            <article class="store" id="my_store_<?php echo $my_store->id ?>">
                <?php
                if ($my_store->offer == 1){
                    echo '<div class="bandera-verde"></div>';
                }
                if($my_store->notification == 1){
                    echo '<div class="bandera-naranja"></div>';
                }
                ?>
                <div class="options-store">
                    <a href="" class="sesion"><div></div></a>
                    <a href="<?php echo $my_store->url ?>" class="ir-tienda" target="_blank"><div></div></a>
                    <a href=="#" onClick="add_store_user(<?php echo $my_store->id ?>)" class="suscribirse"><div></div></a>
                    <span class="tooltip-sesion"></span>
                    <span class="tooltip-tienda"></span>
                    <span class="tooltip-guardar"></span>
                </div>
                <div class="container-img-store">
                    <img src="<?php echo $base_url_image."/".$my_store->logo ?>" />
                </div>
                <div class="container-description-store">
                    <p>
                        <?php 
                            echo $my_store->description;
                        ?>
                    </p>
                </div>
            </article>
        <?php } ?>
    </section>
</div>