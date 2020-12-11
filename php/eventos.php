<?php
    header('Content-Type: application/json');

    include('conexionBD.php');

    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
    }


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

            $respuesta = false;

            if(isset($_POST['id'])) {
                $sql = "DELETE FROM Citas WHERE Id_Cita = ?;";
                $sentencia = $pdo->prepare($sql);
                $respuesta = $sentencia->execute([$_POST['id']]);
            }

            echo json_encode($respuesta);

        break;

        case 'modificar':
            
            $sql = "UPDATE Citas SET Dia = ?, Hora_Inicio = ?, Fecha = ?, Servicio = ?, Barber = ?, Cliente = ? WHERE Id_Cita = ?";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$_POST['dia'], $_POST['hora'], $_POST['fecha'], $_POST['servicio'], $_POST['barber'], $_POST['cliente'], $_POST['id']]);

            echo json_encode($respuesta);
        break;

        case 'special':
            //$sql = "SELECT concat(Servicio, ' - ', Cliente) AS title, concat(Fecha, ' ', Hora_Inicio) AS date FROM Citas WHERE Cliente=?;";
            $sql = "SELECT concat(Servicio, ' - ', Cliente) AS title, concat(Fecha, ' ', Hora_Inicio) AS date, Id_cita AS id, Dia AS dia, Hora_Inicio AS hora, Fecha AS fecha, Servicio AS servicio, Barber AS barber, Cliente AS cliente FROM Citas WHERE Cliente=?;";
        
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute([$_SESSION['user']]);
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($resultado);
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