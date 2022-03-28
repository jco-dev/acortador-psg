<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Cuenta
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Cuenta
<?= $this->endSection() ?>


<?= $this->section("content") ?>

<div class="row">

    <!-- Right Sidebar -->
    <div class="col-lg-12">
        <div class="card-box">
            <div class="inbox-leftbar">
                <img src="<?= base_url('greeva/assets/images/users/avatar-4.jpg') ?>" alt="user-image" class="rounded-circle mx-auto d-block">
                <a href="javascript:void(0);" class="btn btn-danger btn-block waves-effect waves-light mt-2"> <?= session()->nombres . ' ' . session()->paterno ?> </a>

                <div class="mail-list mt-4">
                    <a href="javascript:void(0);" class="list-group-item border-0">
                        <i class="mdi mdi-email mr-2"></i>
                        <?= session()->correo ?>
                    </a>
                    <a href="javascript:void(0);" class="list-group-item border-0">
                        <i class="mdi mdi-cellphone mr-2"></i>
                        <?= session()->celular ?>
                    </a>
                </div>

            </div>

            <div class="inbox-rightbar">

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#perfil" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#contraseña" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            Contraseña
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#message" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Mensajes
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="perfil">
                        Perfil
                    </div>
                    <div class="tab-pane show active" id="contraseña">
                        <?php if (session('msg')) : ?>
                            <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                                <strong><?= session('msg.body') ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <form role="form" id="frm-change-password" method="POST" action="<?= base_url(route_to('cambiar-contraseña')) ?>">
                            <div class="form-group row">
                                <label for="contraseñaActual" class="col-sm-4 col-form-label">Contraseña actual<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <?= csrf_field() ?>
                                    <input type="password" class="form-control" id="contraseñaActual" name="contraseñaActual" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contraseñaNueva" class="col-sm-4 col-form-label">contraseña nueva<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" id="contraseñaNueva" name="contraseñaNueva" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repetirContraseña" class="col-sm-4 col-form-label">Confirmar Contraseña
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="repetirContraseña" name="repetirContraseña" data-parsley-equalto="#contraseñaNueva" required />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Guardar
                                    </button>
                                    <button type="reset" class="btn btn-light waves-effect">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="message">
                        Mensajes
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#frm-change-password").parsley()
    });
</script>
<?= $this->endSection() ?>