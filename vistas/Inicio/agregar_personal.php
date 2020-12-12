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

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gestionar Clientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="lista_clientes.php">Clientes</a>
                                    <a class="nav-link" href="agregar_cliente.php">Agregar Cliente</a>
                                </nav>
                            </div>

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

                    <!-- VUE START -->

                    <div class="row mt-1 mb-3 ml-2">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <span>Agregar <i class="fas fa-plus"></i> </span>
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Añadir Barbero</h5>
                                    </div>

                                    <div class="modal-body">
                                        
                                        <div class="col-lg-12">
                                            <label>Nombre: </label>
                                            <input id="txt_nombre" class="form-control mb-3" type="text" placeholder="Nombre" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Primer Apellido: </label>
                                            <input id="txt_pap" class="form-control mb-3" type="text" placeholder="Primer Apellido" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Segundo Apellido: </label>
                                            <input id="txt_sap" class="form-control mb-3" type="text" placeholder="Segundo Apellido" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Telefono </label>
                                            <input id="txt_tel" class="form-control mb-3" type="number" placeholder="Telefono" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Calle: </label>
                                            <input id="txt_calle" class="form-control mb-3" type="text" placeholder="Calle" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Colonia: </label>
                                            <input id="txt_col" class="form-control mb-3" type="text" placeholder="Colonia" required>
                                        </div>

                                        <div class="row mr-1 ml-1">
                                            <div class="col-lg-6">
                                                <label>Número: </label>
                                                <input id="txt_num" class="form-control mb-3" type="number" placeholder="Número" required>
                                            </div>

                                            <div class="col-lg-6">
                                                <label>Ciudad: </label>
                                                <input id="txt_city" class="form-control mb-3" type="text" placeholder="Ciudad" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Correo Electrónico: </label>
                                            <input id="txt_email" class="form-control mb-3" type="email" placeholder="Email" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        <button id="btn_agregar" type="button" class="btn btn-success">Agregar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- OTRO MODAL -->

                        <button hidden type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <span>Agregar <i class="fas fa-plus"></i> </span>
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modificar Barbero</h5>
                                    </div>

                                    <div class="modal-body">
                                        
                                        <div class="col-lg-12">
                                            <label>Nombre: </label>
                                            <input id="txt_nombreM" class="form-control mb-3" type="text" placeholder="Nombre" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Primer Apellido: </label>
                                            <input id="txt_papM" class="form-control mb-3" type="text" placeholder="Primer Apellido" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Segundo Apellido: </label>
                                            <input id="txt_sapM" class="form-control mb-3" type="text" placeholder="Segundo Apellido" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Telefono </label>
                                            <input id="txt_telM" class="form-control mb-3" type="number" placeholder="Telefono" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Calle: </label>
                                            <input id="txt_calleM" class="form-control mb-3" type="text" placeholder="Calle" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Colonia: </label>
                                            <input id="txt_colM" class="form-control mb-3" type="text" placeholder="Colonia" required>
                                        </div>

                                        <div class="row mr-1 ml-1">
                                            <div class="col-lg-6">
                                                <label>Número: </label>
                                                <input id="txt_numM" class="form-control mb-3" type="number" placeholder="Número" required>
                                            </div>

                                            <div class="col-lg-6">
                                                <label>Ciudad: </label>
                                                <input id="txt_cityM" class="form-control mb-3" type="text" placeholder="Ciudad" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Correo Electrónico: </label>
                                            <input id="txt_emailM" class="form-control mb-3" type="email" placeholder="Email" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        <button @click="modificar(item.Id_Barber)" type="button" class="btn btn-warning">Modificar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="font-size: small;">
                        <div class="col-lg-12">
                            <div id="app">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Primer Ap.</th>
                                            <th>Segundo Ap.</th>
                                            <th>Telefono</th>
                                            <th>Calle</th>
                                            <th>Número</th>
                                            <th>Colonia</th>
                                            <th>Ciudad</th>
                                            <th>Email</th>
                                            <th>Disp.</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="items.length === 0">
                                            <td colspan="4" class="text-center">
                                                No hay registros por mostrar
                                            </td>
                                        </tr>
                                        <tr v-for="(item, index) in items">

                                            <td id="tbl_id">{{ item.Id_Barber }}</td>
                                            <td id="tbl_id">{{ item.Nombre_Barber }}</td>
                                            <td id="tbl_pap">{{ item.Primer_Ap_Barber }}</td>
                                            <td id="tbl_sap">{{ item.Segundo_Ap_Barber }}</td>
                                            <td id="tbl_tel">{{ item.Telefono_Barber }}</td>
                                            <td id="tbl_calle">{{ item.Calle_Barber }}</td>
                                            <td id="tbl_num">{{ item.Numero_Barber }}</td>
                                            <td id="tbl_col">{{ item.Colonia_Barber }}</td>
                                            <td id="tbl_city">{{ item.Ciudad_Barber }}</td>
                                            <td id="tbl_email">{{ item.Email_Barber }}</td>
                                            <td id="tbl_disp">{{ item.Disponibilidad }}</td>
                                            <td>
                                                <button @click="abrirModal(item.Id_Barber, item.Nombre_Barber, item.Primer_Ap_Barber, item.Segundo_Ap_Barber, item.Telefono_Barber, item.Calle_Barber, item.Numero_Barber, item.Colonia_Barber, item.Ciudad_Barber, item.Email_Barber, item.Disponibilidad)" type="button" class="btn btn-warning btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="eliminar(item.Id_Barber, index)" type="button" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- VUE ENDS -->
                </div>

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

    <!--<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/barberos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>