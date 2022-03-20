<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Listado de Grupos
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Grupo
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
            <h4 class="header-title">&nbsp;</h4>
            <table id="datatable-grupo" class="table table-striped table-bordered dt-responsive wrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>nombre</th>
                        <th>descripción</th>
                        <th>Creado</th>
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
        let tbl_grupo = $("#datatable-grupo").DataTable({
            select: 'single',
            processing: true,
            serverSide: true,
            buttons: ["copy", "print"],
            ajax: {
                url: "<?= base_url('superadmin/grupo/get_data') ?>",
                type: "GET",
            },
            //data: mydata.data,
            aoColumns: [{
                    mData: "id"
                },
                {
                    mData: "nombre"
                },
                {
                    mData: "descripcion"
                },
                {
                    mData: "creado_el"
                },
                {
                    mData: "estado",
                    bSortable: false,
                    mRender: function(data, type, row) {
                        if (data == "REGISTRADO") {
                            return '<span class="badge badge-info">REGISTRADO</span>';
                        } else if (data == "ACTIVO") {
                            return '<span class="badge badge-success">ACTIVO</span>';
                        } else {
                            return '<span class="badge badge-danger">ELIMINADO</span>';
                        }
                    }
                },
                {
                    mData: null,
                    bSortable: false,
                    mRender: function(data, type, full) {
                        return '<div class="btn-group mb-2">' +
                            '<a href="#" class="btn btn-xs btn-warning waves-effect waves-light"><i class="fas fa-edit"></i></a>' +
                            '<button data-id="' + data.id + '" class="btn-delete-grupo btn btn-xs btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>' +
                            '</div> ';
                    }
                }
            ],
            order: [
                [0, 'desc']
            ],
        });

        tbl_grupo.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
</script>
<?= $this->endSection() ?>