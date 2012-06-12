<header class="widget-header">
    <h3 class="widget-title"><img src="images/mistiendas.png" alt="tiendas" /></h3>
</header>
<section class="widget-body">
    <!-- Slider stores -->
    <div class="container-slider" id="container-slider-stores">
        <section class="slider" id="slider-stores">
            <?php
            for($i=0; $i < count($st_categories); $i++){
            ?>
                <?php if(($i)%6 == 0){  ?>
                <!-- Slider item <?php echo ($i)/6 + 1 ?> -->
                <div id="slider-store-item-<?php echo ($i)/6 + 1 ?>" class="slider-item-stores">
                        <nav>
                        <ul id="filters-stores">
                            <?php } ?>
                            <li><a class="button" href="#a" data-categoryid="<?php echo $st_categories[$i]->id; ?>" data-filter=".<?php echo $st_categories[$i]->id; ?>"><?php echo $st_categories[$i]->name ?></a></li>
                    <?php if(($i+1)%6 == 0){ ?>
                        </ul>
                    </nav>
                    </div> <!-- end slider st-categories item <?php echo ($i+1)/6  ?> -->
                <?php } /* END IF  */?>
            <?php } /* END FOR */?>
        </section>
    </div>
    <a href="#" id="add-category-store">añadir categoría +</a>
</section>
<footer class="widget-footer">
    <nav id="nav-stores">	 	
        <ul class="nav-list">
            <li class="nav-item" id="slider-stores-left"><img src="images/left_small.png"></li>
            <li class="nav-item" id="slider-stores-right"><img src="images/right_small.png"></li>
        </ul>
    </nav>
</footer>

