<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Editar Link
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Links
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('greeva/assets/libs/select2/select2.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('greeva/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="<?= base_url('/admin/link/' . $data['id']) ?>" id="frm-edit-link" method="POST">
                <div class=" form-group">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <label for="titulo">Título<span class="text-danger">*</span></label>
                    <select name="tipo_link_id" id="tipo_link_id" class="form-control" parsley-trigger="change" required>
                        <option value="">Seleccione una opción</option>
                        <?php foreach ($tipoLink as $tipo) : ?>
                            <option <?= $data['tipo_link_id'] == $tipo['id'] ? 'selected' : '' ?> value="<?= $tipo['id'] ?>"><?= $tipo['titulo'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-danger"><?= session('errors.tipo_link_id') ?></p>
                </div>

                <div class="form-group">
                    <label for="responsable_id">Responsable <span class="text-danger">*</span></label>
                    <select name="responsable_id" id="responsable_id" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <?php foreach ($responsable as $value) : ?>
                            <option <?= $data['responsable_id'] == $value['id'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['nombres'] . ' ' . $value['apellidos'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción<span class="text-danger">*</span></label>
                    <input type="text" name="descripcion" id="descripcion" parsley-trigger="change" data-parsley-pattern="^[a-zA-Z1-9áéíóúÁÉÍÓÚñÑ ]+$" class="form-control" value="<?= $data['descripcion'] ?>" required />
                    <p class="text-danger"><?= session('errors.descripcion') ?></p>
                </div>

                <div class="form-group">
                    <label for="url_corto">Url Corto<span class="text-danger">*</span></label>
                    <input type="text" id="url_corto" name="url_corto" class="form-control" data-parsley-pattern="^[a-zA-Z1-9\-]+$" value="<?= $data['url_corto'] ?>" required />
                    <p class="text-danger"><?= session('errors.url_corto') ?></p>
                </div>

                <div class="form-group">
                    <label for="link">Link<span class="text-danger">*</span></label>
                    <textarea name="link" id="link" class="form-control" rows="3" data-parsley-type="url" required><?= $data['link'] ?></textarea>
                    <p class="text-danger"><?= session('errors.link') ?></p>
                </div>

                <div class="form-group row mb-3">
                    <div class=" col-sm-9">
                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" id="redireccion_instantanea" name="redireccion_instantanea" <?= $data['redireccion_instantanea'] == 't' ? 'checked' : '' ?> value="<?= $data['redireccion_instantanea'] == 't' ? 'true' : 'false' ?>" />
                            <label for="redireccion_instantanea">
                                Redirección instantánea
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mb-0">
                    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                        Actualizar
                    </button>
                    <a href="<?= base_url('admin/link') ?>" class="btn btn-light waves-effect">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('greeva/assets/libs/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#frm-edit-link").parsley();
        $("#tipo_link_id").select2()
        $("#responsable_id").select2()
    });
</script>
<?= $this->endSection() ?>