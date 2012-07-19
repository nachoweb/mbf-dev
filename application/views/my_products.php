<div id="menu-productos">
    <nav>
            <ul id="product_filters">
                <?php   foreach($categories as $category){ ?>
                  <li><a class="button" href="#<?php echo $category->name; ?>" data-categoryid="<?php echo $category->id; ?>" data-filter=".<?php echo $category->id; ?>"><?php echo $category->name ?></a></li>
               <?php  } ?>
            </ul>
    </nav>
</div>
<div id="add-category-div"><a href="#" id="add-category"> + añadir  </a></div>
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
            $title = rawurldecode($product->title);
            $title == "NS" ? $title = "" : $title = $title;
            //Cat-class for isotope
            $cat_class = "";
            foreach($product->categories as $cat){
                $cat_class .= " $cat";
            }
           
        ?>
            <article id="product_<?php echo $id ?>" class="producto <?php echo $cat_class; ?>" data-title="<?php echo $title; ?>" data-id="<?php echo $id;?>" data-store-url="<?php echo $store_url; ?>" data-img="<?php echo $image ?>" data-price="<?php echo $price ?>" data-brand="<?php echo $store_name ?>" data-description="<?php echo $description ?>" data-producturl="<?php echo $product_url; ?>" >
                <div class="options-producto">
                        <a href="" class="producto-sesion"><div></div></a>
                        <a href="" class="producto-carpeta"><div></div></a>
                        <div class="tooltip-producto-sesion">
                            <div id="menu-tooltip-producto">
                                <nav>
                                    <ul>
                                        <?php   foreach($sessions as $session){ ?>
                                            <li><a  onClick="add_product_sesion(<?php echo $id ?>, <?php echo $session->id ?>)" href="#<?php echo $session->name; ?>" data-sesionid="<?php echo $session->id; ?>" data-filter=".<?php echo $category->id; ?>" onClick=""><?php echo $session->name ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
                        <div class="title-producto"><?php  echo $title ?></div>
                        <div class="price-brand-producto">
                                <span class="price-producto"><?php echo $price ?></span>
                                <span class="brand-producto"><a href="<?php echo $store_url ?>" target="_blank"><?php echo $store_name ?></a></span>
                        </div>
                </div>
            </article>
        <?php   } /* END FOREACH */  ?> 
           
    </section>
</div>