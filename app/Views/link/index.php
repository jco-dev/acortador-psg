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
<!-- Chartist Chart CSS -->
<link rel="stylesheet" href="<?= base_url('greeva/assets/libs/chartist/chartist.min.css') ?>">
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
                        <th>Responsable</th>
                        <th>Redirección</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th class="text-center">.::Acciones::.</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->

<!-- modal -->
<div class="modal fade bs-example-modal-xl" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Extra large modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modal-body">
                <div id="chart-with-area" class="ct-chart"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- fin modal -->

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
<script src="<?= base_url('assets/js/clipboard/clipboard.min.js') ?>"></script>

<script src="<?= base_url('greeva/assets/libs/chartist/chartist.min.js') ?>"></script>
<script src="<?= base_url('greeva/assets/libs/chartist/chartist-plugin-tooltip.min.js') ?>"></script>

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
                    mData: "responsable"
                },
                {
                    mData: "redireccion_instantanea",
                    bSortable: false,
                    mRender: function(data, type, row) {
                        if (data == "t") {
                            return '<span class="badge badge-info">SI</span>';
                        } else {
                            return '<span class="badge badge-secondary">NO</span>';
                        }
                    }
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
                        let base = "<?= base_url() ?>/r/" + full['url_corto']
                        return '<div class="btn-group mb-2"><button data-id= "' + data.id + '" data-descripcion= "' + data.descripcion + '" class="btn-reports btn btn-xs btn-purple waves-effect waves-light"><i class="dripicons-graph-line"></i></button>' +
                            '<a href="' + base + '" target="_blank" class="btn btn-xs btn-secondary waves-effect waves-light"><i class="dripicons-link"></i></a>' +
                            '<button data-toggle="message" data-text="' + base + '" class="btn-copy btn btn-xs btn-info waves-effect waves-light"><i class="dripicons-copy"></i></button>' +
                            '<a href="<?= base_url('admin/link/') ?>/' + data.id + '/edit" class="btn btn-xs btn-warning waves-effect waves-light"><i class="fas fa-edit"></i></a>' +
                            '<button data-id="' + data.id + '" class="btn-delete-link btn btn-xs btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>' +
                            '</div> ';
                    }
                }
            ],
            order: [
                [0, 'desc']
            ],
        }).on("click", "button.btn-delete-link", function(e) {
            let id = $(this).data('id');
            Swal.fire({
                title: "¿Estás seguro de eliminar el Link?",
                text: "confirma para eliminar el link",
                type: "error",
                showCancelButton: !0,
                confirmButtonColor: "#31ce77",
                cancelButtonColor: "#f34943",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
            }).then(function(t) {
                if (t.value) {
                    $.post('<?= base_url('/admin/link') ?>/' + id, {
                        id,
                        _method: "DELETE",
                        csrf_token_name: "<?= csrf_hash() ?>"
                    }, function(data) {
                        if (typeof data.type !== 'undefined' && data.type == 'success') {
                            Swal.fire({
                                title: "Eliminado!",
                                text: data.msg,
                                type: "success",
                                confirmButtonText: "OK",
                            }).then(function(t) {

                            });
                            tbl_link.ajax.reload();
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Error al eliminar el link.",
                                type: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    });
                }
            });

        }).on("click", "button.btn-copy", function(e) {
            let text = $(this).data('text');
            let el = $(this);
            const textCopied = ClipboardJS.copy(text);
            el.on('hidden.bs.tooltip', function() {
                el.html('<i class="dripicons-copy"></i>');
            });
            $(this).html('<i class="dripicons-checkmark"></i>');
            el.on('hidden.bs.tooltip', function() {
                // do something...
            })
            $('[data-toggle="message"]').tooltip({
                boundary: 'window',
                delay: {
                    show: 1000,
                    hide: 1000
                },
                trigger: 'click',
                placement: 'top',
                template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
            });
            setTimeout(function() {
                el.html('<i class="dripicons-copy"></i>');
            }, 1000);

        }).on('click', "button.btn-reports", function(e) {
            let id = $(this).data('id');
            let descripcion = $(this).data('descripcion');
            $('.modal-title').html('Reportes Estadísticos: ' + descripcion);

            $.ajax({
                url: '<?= base_url('admin/link/get_reports') ?>/' + id,
                type: 'GET',
            }).done(function(response) {
                if (response.length > 0) {
                    let lab = [];
                    let ser = [];
                    response.map(x => {
                        lab.push(x.fecha);
                        ser.push(x.total);
                    });
                    let chartist = new Chartist.Line("#chart-with-area", {
                        labels: lab,
                        series: [
                            ser
                        ]
                    }, {
                        low: 0,
                        showArea: !0,
                        plugins: [Chartist.plugins.tooltip()]
                    });
                    $("#modal").modal('show');
                    $('#modal').on('shown.bs.modal', function(e) {
                        chartist.update();
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "No hay reportes para este link.",
                        type: "error",
                        confirmButtonText: "OK",
                    });
                }
            });


        })

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