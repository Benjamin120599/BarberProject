<?php


session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo'])) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 900; //15 min

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $inactivo) {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: ../login.php");

        exit();
    } else {  // si no ha caducado la sesion, actualizamos
        $_SESSION['tiempo'] = time();
    }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Inicio</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>


<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-main">

        <a class="navbar-brand" href="index.php">Barber System</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?php echo $_SESSION['user']; ?> </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Info usuario</a>
                    <a class="dropdown-item" href="#">Acerca de:</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../../php/cerrar_conexion.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </nav>

    <!--Sidebar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Inicio</div>

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                            Citas
                        </a>

                        <div class="sb-sidenav-menu-heading">Operaciones</div>

                        <a class="nav-link" href="agregar_cita.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-plus"></i></div>
                            Agendar Cita
                        </a>

                        <a class="nav-link" href="modificar_cita.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                            Modificar Cita
                        </a>

                        <a class="nav-link" href="eliminar_cita.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>
                            Cancelar Cita
                        </a>

                        <?php if ($_SESSION['tipoUser'] == 1) { ?>
                            <div class="sb-sidenav-menu-heading">Administración</div>

                            <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gestionar Clientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="lista_clientes.php">Clientes</a>
                                    <a class="nav-link" href="agregar_cliente.php">Agregar Cliente</a>
                                </nav>
                            </div>-->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Gestionar Barbería
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="agregar_personal.php">Personal</a>
                                    <a class="nav-link" href="agregar_servicio.php">Servicios</a>
                                </nav>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['nombre']; ?>
                </div>
            </nav>
        </div>

        <!--Contenido principal-->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Barbería Kingdom Wolf</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Barberos</li>
                    </ol>

                    <div class="row">

                        <div class="col-xl-3 col-md-6" style="width: 18rem;">
                            <img src="../../assets/Imagenes/Barbers/1.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-primary text-white mb-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6" style="width: 18rem;">
                            <img src="../../assets/Imagenes/Barbers/2.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-warning text-white mb-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6" style="width: 18rem;">
                            <img src="../../assets/Imagenes/Barbers/3.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-success text-white mb-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6" style="width: 18rem;">
                            <img src="../../assets/Imagenes/Barbers/4.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-danger text-white mb-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>

                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Galeria</li>
                    </ol>

                    <!-- =========================  INICIO GALERIA ==========================-->


                    <!-- =========================  TERMINO GALERIA ==========================-->




            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>