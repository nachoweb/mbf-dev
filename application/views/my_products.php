 <?php if(count($products) > 0){ ?>
<div id="menu-productos">
    <nav>
              <ul id="product_filters">
                <?php   for($i = 0; $i < count($categories); $i++){ ?>
                    <?php if($i == 0) { ?>
                        <li><a class="button active" href="#<?php echo $categories[$i]->name; ?>" data-name="<?php echo $categories[$i]->name; ?>" data-categoryid="0" data-filter=".<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name ?></a></li>
                    <?php }else{ ?>
                        <li><a class="button" href="#<?php echo $categories[$i]->name; ?>" data-name="<?php echo $categories[$i]->name; ?>" data-categoryid="<?php echo $categories[$i]->id; ?>" data-filter=".<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name ?></a></li>
                    <?php }    ?>
                  
               <?php  } ?>
            </ul>
    </nav>
</div>

<div id="add-category-div"><span id="add-category"> <div>+</div><div> <img src="<?php echo $base_url ?>images/carpeta.png">  </span></div></div>
<?php } ?>
<div id="container-productos">
   
        <?php        
        if(count($products) > 0){
            foreach ($products as $product){
                $id = $product->id;
                $image = $base_url_image."/".$product->image;
                $thumb = $base_url_image."/thumbs/".$product->image;
                $price = rawurldecode($product->price);
                $price == "" ? $price = "" : $price = $price." €";
                $product_url = rawurldecode($product->url);
                $store_name = rawurldecode($product->store_name);
                if(strlen($store_name) > 13){
                    $store_name = substr($store_name, 0, 10)."...";               
                }
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
                <article id="<?php echo $id ?>" class="producto <?php echo $cat_class; ?>" data-title="<?php echo $title; ?>" data-id="<?php echo $id;?>" data-store-url="<?php echo $store_url; ?>" data-img="<?php echo $image ?>" data-price="<?php echo $price ?>" data-brand="<?php echo $store_name ?>" data-description="<?php echo $description ?>" data-producturl="<?php echo $product_url; ?>" >
                    <div class="delete-product">
                    </div>
                    <div class="options-producto">
                            <a href="" class="producto-sesion"><div></div></a>
                            <a href="" class="producto-carpeta"><div></div></a>
                            <div class="tooltip-producto-sesion">
                                <div class="menu-tooltip-producto">
                                    <nav>
                                        <ul>
                                            <?php   foreach($sessions as $session){ ?>
                                            <?php if($session->name!= "myself"){ ?>
                                                <li><span onClick="add_product_sesion(<?php echo $id ?>, <?php echo $session->id ?>)" href="#<?php echo $session->name; ?>" data-sesionid="<?php echo $session->id; ?>" onClick=""><?php echo $session->name ?></span></li>
                                            <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="tooltip-producto-carpeta">
                                <div class="menu-tooltip-producto">
                                    <nav>
                                        <ul class="">
                                            <?php   foreach($categories as $category){ ?>
                                                <li><span data-categoryid="<?php echo $category->id; ?>" data-filter=".<?php echo $category->id; ?>" onClick="add_product_category(<?php echo "$id, $category->id"; ?>)"><?php echo $category->name ?></span></li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </div>
                    <a href="<?php echo $product_url ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Product', 'click_my_things' , 'owner'])">
                        <div class="container-img-producto">
                                <img src="<?php echo $thumb ?>" />
                        </div>
                    </a>
                    <div class="container-info-producto">
                            <div class="title-producto"><?php  echo $title ?></div>
                            <div class="price-brand-producto">
                                    <span class="price-producto"><?php echo $price ?></span>
                                    <span class="brand-producto"><a href="<?php echo $product_url ?>" target="_blank"><?php echo $store_name ?></a></span>
                            </div>
                    </div>
                </article>
            <?php   } /* END FOREACH */  ?> 
        <?php }else{ ?>        
         <article class="producto" style="background: none;height:924px;margin-top:-42px">
            <img src="images/productos_prueba.png"> 
         </article>
        <?php } ?>
           
    
</div>