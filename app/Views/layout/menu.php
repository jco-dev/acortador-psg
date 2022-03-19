<div class="topbar-menu">
    <div class="container-fluid">
        <div id="navigation">
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="<?= base_url(route_to('dashboard')) ?>">
                        <i class="dripicons-meter"></i>Inicio
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="<?= base_url('admin/link') ?>">
                        <i class="mdi mdi-link"></i>Links
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="<?= base_url(route_to('links')) ?>">
                        <i class="dripicons-user"></i>Usuarios
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="<?= base_url(route_to('links')) ?>">
                        <i class="dripicons-user-group"></i>Grupos
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="#"> <i class="dripicons-briefcase"></i>UI Elements <div class="arrow-down"></div></a>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li>
                                    <a href="#">Buttons</a>
                                </li>
                                <li>
                                    <a href="#">Modals</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>