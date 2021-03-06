<?php

    include('../../php/conexionBD.php');

    $pdo = new ConexionBD();
    //$data = $_REQUEST;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $datos = json_decode($cadena_JSON, true);

            $fecha = $datos['fecha'];
            $campo = $datos['campo'];

            $sql = "SELECT $campo FROM Citas WHERE Fecha = ?;";
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute([$fecha]);

            //echo json_encode($respuesta);

            $data = 'false';
            while($r = $sentencia->fetchAll(PDO::FETCH_ASSOC) ) {
                $data = $r;
            }

            if($data) {
                echo json_encode(array("citas"=>$data));
            } else {
                echo json_encode($data);
            }
            

        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>