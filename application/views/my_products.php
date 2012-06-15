<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--  <div class="container-slider"  id="container-slider-products"> -->
 <!--    <section class="slider" id="slider-products"> -->
            <?php
            for($i=0; $i < count($products); $i++){
            ?>

            <?php if(($i)%12 == 0){  ?>
            <!-- Slider item <?php echo ($i)/3 ?> -->
 <!--           <div id="slider-item-<?php echo ($i)/3 ?>" class="slider-item">	 -->
            <?php } ?>
            <?php 
                $id = $products[$i]->id;
                $image = $base_url_image."/".$products[$i]->image;
                $thumb = $base_url_image."/thumbs/".$products[$i]->image;
                $price = rawurldecode($products[$i]->price);
                $price == "NS" ? $price = "" : $price = $price." €";
                $product_url = rawurldecode($products[$i]->url);
                $store_name = rawurldecode($products[$i]->store_name);
                $description = rawurldecode($products[$i]->description); 
                $description == "NS" ? $description = "" : $description = $description;
                $store_url = rawurldecode($products[$i]->store_url); 
                //Cat-class for isotope
                $cat_class = "";
                foreach($products[$i]->categories as $cat){
                    $cat_class .= " $cat";
                }
            ?>

            <article class="item <?php echo $cat_class; ?>" data-id="<?php echo $id;?>" data-store-url="<?php echo $store_url; ?>" data-img="<?php echo $image ?>" data-price="<?php echo $price ?>" data-brand="<?php echo $store_name ?>" data-description="<?php echo $description ?>" data-producturl="<?php echo $product_url; ?>">
                    <div class="container-item-img">
                            <img class="item-img image-fit" src="<?php echo $thumb ?>" onload="fit($(this))" />
                    </div>
                    <span class="item-price">
                    <?php if($products[$i]->price != "NS"){ ?>
                    <?php echo $products[$i]->price." €" ?>
                    <?php  }  ?>
                    </span>

                    <span class="item-brand"><a href="<?php echo $products[$i]->store_url; ?>"><?php echo $products[$i]->store_name; ?></a></span>
            </article>
            <?php if(($i+1)%12 == 0){ ?>
        <!--        </div> <!-- end slider item <?php echo ($i+1)/3 ?> -->
            <?php } ?>
            <?php 
            }
            ?>
   <!-- </section>
    <nav id="nav-slider">	 	
            <ul class="nav-list">
                    <li class="nav-item" id="slider-left"><img src="images/left.png"></li>
                    <li class="nav-item" id="slider-right"><img src="images/right.png"></li>
            </ul>
    </nav>
</div>	<!-- END SLIDER -->
