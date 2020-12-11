<?php
    session_start();
    include_once '../abrir_conexion.php';

    $sentencia = $conexion->prepare("SELECT * FROM Barberos WHERE Disponibilidad = ?;");

    $sentencia->execute([1]);
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos as $key) {
        $datosImportantes['nombre'] = $key['Nombre_Barber'];
        print_r($datosImportantes);
        $_SESSION['nombres'] = $datosImportantes;
    }

    
    return $datosImportantes;
    
    /*if($datos) {

        echo '<br>'.$datos['Id_Barber'];
        echo '<br>'.$datos['Nombre_Barber'];
        
        $_SESSION['id'] = $datos['Id_Barber'];
        $_SESSION['nombre'] = $datos['Nombre_Barber'];
        
        $_SESSION['primerAp'] = $datos['Primer_Ap_Barber'];
        $_SESSION['segundoAp'] = $datos['Segundo_Ap_Barber'];
        $_SESSION['telefono'] = $datos['Telefono_Barber'];
        $_SESSION['tipoUser'] = $datos['Tipo_Usuario'];
 
        return $datos;
    } else {
        //echo '<br>No existe el usuario';
        header('location: ../vistas/login.php');
    }*/
    

?>