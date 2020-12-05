<?php
    session_start();
    include_once 'abrir_conexion.php';

    $user = $_POST['caja_usuario'];
    $passCifrado = $_POST['caja_contraseña'];
    
    $pass = sha1($passCifrado);

    $sentencia = $conexion->prepare("SELECT * FROM Usuarios WHERE User = ? AND Pass = ?;");

    $sentencia->execute([$user, $pass]);
    $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
    
    if($datos) {
        echo '<br>'.$datos['User'];
        echo '<br>'.$datos['Pass'];
        echo '<br>'.$datos['Nombre'];
        echo '<br>'.$datos['Primer_Ap'];
        echo '<br>'.$datos['Segundo_Ap'];
        echo '<br>'.$datos['Telefono'];
        $_SESSION['nombre'] = $datos['User'];
        header('location: ../vistas/Inicio');
    } else {
        //echo '<br>No existe el usuario';
        header('location: ../vistas/login.php');
    }
    

?>