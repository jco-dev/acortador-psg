<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Listado de Links
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Links
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('greeva/assets/libs/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('greeva/assets/libs/datatables/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('greeva/assets/libs/datatables/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('greeva/assets/libs/datatables/select.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="float-right">
                <a href="<?= base_url('admin/link/new') ?>" class="btn btn-primary float-right">
                    <i class=" dripicons-plus"></i>
                    Agregar Link
                </a>
            </div>
            <br>
            <h4 class="header-title">&nbsp;</h4>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive wrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Url Corto</th>
                        <th>Persona</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>.::Acciones::.</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('greeva/assets/libs/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/responsive.bootstrap4.min.js') ?>"></script>

<script src="<?= base_url('greeva/assets/libs/datatables/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/buttons.print.min.js') ?>"></script>

<script src="<?= base_url('greeva/assets/libs/datatables/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/datatables/dataTables.select.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        let tbl_link = $("#datatable-buttons").DataTable({
            select: 'single',
            processing: true,
            serverSide: true,
            buttons: ["copy", "print"],
            ajax: {
                url: "<?= base_url('admin/link/get_data') ?>",
                type: "GET",
            },
            //data: mydata.data,
            aoColumns: [{
                    mData: "id"
                },
                {
                    mData: "titulo"
                },
                {
                    mData: "descripcion"
                },
                {
                    mData: "url_corto"
                },
                {
                    mData: "usuario"
                },
                {
                    mData: "creado_el"
                },
                {
                    mData: "estado",
                    bSortable: false,
                    mRender: function(data, type, row) {
                        if (data == "REGISTRADO") {
                            return '<span class="badge badge-success">REGISTRADO</span>';
                        } else {
                            return '<span class="badge badge-danger">ELIMINADO</span>';
                        }
                    }
                },
                {
                    mData: null,
                    bSortable: false,
                    mRender: function(data, type, full) {
                        return '<div class="btn-group mb-2"><a href="<?= base_url('admin/link/edit/') ?>' + data.id + '" class="btn btn-xs btn-purple waves-effect waves-light"><i class="dripicons-graph-line"></i></a>' +
                            '<a href="<?= base_url('admin/link/delete/') ?>' + data.id + '" class="btn btn-xs btn-secondary waves-effect waves-light"><i class="dripicons-link"></i></a>' +
                            '<a href="<?= base_url('admin/link/edit/') ?>' + data.id + '" class="btn btn-xs btn-info waves-effect waves-light"><i class="dripicons-copy"></i></a>' +
                            '<a href="<?= base_url('admin/link/edit/') ?>' + data.id + '" class="btn btn-xs btn-warning waves-effect waves-light"><i class="fas fa-edit"></i></a>' +
                            '<a href="<?= base_url('admin/link/delete/') ?>' + data.id + '" class="btn btn-xs btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></a>' +
                            '</div> ';
                    }
                }
            ],
            order: [
                [0, 'desc']
            ],
        });
        tbl_link.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
<script>
    <?php if (session('msg')) : ?>
        Swal.fire({
            type: "<?= session('msg')['type'] ?>",
            title: "Exito!!!",
            text: "<?= session('msg')['body'] ?>",
            confirmButtonColor: "#00e378"
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>