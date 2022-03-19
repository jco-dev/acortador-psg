<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Acortador Posgrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Acortador de enlaces Cursos Posgrado Upea" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/principal/favicon.png') ?> " />

    <!-- App css -->
    <link href=" <?= base_url('greeva/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center">
    <div class="home-btn d-none d-sm-block">
        <a href="/"><i class="fas fa-home h2 text-white"></i></a>
    </div>
    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <a href="">
                                    <span><img src="<?= base_url('assets/principal/posgrado.png') ?>" alt="" height="50"></span>
                                </a>
                            </div>
                            <?php if (session('msg')) : ?>
                                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                                    <strong><?= session('msg.body') ?></strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('autentificar') ?>" method="POST" class="pt-2 frm-auth">

                                <div class="form-group mb-3">
                                    <?= csrf_field() ?>
                                    <label for="correo">Email</label>
                                    <input class="form-control" type="email" id="correo" name="correo" parsley-trigger="change" value="<?= old('correo') ?>" placeholder="Ingrese su correo" required />
                                    <p class="text-danger"><?= session('errors.correo') ?></p>
                                </div>

                                <div class="form-group mb-3">
                                    <a href="<?= base_url("/recuperar-contraseña") ?>" class="text-muted float-right"><small>¿Olvidaste tu contraseña?</small></a>
                                    <label for="clave">Contraseña</label>
                                    <input class="form-control" type="password" id="clave" name="clave" placeholder="********" required />
                                    <p class="text-danger"><?= session('errors.clave') ?></p>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">Recuérdame</label>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block" type="submit"> Iniciar Sesión </button>
                                </div>

                            </form>

                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p class="text-muted mb-0">¿No tienes una cuenta? <a href="#" class="text-dark ml-1"><b>Registrarme</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="<?= base_url('greeva/assets/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/parsleyjs/i18n/es.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $(".frm-auth").parsley()
        });
    </script>

</body>

</html>