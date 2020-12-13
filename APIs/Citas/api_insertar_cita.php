<?php

    include('../../php/conexionBD.php');

    $pdo = new ConexionBD();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $datos = json_decode($cadena_JSON, true);

            $dia = $datos['dia'];
            $hora = $datos['hora'];
            $fecha = $datos['fecha'];
            $servicio = $datos['servicio'];
            $barber = $datos['barber'];
            $cliente = $datos['cliente'];

            $sql = "INSERT INTO Citas(Dia, Hora_Inicio, Fecha, Servicio, Barber, Cliente) VALUES(?, ?, ?, ?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$dia, $hora, $fecha, $servicio, $barber, $cliente]);
            echo json_encode($respuesta);

        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>