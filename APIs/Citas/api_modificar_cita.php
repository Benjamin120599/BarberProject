<?php

    include('../../php/conexionBD.php');

    $pdo = new ConexionBD();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $datos = json_decode($cadena_JSON, true);

            $id = $datos['id'];
            $dia = $datos['dia'];
            $hora = $datos['hora'];
            $fecha = $datos['fecha'];
            $servicio = $datos['servicio'];
            $barber = $datos['barber'];
            $cliente = $datos['cliente'];

            $sql = "UPDATE Citas SET Dia=?, Hora_Inicio=?, Fecha=?, Servicio=?, Barber=?, Cliente=? WHERE Id_Cita=?;";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$dia, $hora, $fecha, $servicio, $barber, $cliente, $id]);
            
            $data = 'false';
            if($respuesta) {
                $data = 'true';
            }

            if($data) {
                echo json_encode(array("delete"=>$data));
            } else {
                echo json_encode($data);
            }

        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>