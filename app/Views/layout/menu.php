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
                <?php if (session('rol') === 'superadmin') : ?>
                    <li class="has-submenu">
                        <a href="<?= base_url('superadmin/usuario') ?>">
                            <i class="dripicons-user"></i>Usuarios
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="<?= base_url('superadmin/grupo') ?>">
                            <i class="dripicons-user-group"></i>Grupos
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>