<header class="widget-header">
    <h3 class="widget-title"><img src="images/categorias.png" alt="categorias" /></h3>
</header>
<section class="widget-body">
    <nav>
        <ul>
            <?php
            for ($i=0; $i < count ($categories); $i++){
            ?>
            <li><a href="#" class="button-img"><img src="images/boton_mis_productos.png" alt="mis productos" /></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <a href="#" id="add-category">añadir carpeta +</a>
</section>
<footer class="widget-footer">
</footer>
