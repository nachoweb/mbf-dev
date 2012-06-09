<header class="widget-header">
    <h3 class="widget-title"><img src="images/categorias.png" alt="categorias" /></h3>
</header>
<section class="widget-body">
    <!-- Slider categorias -->
    <div class="container-slider" id="container-slider-categories">
        <section class="slider" id="slider-categories">
             <?php
            for($i=0; $i < count($categories); $i++){
            ?>

            <?php if(($i)%6 == 0){  ?>
            <!-- Slider item <?php echo ($i)/6 + 1 ?> -->
            <div id="slider-category-item-<?php echo ($i)/6 + 1 ?>" class="slider-item-categories">
                 <nav>
                    <ul id="filters">
            <?php } ?>
                        <li><a class="button" href="#a" data-categoryid="<?php echo $categories[$i]->id; ?>" data-filter=".<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name ?></a></li>
             <?php if(($i+1)%6 == 0){ ?>
                    </ul>
                </nav>
                </div> <!-- end slider category item <?php echo ($i+1)/6  ?> -->
            <?php } /* END IF  */?>
            <?php } /* END FOR */?>
            
        </section>
    </div>
    <a href="#" id="add-category">añadir categoría +</a>
</section>
<footer class="widget-footer">
    <nav id="nav-categories">	 	
        <ul class="nav-list">
            <li class="nav-item" id="slider-categories-left"><img src="images/left_small.png"></li>
            <li class="nav-item" id="slider-categories-right"><img src="images/right_small.png"></li>
        </ul>
    </nav>
</footer>
