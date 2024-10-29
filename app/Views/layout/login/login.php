<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Planificación Nutricional &amp; Herramienta | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php base_url(); ?>assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php base_url(); ?>assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php base_url(); ?>assets/css/pages/auth-light.css" rel="stylesheet" />
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
</head>

<body>
    <div class="content">
        <br><br>
        <div class="brand">
            <h2>Planificación Nutricional</h2>
        </div>
        <form id="login-form" action="<?php echo base_url(); ?>login/authenticate" method="post">
        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Mostrar errores si existen -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>

                        </div>
                    <?php endif; ?>
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
            
            <div class="text-center">No eres Miembro?
                <a class="color-blue" href="<?php echo base_url(); ?>registro">Crear cuenta</a>
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
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
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
