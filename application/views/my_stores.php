<header class="widget-header">
    <h3 class="widget-title"><img src="images/mistiendas.png" alt="tiendas" /></h3>
</header>
<section class="widget-body">
    <!-- Slider stores -->
    <div class="container-slider" id="container-slider-stores">
        <section class="slider" id="slider-stores">
        <?php
        for($i=0; $i < count ($stores) ; $i++){
            if($i%4 == 0){ ?>
                <div id="slider-store-item-<?php echo $i+1 ?>" class="slider-item-stores">
                    <nav>
                        <ul>
      <?php }  ?>
                            <li><a href="<?php echo $stores[$i]->url; ?>" target="blank"><?php echo $stores[$i]->name;?></a></li>
      <?php    if(($i%4) + 1 == 0){ ?>              
                        </ul>
                    </nav>
                </div>
      <?php } /* END IF */ ?>
      <?php }/* END FOR */ ?>  
      <?php    if(($i%4) + 1 != 0){ ?>              
                        </ul>
                    </nav>
                </div>
      <?php } /* END IF */ ?>
            <div id="slider-store-item-2" class="slider-item-stores">
                <nav>
                    <ul>
                            <li><a href="#">adidas.com</a></li>
                            <li><a href="#">zara.com</a></li>
                            <li><a href="#">mango.com</a></li>
                            <li><a href="#">nike.com</a></li>
                    </ul>
                </nav>
            </div>
            <div id="slider-store-item-3" class="slider-item-stores">
                <nav>
                    <ul>
                            <li><a href="#">adidas.com</a></li>
                            <li><a href="#">zara.com</a></li>
                            <li><a href="#">mango.com</a></li>
                            <li><a href="#">nike.com</a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
</section>
<footer class="widget-footer">
    <nav id="nav-stores">	 	
            <ul class="nav-list">
                <li class="nav-item" id="slider-stores-left"><img src="images/left_small.png"></li>
                <li class="nav-item" id="slider-stores-right"><img src="images/right_small.png"></li>
            </ul>
    </nav>
</footer>