<?php
    
    $conexion;
    $host = 'localhost:3306';
    $usuario = 'Cliente';
    $contraseña = '6ba72d0901bd4e16';
    $bd = 'BD_Barber';

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contraseña);
        $conexion->exec("set names utf8");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Conexión Establecida';
    } catch (PDOException $e) {
        echo 'Conexión Fallida '.$e->getMessage();
        die();
    }

?>
