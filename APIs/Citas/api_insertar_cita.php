<?php

    include('../../php/conexionBD.php');
    header('Content-Type: application/json');

    $pdo = new ConexionBD();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $datos = json_decode($cadena_JSON, true);

            //echo $datos['dia']."-".$datos['hora']."-".$datos['fecha']."-".$datos['servicio']."-".$datos['barber']."-".$datos['cliente']."-";

            $dia = $datos['dia'];
            $hora = $datos['hora'];
            $fecha = $datos['fecha'];
            $servicio = $datos['servicio'];
            $barber = $datos['barber'];
            $cliente = $datos['cliente'];

            $sql = "INSERT INTO Citas(Dia, Hora_Inicio, Fecha, Servicio, Barber, Cliente) VALUES(?, ?, ?, ?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$dia, $hora, $fecha, $servicio, $barber, $cliente]);
            
            
            $data = 'false';
            if($respuesta) {
                $data = 'true';
            }

            if($data) {
                echo json_encode(array("insert"=>$data));
            } else {
                echo json_encode($data);
            }
            
            
            //echo json_encode($respuesta);

        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>