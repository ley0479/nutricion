<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Planificación Nutricional &amp; Herramienta | Registro</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php base_url(); ?>assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php base_url(); ?>assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php base_url(); ?>assets/css/pages/auth-light.css" rel="stylesheet" />
</head>
<style>
        /* Estilo para el fondo de la página de login */
        body {
            background-image: url('<?php echo base_url(); ?>assets/img/fondo.jpeg'); /* Asegúrate de que la ruta y extensión sean correctas */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .content {
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco con opacidad para el formulario */
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .brand {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
<body class="bg-silver-300">
    <div class="content">
        <br><br>
        <div class="brand">
            <h2>Planificación Nutricional</h2>
        </div>
        <form id="register-form" action="<?php echo base_url('/registro/guardarRegistro'); ?>" method="post">
            <h2 class="login-title">Crear cuenta</h2>

            <!-- Mostrar mensaje de éxito si está definido -->
           <!-- Mostrar mensaje de éxito si está definido -->
           <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Mostrar errores si existen -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Ingresa tu nombre" value="<?= old('name') ?>">
                        <?= (isset($validation) && $validation->hasError('name')) ? '<span class="text-danger">' . $validation->getError('name') . '</span>' : '' ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="apellidos" placeholder="Ingresa tus apellidos" value="<?= old('apellidos') ?>">
                        <?= (isset($validation) && $validation->hasError('apellidos')) ? '<span class="text-danger">' . $validation->getError('apellidos') . '</span>' : '' ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= old('email') ?>">
                <?= (isset($validation) && $validation->hasError('email')) ? '<span class="text-danger">' . $validation->getError('email') . '</span>' : '' ?>
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Ingresa tu contraseña">
                <?= (isset($validation) && $validation->hasError('password')) ? '<span class="text-danger">' . $validation->getError('password') . '</span>' : '' ?>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirma tu contraseña">
                <?= (isset($validation) && $validation->hasError('password_confirmation')) ? '<span class="text-danger">' . $validation->getError('password_confirmation') . '</span>' : '' ?>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Registrarse</button>
            </div>

            <div class="text-center">¿Ya eres miembro?
                <a class="color-blue" href="<?php echo base_url('/login'); ?>">Inicie sesión aquí</a>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?php base_url(); ?>assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="<?php base_url(); ?>assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?php base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?php base_url(); ?>assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?php base_url(); ?>assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#register-form').validate({
                errorClass: "help-block",
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        confirmed: true
                    },
                    password_confirmation: {
                        equalTo: password
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>