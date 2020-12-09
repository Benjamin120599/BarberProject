<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}

if (isset($_SESSION['tiempo'])) {
    if ($_SESSION['tiempo'] < time()) {
        unset($_SESSION['tiempo']);
        echo "<script>alert('Tiempo de sesión finalizado'
                    parent.parent.window.location='../login.php'</script>";
    } else {
        $_SESSION['tiempo'] = time() + 10;
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href='fullcalendar/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href='fullcalendar/list/main.css' rel='stylesheet' />
    <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />

    <script src='fullcalendar/core/main.js'></script>
    <script src='fullcalendar/daygrid/main.js'></script>
    <script src='fullcalendar/list/main.js'></script>
    <script src='fullcalendar/timegrid/main.js'></script>
    <script src='fullcalendar/interaction/main.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],
                //defaultView: 'timeGridDay'
                defaultView: 'timeGridWeek',
                height: 650,
                themeSystem: 'bootstrap',

                header: {
                    left: 'prev,next today Miboton',
                    center: 'title',
                    //right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    right: 'timeGridWeek,timeGridDay'
                },
                /*customButtons: {
                    Miboton: {
                        text: "Botón",
                        click: function() {
                            alert("Hola mundo");
                        }
                    }
                },*/

                businessHours: [ // specify an array instead
                    {
                        daysOfWeek: [1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
                        startTime: '09:00', // 8am
                        endTime: '21:00' // 6pm
                    },
                    {
                        daysOfWeek: [6,0], // Thursday, Friday
                        startTime: '10:00', // 10am
                        endTime: '16:00' // 4pm
                    }
                ],

                dateClick: function(info) {
                    $('#exampleModal').modal('show');
                    console.log(info);

                    var fecha = info.dateStr;
                    var hora = info.dateStr.substring(11, 19);

                    var day = info.date.toString();
                    console.log(day);
                    var dia = "Prueba";
                    if(day.substring(0,3)== "Mon") {
                        dia = "Lunes";
                    } else if(day.substring(0,3) == "Tue") {
                        dia = "Martes";
                    } else if(day.substring(0,3) == "Wed") {
                        dia = "Miercoles";
                    } else if(day.substring(0,3) == "Thu") {
                        dia = "Jueves";
                    } else if(day.substring(0,3) == "Fri") {
                        dia = "Viernes";
                    } else if(day.substring(0,3) == "Sat") {
                        dia = "Sábado";
                    } else if(day.substring(0,3) == "Sun") {
                        dia = "Domingo";
                    }

                    

                    $('#txt_fecha').val(fecha.substring(0, 10));
                    $('#txt_hora').val(hora);
                    $('#txt_dia').val(dia);

                    /*calendar.addEvent({
                        title: "Evento",
                        date: info.dateStr
                    });*/
                },
                eventClick: function(info) {
                    console.log(info);
                    console.log(info.event.title);
                    console.log(info.event.start);
                    console.log(info.event.end);
                    console.log(info.event.backgroundColor);
                    console.log(info.event.textColor);
                    console.log(info.event.extendedProps.descripcion);
                },
                /*businessHours: {
                    start: '23:00', // hora final
                    end: '09:00', // hora inicial
                    dow: [0, 1, 2, 3, 4, 5] // dias de semana, 0=Domingo
                },*/
                events: [{
                        title: "Navidad",
                        start: "2020-12-24 19:00:00",
                        end: "2020-12-25 03:00:00",
                        descripcion: "Descripcion evento 1"
                    },
                    {
                        title: "Año nuevo",
                        start: "2020-12-31 19:00:00",
                        end: "2021-01-01 03:00:00",
                        color: "#46231be6",
                        textColor: "#ffffff",
                        descripcion: "Descripcion evento 1"
                    }
                ]

            });


            calendar.setOption('locale', 'Es');
            calendar.render();
        });
    </script>

</head>


<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-main">



        <a class="navbar-brand" href="index.php">Barber System</a>

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

                        <a class="nav-link" href="cancelar_cita.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>
                            Cancelar Cita
                        </a>

                        <a class="nav-link" href="lista_citas.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                            Mis Citas
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
                                    <a class="nav-link" href="agregar_tipo_usuario.php">Tipos Usuarios</a>
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
                        <li class="breadcrumb-item active">Agendar Citas</li>
                    </ol>

                    <div class="col-lg-12">
                        <div id='calendar'></div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agendar Cita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="col-lg-12">
                                        <label>Día: </label>
                                        <input id="txt_dia" class="form-control mb-3" type="text" placeholder="Día de la cita" required disabled>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Fecha: </label>
                                        <input id="txt_fecha" class="form-control mb-3" type="text" placeholder="Fecha de la cita" required disabled>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Hora: </label>
                                        <input id="txt_hora" class="form-control mb-3" type="text" placeholder="Hora de la cita" required disabled>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Selecciona un servicio: </label>
                                        <select class="form-select mb-3" required>
                                            <option selected>Selecciona una opción</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Selecciona un estilista: </label>
                                        <select class="form-select mb-3" required>
                                            <option selected>Selecciona una opción</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Cliente: </label>
                                        <input class="form-control mb-3" type="text" value="<?php echo $_SESSION['nombre']; ?>" disabled>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-success">Agendar</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>

</html>