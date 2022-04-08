<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('greeva/assets/libs/select2/select2.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('greeva/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />
<style>
    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
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
                    <h3 class="text-white"><?= $cantidad_grupo ?></h3>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-xl-12">
        <div class="card-box">
            <div class="float-right">
                <select class="form-control" id="responsable" name="responsable" data-toggle="select2">
                    <option value="">-- todos --</option>
                    <?php foreach ($responsable as $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['nombres'] . ' ' . $value['apellidos'] ?></option>
                    <?php endforeach; ?>
                </select>
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
                    <tbody id="tbody-reports">

                    </tbody>
                </table>

            </div>

        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('greeva/assets/libs/select2/select2.min.js') ?>"></script>
<script>
    <?php if (session('msg')) : ?>
        Swal.fire({
            type: "<?= session('msg')['type'] ?>",
            title: "Bienvenido!!!",
            text: "<?= session('msg')['body'] ?>",
            confirmButtonColor: "#00e378"
        });
    <?php endif; ?>

    $.get('<?= base_url(route_to('reports')) ?>', {
        id: null,
    }, function(data) {
        $('#tbody-reports').html(data);
    });

    $("#responsable").select2()
    $("#responsable").change(function() {
        $("#tbody-reports").html('<tr><td colspan = "5"><center><div class="lds-dual-ring"></div></center></td></tr>');
        if ($(this).val() != '')
            id = $(this).val();
        else
            id = null;

        $.get('<?= base_url(route_to('reports')) ?>', {
            id: id,
        }, function(data) {
            $('#tbody-reports').html(data);
        });

    });
</script>
<?= $this->endSection() ?>