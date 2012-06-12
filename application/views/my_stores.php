<section class="my-stores">
    <?php for($i=0; $i< count($stores); $i++){?>
    <?php
    $logo = $stores[$i]->logo == ""? $image_no_logo : $base_url_image."/".$stores[$i]->logo;
    
    $store_class = "";
    foreach($stores[$i]->st_categories as $cat){
        $store_class .= " $cat";
    }
    ?>
    <article class="store <?php echo $store_class; ?>" data-id="<?php echo $stores[$i]->id?>">
        <a href="#">
            <div>
                <img src="<?php echo $logo ?>" />
            </div>
        </a>
        <div class="store-link">
            <a href="<?php echo $stores[$i]->url ?>" target="blank_"><?php echo $stores[$i]->name ?></a>
        </div>
    </article>
    <?php } ?>
</section>
