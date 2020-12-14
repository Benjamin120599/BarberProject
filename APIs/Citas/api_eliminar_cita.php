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

            $sql = "DELETE FROM Citas WHERE Id_Cita=?;";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$id]);
            //echo json_encode($respuesta);

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