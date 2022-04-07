<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-xl-4">
        <div class="card-box widget-chart-one gradient-success bx-shadow-lg">
            <div class="float-left" dir="ltr">
                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="<?= $cantidad_link ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
            </div>
            <div class="widget-chart-one-content text-right">
                <p class="text-white mb-0 mt-2">Registros Links</p>
                <h3 class="text-white"><?= $cantidad_link ?></h3>
            </div>
        </div>
    </div>
    <?php if (session('rol') === 'superadmin') : ?>
        <div class="col-xl-4">
            <div class="card-box widget-chart-one gradient-info bx-shadow-lg">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="<?= $cantidad_persona ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                </div>
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Usuarios Registrados</p>
                    <h3 class="text-white"><?= $cantidad_persona ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-box widget-chart-one gradient-danger bx-shadow-lg">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="<?= $cantidad_grupo ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                </div>
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Grupos</p>
                    <h3 class="text-white"><?= $cantidad_persona ?></h3>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-xl-12">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>
            <h4 class="header-title mb-4">Historial de cursos más visitados</h4>


            <div class="table-responsive">
                <table class="table table-centered table-hover mb-0" id="datatable">
                    <thead>
                        <tr>
                            <th class="border-top-0">Responsable</th>
                            <th class="border-top-0">descripción</th>
                            <th class="border-top-0">url corto</th>
                            <th class="border-top-0">Creado el</th>
                            <th class="border-top-0">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($listado) > 0) { ?>
                            <?php foreach ($listado as $value) : ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url('greeva/assets/images/users/avatar-2.jpg') ?>" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ml-2"><?= $value['responsable'] ?></span>
                                    </td>
                                    <td>
                                        <span class="ml-2"><?= $value['descripcion'] ?></span>
                                    </td>
                                    <td><?= $value['url_corto'] ?></td>
                                    <td><?= $value['creado_el'] ?></td>
                                    <td><span class="badge badge-pill badge-purple text-dark"><?= $value['total'] ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5">No hay registros</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    <?php if (session('msg')) : ?>
        Swal.fire({
            type: "<?= session('msg')['type'] ?>",
            title: "Bienvenido!!!",
            text: "<?= session('msg')['body'] ?>",
            confirmButtonColor: "#00e378"
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>