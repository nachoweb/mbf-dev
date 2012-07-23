<div id="dentro-sesion-left">					
    <section id="sesion-info">
            <!--<div id="sesion-creator">Sesión con <span>Rufino</span></div>-->
            <div id="sesion-title">Título: <span><?php echo $session->name; ?></span></div>
            <div id="sesion-date">Creada el <span><?php echo $session->date ?></span></div>
    </section>
    <section id="sesion-chat">
    <?php foreach ($messages as $message){  ?>
        <div class="sesion-message">
                    <div class="sesion-message-left">
                            <span class="sesion-message-name"><?php echo $message->nick ?></span>
                            <span class="sesion-message-time"><?php echo $message->date ?></span>
                    </div>
                    <div class="sesion-message-right">
                            <p class="sesion-message-text">
                                    <?php echo $message->text ?>
                            </p>
                    </div>
            </div>        
    <?php }   ?>		
    </section> <!-- End session chat -->
    <div id="container-new-message">
            <textarea id="new-message" data-session="<?php echo $session->id ?>" data-user="<?php echo $user->nick ?>" data-last="<?php echo $last_message ?>"></textarea>
    </div>
</div> <!-- End dentro left -->
<div id="dentro-sesion-right">	
    <?php
     foreach ($products as $product){
            $id = $product->id;
            $image = $base_url_image_product."/products/".$product->image;
            $thumb = $base_url_image_product."/thumbs/".$product->image;
            $price = rawurldecode($product->price);
            $price == "NS" ? $price = "" : $price = $price." €";
            $product_url = rawurldecode($product->url);
            $title = rawurldecode($product->title);
            $title == "NS" ? $title = "" : $title = $title;
            $store_name = rawurldecode($product->store_name);
            $description = rawurldecode($product->description); 
            $description == "NS" ? $description = "" : $description = $description;
            $store_url = rawurldecode($product->store_url); 
    ?>
    <article id="<?php echo $id ?>" class="producto" data-title="<?php echo $title; ?>" data-id="<?php echo $id;?>" data-store-url="<?php echo $store_url; ?>" data-img="<?php echo $image ?>" data-price="<?php echo $price ?>" data-brand="<?php echo $store_name ?>" data-description="<?php echo $description ?>" data-producturl="<?php echo $product_url; ?>" >
            <div class="options-producto">
                    <a href="" class="producto-sesion"><div></div></a>
                    <a href="" class="producto-carpeta"><div></div></a>
                    <div class="tooltip-producto-sesion"></div>
                    <div class="tooltip-producto-carpeta">
                            <div id="menu-tooltip-producto">
                                    <nav>
                                            <ul>
                                                    <li><a href="#" id="button-productos-1" class="active">camisetas</a></li>
                                                    <li><a href="#" id="button-productos-2">regalo alex</a></li>
                                                    <li><a href="#" id="button-productos-3">mix</a></li>
                                            </ul>
                                    </nav>
                            </div>
                    </div>
            </div>
            <div class="container-img-producto">
                    <img src="<?php echo $thumb ?>" />
            </div>
            <div class="container-info-producto">
                    <div class="title-producto"><?php echo $title ?></div>
                    <div class="price-brand-producto">
                            <span class="price-producto"><?php echo $price ?></span>
                            <span class="brand-producto"><a href="<?php echo $store_url; ?>" target="_blank"><?php echo $store_name?></a></span>
                    </div>
            </div>
    </article>
   <?php } ?>
</div>  <!-- End dentro right -->