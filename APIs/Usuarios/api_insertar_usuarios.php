<?php

    include('../../php/conexionBD.php');

    $pdo = new ConexionBD();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $datos = json_decode($cadena_JSON, true);

            $user = $datos['user'];
            $pass = $datos['pass'];
            $name = $datos['name'];
            $pap = $datos['pap'];
            $sap = $datos['sap'];
            $tel = $datos['tel'];
            $tipo = $datos['tipo'];

            $sql = "INSERT INTO Usuarios VALUES(?, ?, ?, ?, ?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$user, $pass, $name, $pap, $sap, $tel, $tipo]);

           echo json_encode($respuesta);
        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>