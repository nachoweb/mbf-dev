<nav id="stores">
    <h3><img src="images/tiendas.png"></h3>
    <ul>
        <?php  foreach($stores as $store){ ?>
               <li><a href="<?php echo $store->url; ?>" target="blank"><?php echo $store->name;?></a></li>
        <?php  } ?>
    </ul>
</nav>