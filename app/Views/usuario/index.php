<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Listado de Usuarios
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Usuarios
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
                <a href="<?= base_url('superadmin/usuario/new') ?>" class="btn btn-primary float-right">
                    <i class=" dripicons-plus"></i>
                    Agregar Usuarios
                </a>
            </div>
            <br>
            <h4 class="header-title">&nbsp;</h4>
            <table id="datatable-usuarios" class="table table-striped table-bordered dt-responsive wrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ci</th>
                        <th>Nombres</th>
                        <th>Celular</th>
                        <th>correo</th>
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

<?= $this->section("js") ?>
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
        let tbl_usuarios = $("#datatable-usuarios").DataTable({
                select: 'single',
                processing: true,
                serverSide: true,
                buttons: ["copy", "print"],
                ajax: {
                    url: "<?= base_url('superadmin/usuario/get_data') ?>",
                    type: "GET",
                },
                //data: mydata.data,
                aoColumns: [{
                        mData: "id"
                    },
                    {
                        mData: "ci"
                    },
                    {
                        mData: "usuario"
                    },
                    {
                        mData: "celular"
                    },
                    {
                        mData: "correo"
                    },
                    {
                        mData: "creado_el"
                    },
                    {
                        mData: "estado",
                        bSortable: false,
                        mRender: function(data, type, row) {
                            if (data == "REGISTRADO") {
                                return '<span class="badge badge-info">REGISTRADO</span>' +
                                    '<button data-id="' + row.id + '" class="btn-active btn btn-xs btn-purple">activar</button>';
                            } else if (data == "ACTIVO") {
                                return '<span class="badge badge-success">ACTIVO</span>';
                            } else {
                                return '<span class="badge badge-danger">ELIMINADO</span>' +
                                    '<button data-id="' + row.id + '" class="btn-active btn btn-xs btn-purple">activar</button>';
                            }
                        }
                    },
                    {
                        mData: null,
                        bSortable: false,
                        mRender: function(data, type, full) {
                            return '<div class="btn-group mb-2">' +
                                '<a href="<?= base_url('superadmin/usuario/') ?>/' + data.id + '/edit" class="btn btn-xs btn-warning waves-effect waves-light"><i class="fas fa-edit"></i></a>' +
                                '<button data-id="' + data.id + '" class="btn-delete-usuario btn btn-xs btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>' +
                                '</div> ';
                        }
                    }
                ],
                order: [
                    [0, 'desc']
                ],
            })
            .on("click", "button.btn-delete-usuario", function(e) {
                let id = $(this).data('id');
                Swal.fire({
                    title: "¿Estás seguro de eliminar el Usuario?",
                    text: "confirma para eliminar el usuario",
                    type: "error",
                    showCancelButton: !0,
                    confirmButtonColor: "#31ce77",
                    cancelButtonColor: "#f34943",
                    confirmButtonText: "Si, eliminar!",
                    cancelButtonText: "No, cancelar!",
                }).then(function(t) {
                    if (t.value) {
                        $.post('<?= base_url('/superadmin/usuario') ?>/' + id, {
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
                                tbl_usuarios.ajax.reload();
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

            }).on('click', "button.btn-active", function(e) {
                let id = $(this).data('id');
                Swal.fire({
                    title: "¿Estás seguro de activar el Usuario?",
                    text: "confirma para activar el usuario",
                    type: "error",
                    showCancelButton: !0,
                    confirmButtonColor: "#31ce77",
                    cancelButtonColor: "#f34943",
                    confirmButtonText: "Si, activar!",
                    cancelButtonText: "No, cancelar!",
                }).then(function(t) {
                    if (t.value) {
                        $.get('<?= base_url('/superadmin/usuario/active') ?>/', {
                            id,
                            _method: "POST",
                            csrf_token_name: "<?= csrf_hash() ?>"
                        }, function(data) {
                            if (typeof data.type !== 'undefined' && data.type == 'success') {
                                Swal.fire({
                                    title: "Activado!",
                                    text: data.msg,
                                    type: "success",
                                    confirmButtonText: "OK",
                                })
                                tbl_usuarios.ajax.reload();
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Error al activar el usuario.",
                                    type: "error",
                                    confirmButtonText: "OK",
                                });
                            }
                        });
                    }
                });
            })

        tbl_usuarios.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
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