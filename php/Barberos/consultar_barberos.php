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
            $sql = "INSERT INTO Barberos(Id_Barber, Nombre_Barber, Primer_Ap_Barber, Segundo_Ap_Barber, Telefono_Barber, Calle_Barber, Numero_Barber, Colonia_Barber, Ciudad_Barber, Email_Barber, Disponibilidad) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $sentencia = $pdo->prepare($sql);
            
            $stmt = $pdo->prepare("SELECT concat('BARBER00', COUNT(*)+1) AS Id FROM Barberos;");
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


            $respuesta = $sentencia->execute([$id, $_POST['name'], $_POST['pap'], $_POST['sap'], $_POST['tel'], $_POST['calle'], $_POST['num'], $_POST['col'], $_POST['city'], $_POST['email'], 1]);
            echo json_encode($respuesta);
        break;
        
        case 'eliminar':

            $respuesta = false;

            if(isset($_POST['id'])) {
                $sql = "DELETE FROM Barberos WHERE Id_Barber = ?;";
                $sentencia = $pdo->prepare($sql);
                $respuesta = $sentencia->execute([$_POST['id']]);
            }

            echo json_encode($respuesta);

        break;

        case 'modificar':
            
            $sql = "UPDATE Barberos SET Nombre_Barber = ?, Primer_Ap_Barber = ?, Segundo_Ap_Barber = ?, Telefono_Barber = ?, Calle_Barber = ?, Numero_Barber = ?, Colonia_Barber = ?, Ciudad_Barber = ?, Email_Barber = ?, Disponibilidad = ? WHERE Id_Barber = ?";
            $sentencia = $pdo->prepare($sql);
            $respuesta = $sentencia->execute([$_POST['name'], $_POST['pap'], $_POST['sap'], $_POST['tel'], $_POST['calle'], $_POST['num'], $_POST['col'], $_POST['city'], $_POST['email'], 1, $_POST['id']]);

            echo json_encode($respuesta);
        break;

        default:
            $sql = "SELECT * FROM Barberos;";
        
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute();

            while($r = $sentencia->fetchAll(PDO::FETCH_ASSOC) ) {
                $data = $r;
            }
            echo json_encode(array("barberos"=>$data));
        break;
    }

?>