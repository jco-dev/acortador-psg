<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Editar Usuario
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Usuario
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="<?= base_url('/superadmin/usuario/' . $data['id']) ?>" id="frm-edit-user" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ci" class="col-form-label required">Carnet de Identidad <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ci" name="ci" required value="<?= $data['ci'] ?>" />
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <p class="text-danger"><?= session('errors.ci') ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expedido" class="col-form-label">Expedido <span class="text-danger">*</span></label>
                        <select id="expedido" name="expedido" class=" form-control" required>
                            <option value="">Seleccione</option>
                            <?php
                            $dep = ['QR', 'LP', 'CH', 'CB', 'TR', 'PT', 'OR', 'SC', 'BE'];
                            foreach ($dep as $key => $value) { ?>
                                <option <?= $data['expedido'] == $value ? 'selected' : '' ?> value="<?= $value ?>"> <?= $value ?></option>
                            <?php } ?>


                        </select>
                        <p class="text-danger"><?= session('errors.expedido') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombres" class="col-form-label">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="nombres" name="nombres" value="<?= $data['nombres'] ?>" required />
                        <p class="text-danger"><?= session('errors.nombres') ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paterno" class="col-form-label">Paterno <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="paterno" name="paterno" value="<?= $data['paterno'] ?>" required />
                        <p class="text-danger"><?= session('errors.paterno') ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="materno" class="col-form-label">Materno</label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="materno" name="materno" value="<?= $data['materno'] ?>" />
                        <p class="text-danger"><?= session('errors.materno') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="celular" class="col-form-label">Celular <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" parsley-trigger="change" data-parsley-pattern="^[0-9]+$" id="celular" name="celular" value="<?= $data['celular'] ?>" required />
                        <p class="text-danger"><?= session('errors.celular') ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="correo" class="col-form-label">Correo <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" parsley-trigger="change" data-parsley-type="email" data-par id="correo" name="correo" value="<?= $data['correo'] ?>" required />
                        <p class="text-danger"><?= session('errors.correo') ?></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url("superadmin/usuario") ?>" class="btn btn-secondary">Cancelar</a>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#frm-edit-user").parsley()
    });
</script>
<?= $this->endSection() ?>