<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Editar Link
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Links
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
                    <input type="text" name="titulo" id="titulo" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" class="form-control" value="<?= $data['titulo'] ?>" required />
                    <p class="text-danger"><?= session('errors.titulo') ?></p>
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
<script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#frm-edit-link").parsley()
    });
</script>
<?= $this->endSection() ?>