<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Posgrado | U.P.E.A.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cursos Posgrado Upea" name="description" />
    <meta content="Cursos Posgrado" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?= base_url('assets/principal/favicon.png') ?> " />

    <link href="<?= base_url('greeva/continuar/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/continuar/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/continuar/css/app.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center">
    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mb-2">
                                <span><img src="<?= base_url('assets/principal/posgrado-dark.png') ?>" alt="" height=60"></span>
                            </div>

                            <div class="col-12 text-center">
                                <p class="text-dark mb-1"><b>¡Bienvenido a Posgrado de la Universidad Pública de El Alto!</b></p>
                            </div>
                            <div class="col-12 text-center">
                                <p class="text-dark">Porque tu formación académica nos interesa.</p>
                            </div>
                            <form id="frm-redirect" action="<?= base_url(route_to('redireccion')) ?>" method="POST" class="pt-2">
                                <input type="hidden" name="id" id="id" value="<?= $link_id ?>">
                                <?= csrf_field() ?>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block btn-success" disabled type="submit">
                                        Click para Continuar ...
                                    </button>
                                </div>
                            </form>

                            <div class="row mt-3 texto-reclamo">
                                <div class="col-12 text-center">
                                    <p class="text-muted mb-0">¿Tienes alguna consulta?<br>
                                        <a href="javascript:void(0);" id="sugerencia_reclamo" class="text-dark ml-1"><b>Sugerencia o reclamo</b></a>
                                    </p>
                                </div>
                            </div>

                            <form id="frm-sugerencia" action="<?= route_to('sugerencia') ?>" method="POST" class="pt-2 d-none">
                                <input type="hidden" name="link_id" id="link_id" value="<?= $link_id ?>">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="">--seleccione--</option>
                                        <option value="Consulta">Consulta</option>
                                        <option value="Reclamo">Reclamo</option>
                                        <option value="Sugerencia">Sugerencia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="celular" class="col-form-label">Celular <span class="text-danger">*</span></label>
                                    <input type="number" name="celular" id="celular" class="form-control" value="<?= old('celular') ?>" data-parsley-trigger="keyup" data-parsley-minlength="8" data-parsley-maxlength="8" data-parsley-pattern="^(7|6)?[0-9]{7}$" data-parsley-pattern-message="El número de celular debe empezar por 6 o 7." required />
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                        <input type="text" name="nombre" id="nombre" value="<?= old('nombre') ?>" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" class="form-control" required />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nombre">Apellidos</label>
                                        <input type="text" name="apellidos" id="apellidos" value="<?= old('apellidos') ?>" parsley-trigger="change" data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sugerencia">Sugerencia o reclamo <span class="text-danger">*</span></label>
                                    <textarea name="sugerencia" id="sugerencia" parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ¿?., ]+$" class="form-control" rows="1" required><?= old('sugerencia') ?></textarea>

                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <input type="hidden" name="code" id="code" value="" />
                                        <label class="col-lg-12">Captcha</label>
                                        <img src="" style="width: 100%; height: calc(1.5em + 0.9rem + 2px)" id="img-captcha" />
                                    </div>
                                    <div class="col-6">
                                        <label> Resultado <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="result" id="result" data-parsley-required-message="Captcha es requerido" required />
                                        <p class="text-danger"><?= session('error') ?></p>
                                    </div>

                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-secondary" type="button" id="btn-cancelar-sugerencia">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-info" type="submit">
                                        Enviar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('greeva/continuar/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('greeva/continuar/js/app.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script>
        $("#frm-sugerencia").parsley();
        $("#sugerencia_reclamo").on('click', function(e) {
            $("#frm-sugerencia").removeClass('d-none');
            $("#frm-redirect, .texto-reclamo").addClass('d-none');
            generarCaptcha();
        });

        $("#btn-cancelar-sugerencia").on('click', function(e) {
            $("#frm-sugerencia").addClass('d-none');
            $("#frm-redirect, .texto-reclamo").removeClass('d-none');
        });

        var contador = 3;
        var intervalo = setInterval(function() {
            $(".btn-success").html("Continuar en (" + contador + ")");
            if (contador == 0) {
                clearInterval(intervalo);
                $(".btn-success").removeAttr('disabled');
                $(".btn-success").html("Continuar");
            }
            contador--;
        }, 1000);

        const generarCaptcha = () => {
            $.ajax({
                type: "GET",
                url: "<?= base_url(route_to('captcha')) ?>",
            }).done(function(response) {
                $("#code").val(response.codigo);
                $("#img-captcha").attr("src", window.location.origin + '/' + response.ruta);
            });
        };

        let response = "<?= session('sugerencia') ?>";
        let tipo = "<?= old('tipo') ?>";
        if (response) {
            $("#frm-sugerencia").removeClass('d-none');
            $("#frm-redirect, .texto-reclamo").addClass('d-none');
            generarCaptcha();
            $("#tipo").val(tipo).trigger('change');
            $("#result").focus();
        }

        let success = "<?= session('success') ?>";
        if (success) {
            $("#frm-sugerencia").addClass('d-none');
            $("#frm-redirect, .texto-reclamo").removeClass('d-none');
            Swal.fire({
                position: "top-end",
                type: "success",
                title: "<?= session('success') ?>",
                showConfirmButton: !1,
                timer: 1500,
            });
        }

        let danger = "<?= session('errorr') ?>";
        if (danger) {
            $("#frm-sugerencia").addClass('d-none');
            $("#frm-redirect, .texto-reclamo").removeClass('d-none');
            Swal.fire({
                position: "top-end",
                type: "error",
                title: "<?= session('errorr') ?>",
                showConfirmButton: !1,
                timer: 1500,
            });
        }
    </script>
</body>

</html>