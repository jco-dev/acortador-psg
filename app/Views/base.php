<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Acortador Url Posgrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Acortador de enlaces Cursos Posgrado Upea" name="description" />
    <meta content="Cursos Posgrado" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/principal/favicon.png') ?> " />

    <!-- App css -->
    <link href="<?= base_url('greeva/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('greeva/assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <?= $this->renderSection("css") ?>
</head>

<body>

    <header id="topnav">

        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <?= $this->include("layout/notification-list") ?>
                </ul>

                <ul class="list-unstyled menu-left mb-0">
                    <li class="float-left logo-box">
                        <a href="index.html" class="logo">
                            <span class="logo-lg">
                                <img src="<?= base_url('assets/principal/posgrado.png') ?>" alt="" height="35">
                            </span>
                            <span class="logo-sm">
                                <img src="<?= base_url('assets/principal/posgrado-sm.png') ?>" alt="" height="30">
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <?= $this->include('layout/menu') ?>

    </header>

    <div class="wrapper">
        <div class="container-fluid">

            <div class="page-title-alt-bg"></div>
            <?= $this->include('layout/toolbar') ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <?= $this->include('layout/footer') ?>

    <!-- js -->
    <script src="<?= base_url('greeva/assets/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/jquery-knob/jquery.knob.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('greeva/assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <?= $this->renderSection("js") ?>
</body>

</html>