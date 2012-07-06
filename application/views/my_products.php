<div id="menu-productos">
    <nav>
            <ul id="product_filters">
                <?php   foreach($categories as $category){ ?>
                  <li><a class="button" href="#<?php echo $category->name; ?>" data-categoryid="<?php echo $category->id; ?>" data-filter=".<?php echo $category->id; ?>"><?php echo $category->name ?></a></li>
               <?php  } ?>
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
<div id="container-productos">
    <section id="productos-1">
        <?php
        foreach ($products as $product){
            $id = $product->id;
            $image = $base_url_image."/".$product->image;
            $thumb = $base_url_image."/thumbs/".$product->image;
            $price = rawurldecode($product->price);
            $price == "NS" ? $price = "" : $price = $price." €";
            $product_url = rawurldecode($product->url);
            $store_name = rawurldecode($product->store_name);
            $description = rawurldecode($product->description); 
            $description == "NS" ? $description = "" : $description = $description;
            $store_url = rawurldecode($product->store_url); 
            //Cat-class for isotope
            $cat_class = "";
            foreach($product->categories as $cat){
                $cat_class .= " $cat";
            }
        ?>
            <article class="producto <?php echo $cat_class; ?>" >
                    <div class="options-producto">
                            <a href="" class="producto-sesion"><div></div></a>
                            <a href="" class="producto-carpeta"><div></div></a>
                            <div class="tooltip-producto-sesion"></div>
                            <div class="tooltip-producto-carpeta">
                                <div id="menu-tooltip-producto">
                                    <nav>
                                        <ul>
                                            <?php   foreach($categories as $category){ ?>
                                             <li><a  href="#<?php echo $category->name; ?>" data-categoryid="<?php echo $category->id; ?>" data-filter=".<?php echo $category->id; ?>" onClick="add_product_category(<?php echo "$id, $category->id"; ?>)"><?php echo $category->name ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </div>
                    <div class="container-img-producto">
                            <img src="<?php echo $thumb ?>" />
                    </div>
                    <div class="container-info-producto">
                            <div class="title-producto">sin titulo</div>
                            <div class="price-brand-producto">
                                    <span class="price-producto">60 €</span>
                                    <span class="brand-producto"><a href="#">adidas.com</a></span>
                            </div>
                    </div>
            </article>
        <?php   } /* END FOREACH */  ?> 
           
    </section>
</div>