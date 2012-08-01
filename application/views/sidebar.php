<aside id="sidebar">
    <section id="menu-sidebar">
        <nav>
            <ul>
                <li><a href="#" id="menu_inicio" class="active">INICIO</a></li>
                <li><a href="#" id="menu_tiendas">TIENDAS</a></li>
                <li><a href="#" id="menu_mis_cosas">MIS COSAS</a></li>
                <li id="li-sesiones">
                    <a href="#" id="menu_sesiones">     
                        <div id="user-notifications">
                            <div id="user-notification-star">
                                <?php echo $notifications['messages'] + $notifications['products']; ?>
                            </div>
                        </div>
                        SESIONES                         
                    </a>
                </li>
            </ul>
        </nav>
    </section>
</aside>