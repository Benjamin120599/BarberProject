<?php
    header('Content-Type: application/json');

    include('../conexionBD.php');

    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
    }


    $pdo = new ConexionBD;

    $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

    switch($accion) {
        case 'agregar':
            $sql = "INSERT INTO Servicios(Id_Servicio, Tipo_Corte, Precio) VALUES(?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            
            $stmt = $pdo->prepare("SELECT concat('SERV00', COUNT(*)+1) AS Id FROM Servicios;");
            $stmt->execute();
            
            while($r = $stmt->fetchAll(PDO::FETCH_ASSOC) ) {
                $data = $r;
            }
            //echo json_encode(array("barberos"=>$data));
            foreach ($data as $key => $value) {
                //echo $key;
                foreach ($value as $val) {
                    $id = $val;
                    //echo $val;
                }
                //$id = $key['Id'];
            }
            //echo $id;


            $respuesta = $sentencia->execute([$id, $_POST['tipo'], $_POST['precio']]);
            echo json_encode($respuesta);
        break;
        
        case 'eliminar':

            $respuesta = false;

            if(isset($_POST['id'])) {
                $sql = "DELETE FROM Servicios WHERE Id_Servicio = ?;";
                $sentencia = $pdo->prepare($sql);
                $respuesta = $sentencia->execute([$_POST['id']]);
            }

            echo json_encode($respuesta);

        break;

        case 'modificar':
            
            $sql = "UPDATE Servicios SET Tipo_Corte = ?, Precio = ? WHERE Id_Servicio = ?";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$_POST['tipo'], $_POST['precio'], $_POST['id']]);

            echo json_encode($respuesta);
        break;

        default:
            $sql = "SELECT * FROM Servicios;";
        
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute();

            while($r = $sentencia->fetchAll(PDO::FETCH_ASSOC) ) {
                $data = $r;
            }
            echo json_encode(array("servicios"=>$data));
        break;
    }

?>