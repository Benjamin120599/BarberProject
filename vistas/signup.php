<?php
session_start();
if (isset($_SESSION['nombre'])) {
    header('Location: Inicio');
}
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!---<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css" />
    <title>Registrarse</title>


    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>



</head>

<body class="bg-dark">

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="../index.html">
                    Inicio
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main class="">
        <section>
            <div class="row g-0">
                <div class="col-lg-7">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item img-1 min-vh-100 active">

                            </div>
                            <div class="carousel-item img-2 min-vh-100">

                            </div>
                            <div class="carousel-item img-3 min-vh-100">

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 d-flex flex-column align-items-end mt-3 max-vh-100">
                    <div class="px-lg-5 pt-lg-5 pb-lg-3 w-100 mb-2">
                        <h2>Crea tu cuenta</h2>
                    </div>
                    <div class="px-lg-5 py-lg-4 p-4 w-100 mt-2">
                        <form class="row g-3" method="POST" action="../php/Clientes/registro.php">

                            <!--<div class="col-md-12 mb-3">
                                <label class="form-label">Correo Electrónico*</label>
                                <input type="email" class="form-control inp" name="email" placeholder="Correo Electrónico" required>
                            </div>-->

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usuario*</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorUser']) ? $_SESSION['errorUser'] : ""; ?></span>
                                <input type="text" class="form-control inp" name="user" placeholder="Usuario" required value="<?php echo isset($_SESSION['datoUser']) ? $_SESSION['datoUser'] : ""; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPassword4" class="form-label">Contraseña*</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorPass']) ? $_SESSION['errorPass'] : ""; ?></span>
                                <input type="password" class="form-control inp" name="pass" placeholder="Contraseña" required value="<?php echo isset($_SESSION['datoPass']) ? $_SESSION['datoPass'] : ""; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre*</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorName']) ? $_SESSION['errorName'] : ""; ?></span>
                                <input type="text" class="form-control inp" name="name" placeholder="Nombre" required value="<?php echo isset($_SESSION['datoName']) ? $_SESSION['datoName'] : ""; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Primer Apellido*</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorPap']) ? $_SESSION['errorPap'] : ""; ?></span>
                                <input type="text" class="form-control inp" name="primerAp" placeholder="Primer Apellido" required value="<?php echo isset($_SESSION['datoPap']) ? $_SESSION['datoPap'] : ""; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Segundo Apellido</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorSap']) ? $_SESSION['errorSap'] : ""; ?></span>
                                <input type="text" class="form-control inp" name="segundoAp" placeholder="Segundo Apellido" value="<?php echo isset($_SESSION['datoSap']) ? $_SESSION['datoSap'] : ""; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telefono*</label>
                                <span style="color: white; font-size: xx-small;"> <?php echo isset($_SESSION['errorTel']) ? $_SESSION['errorTel'] : ""; ?></span>
                                <input type="tel" class="form-control inp" name="telefono" placeholder="Telefono" required value="<?php echo isset($_SESSION['datoTel']) ? $_SESSION['datoTel'] : ""; ?>">
                            </div>

                            <!--<input type="hidden" name="recaptcha_response" id="recaptchaResponse">-->

                            <div class="g-recaptcha" data-sitekey="6LeLKgYaAAAAAOOG-VjdmWB-vRUBBgllFrjibQrx" req style="padding-left: 22%; padding-bottom: 5%;"></div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Registrar Cuenta</button>
                            </div>

                        </form>

                        <div class="text-center">
                            <p class="d-inline-block mb-0">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí.</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!--<form class="row g-3" method="POST">
            <div class="col-md-12">
                <label class="form-label">Correo Electrónico*</label>
                <input type="email" class="form-control inp" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Usuario*</label>
                <input type="text" class="form-control inp" name="user" placeholder="Usuario" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Contraseña*</label>
                <input type="password" class="form-control inp" name="pass" placeholder="Contraseña" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nombre*</label>
                <input type="text" class="form-control inp" name="name" placeholder="Nombre" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Primer Apellido*</label>
                <input type="text" class="form-control inp" name="primerAp" placeholder="Primer Apellido" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control inp" name="segundoAp" placeholder="Segundo Apellido">
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefono*</label>
                <input type="tel" class="form-control inp" name="telefono" placeholder="Telefono" required>
            </div>

            
            <div class="col-12">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign in</button>
            </div>
        </form>-->

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous">
    </script>

</body>

</html>

<?php
unset($_SESSION['errorUser']);
unset($_SESSION['datoUser']);

unset($_SESSION['errorPass']);
unset($_SESSION['datoPass']);

unset($_SESSION['errorName']);
unset($_SESSION['datoName']);

unset($_SESSION['errorPap']);
unset($_SESSION['datoPap']);

unset($_SESSION['errorSap']);
unset($_SESSION['datoSap']);

unset($_SESSION['errorTel']);
unset($_SESSION['datoTel']);
?>