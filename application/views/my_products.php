<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container-slider">
        <section class="slider">
                <?php
                for($i=0; $i < count($products); $i++){
                ?>
            
                <?php if(($i)%3 == 0){  ?>
                <!-- Slider item <?php echo ($i)/3 ?> -->
                <div id="slider-item-1" class="slider-item">	
                <?php } ?>
                        <article class="item">
                                <div class="container-item-img">
                                        <img class="item-img image-fit" src="<?php echo rawurldecode($products[$i]->image) ?>" onload="fit($(this))" />
                                </div>
                            
                                <span class="item-price">
                                 <?php if($products[$i]->price != "NS"){ ?>
                                 <?php echo $products[$i]->price ?> €
                                 <?php  }  ?>
                                </span>
                           
                                <span class="item-brand"><a href="<?php echo $products[$i]->store_url; ?>"><?php echo $products[$i]->store_name; ?></a></span>
                        </article>
                <?php if($i+1%3 == 0){ ?>
                    </div> <!-- end slider item <?php echo ($i+1)/3 ?> -->
                <?php } ?>
                <?php 
                }
                ?>
        </section>
        <nav id="nav-slider">	 	
                <ul class="nav-list">
                        <li class="nav-item" id="slider-left"><img src="images/left.png"></li>
                        <li class="nav-item" id="slider-right"><img src="images/right.png"></li>
                </ul>
        </nav>
</div>	<!-- END SLIDER -->