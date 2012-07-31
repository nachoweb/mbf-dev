<aside id="sidebar">
    <section id="menu-sidebar">
        <nav>
            <ul>
                <li><a href="#" id="menu_inicio" class="active">INICIO</a></li>
                <li><a href="#" id="menu_tiendas">TIENDAS</a></li>
                <li><a href="#" id="menu_mis_cosas">MIS COSAS</a></li>
                <li><a href="#" id="menu_sesiones">SESIONES</a>
                    <div id="notificaciones">
                        <div id="contenedor_not_products">
                            <div id="not-messages"><?php echo $notifications['messages'] ?></div>
                        </div>
                        <div id="contenedor_not_mensajes">
                            <div id="not-products"><?php echo $notifications['products'] ?></div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </section>
</aside>