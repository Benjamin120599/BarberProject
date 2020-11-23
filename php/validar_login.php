<?php
    session_start();
    include_once 'abrir_conexion.php';

    $user = $_POST['caja_usuario'];
    $pass = $_POST['caja_contraseña'];

    $sentencia = $conexion->prepare("SELECT * FROM Clientes WHERE User_Client = ? AND Password_Client = ?;");

    $sentencia->execute([$user, $pass]);
    $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
    
    if($datos) {
        echo '<br>'.$datos['User_Client'];
        echo '<br>'.$datos['Password_Client'];
        echo '<br>'.$datos['Nombre_Client'];
        echo '<br>'.$datos['Primer_Ap_Client'];
        echo '<br>'.$datos['Segundo_Ap_Client'];
        echo '<br>'.$datos['Telefono_Client'];
        $_SESSION['nombre'] = $datos['User_Client'];
    } else {
        echo '<br>No existe el usuario';
        header('../vistas/login.php');
    }
    

?>