<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Recuperar Contraseña</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="Acortador de enlaces Cursos Posgrado Upea" name="description" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url('assets/principal/favicon.png') ?> " />

	<!-- App css -->
	<link href="<?= base_url('greeva/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
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
								<a href="index.html">
									<span><img src="<?= base_url('assets/principal/posgrado.png') ?>" alt="" height="50" /></span>
								</a>
								<p class="text-muted mt-3">
									Ingrese su correo electrónico y le enviaremos un
									correo electrónico con instrucciones para
									restablecer su contraseña.
								</p>
							</div>

							<form action="#" class="pt-2">
								<div class="form-group mb-3">
									<label for="correo">Email</label>
									<input class="form-control" type="email" id="correo" required="" placeholder="Ingrese tu correo" />
								</div>

								<div class="form-group mb-0 text-center">
									<button class="btn btn-success btn-block" type="submit">
										Restablecer la contraseña
									</button>
								</div>
							</form>

							<div class="row mt-3">
								<div class="col-12 text-center">
									<p class="text-muted mb-0">
										Regresar a
										<a href="<?= base_url('/auth/login') ?>" class="text-dark ml-1"><b>Iniciar Sesión</b></a>
									</p>
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
</body>

</html>