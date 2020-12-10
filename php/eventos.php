<?php
    header('Content-Type: application/json');

    include('conexionBD.php');

    $pdo = new ConexionBD;

    $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

    switch($accion) {
        case 'agregar':
            $sql = "INSERT INTO Citas(Dia, Hora_Inicio, Fecha, Servicio, Barber, Cliente) VALUES(?, ?, ?, ?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            //$respuesta = $sentencia->execute(["Martes", "12:00:00", "2020-12-10", "HC0001", "BARBER0001", "Benja120599"]);
            $respuesta = $sentencia->execute([$_POST['dia'], $_POST['hora'], $_POST['fecha'], $_POST['servicio'], $_POST['barber'], $_POST['cliente']]);
            echo json_encode($respuesta);
        break;
        
        case 'eliminar':
            echo "Instruccion eliminar";
        break;

        case 'modificar':
            echo "Instruccion modificar";
        break;

        default:
            $sql = "SELECT concat(Servicio, ' - ', Cliente) AS title, concat(Fecha, ' ', Hora_Inicio) AS date FROM  Citas;";
        
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($resultado);
        break;
    }

?>