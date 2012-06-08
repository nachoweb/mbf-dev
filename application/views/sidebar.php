<aside id="sidebar">
    <?php
    foreach($widgets as $widget){
        echo "<div class='widget' id='".$widget['id']."'>";
        echo $widget['html'];
        echo "</div>";
    }
    ?>
</aside>
