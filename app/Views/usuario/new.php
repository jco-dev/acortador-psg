<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Agregar Usuario
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Usuario
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="<?= base_url('/superadmin/usuario') ?>" id="frm-add-user" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ci" class="col-form-label required">Carnet de Identidad <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ci" name="ci" required value="<?= old('ci') ?>" />
                        <?= csrf_field() ?>
                        <p class="text-danger"><?= session('errors.ci') ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expedido" class="col-form-label">Expedido <span class="text-danger">*</span></label>
                        <select id="expedido" name="expedido" class=" form-control" required>
                            <option value="">Seleccione</option>
                            <option value="QR">QR</option>
                            <option value="LP">LP</option>
                            <option value="CH">CH</option>
                            <option value="CB">CB</option>
                            <option value="TR">TR</option>
                            <option value="PT">PT</option>
                            <option value="OR">OR</option>
                            <option value="SC">SC</option>
                            <option value="BE">BE</option>
                        </select>
                        <p class="text-danger"><?= session('errors.expedido') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombres" class="col-form-label">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="nombres" name="nombres" value="<?= old('nombres') ?>" required />
                        <p class="text-danger"><?= session('errors.nombres') ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paterno" class="col-form-label">Paterno <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="paterno" name="paterno" value="<?= old('paterno') ?>" required />
                        <p class="text-danger"><?= session('errors.paterno') ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="materno" class="col-form-label">Materno</label>
                        <input type="text" class="form-control" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" id="materno" name="materno" value="<?= old('materno') ?>" />
                        <p class="text-danger"><?= session('errors.materno') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="celular" class="col-form-label">Celular <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" parsley-trigger="change" data-parsley-pattern="^[0-9]+$" id="celular" name="celular" value="<?= old('celular') ?>" required />
                        <p class="text-danger"><?= session('errors.celular') ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="correo" class="col-form-label">Correo <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" parsley-trigger="change" data-parsley-type="email" data-par id="correo" name="correo" value="<?= old('correo') ?>" required />
                        <p class="text-danger"><?= session('errors.correo') ?></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
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
        $("#frm-add-user").parsley()
    });
</script>
<?= $this->endSection() ?>