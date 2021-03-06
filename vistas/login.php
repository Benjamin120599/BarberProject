<?php
    session_start();
    if(isset($_SESSION['nombre'])) {
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css" />
    <script src="../js/validacion.js" type="text/javascript"></script>
    <title>Iniciar Sesión!</title>
</head>

<body class="bg-dark">

    <header class="header">
		<nav class="navbar navbar-expand-lg navbar-light bg-dark" id="mainNav">
			<div class="container">
				<a class="navbar-brand" href="../index.html">
					Inicio
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="signup.php">Sign Up</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

    </header>
    

    <main>
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
                       <h2>Iniciar Sesión</h2>
                    </div>
                    <div class="px-lg-5 py-lg-4 p-4 w-100">
                        <h1 class="font-weight-bold mb-4">Bienvenido a la barbería</h1>
    
                        <form id="formulario" class="mb-5" onsubmit="validarFormulario()" method="POST" action="../php/validar_login.php">
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Usuario</label>
                                <input type="text" class="form-control inp" id="user" placeholder="Ingresa tu usuario" name="caja_usuario" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Contraseña</label>
                                <input type="password" class="form-control inp mb-2" id="password" placeholder="Ingresa tu contraseña" name="caja_contraseña" required>
                                <a class="form-text text-muted text-decoration-none" href="#">¿Has olvidado tu contraseña?</a>
                            </div>
                            <button type="submit" onclick="alert(validarFormulario()? 'Puedes acceder':'Error al autenticarse')" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
    
                        <div class="text-center">
                            <p class="d-inline-block mb-0">¿Aún no tienes una cuenta? <a href="signup.php">Crea una ahora.</a></p>
                        </div>
    
                    </div>
                </div>
            </div>
        </section>
    </main>

    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous">
    </scrip>

</body>

</html>