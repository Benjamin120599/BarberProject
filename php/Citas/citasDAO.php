<?php
    include('../abrir_conexion.php');

    /*class CitasDAO {

        

        public function agregarCita($dia, $fecha, $hora, $servicio, $barber, $cliente) {

            $sql = "INSERT INTO Citas VALUES(?, ?, ?, ?, ?, ?);";
            $sentencia = $this->conexion->prepare($sql);

            $sentencia->bindParam(1, $dia);
            $sentencia->bindParam(2, $hora);
            $sentencia->bindParam(3, $fecha);
            $sentencia->bindParam(4, $servicio);
            $sentencia->bindParam(5, $barber);
            $sentencia->bindParam(6, $cliente);

            $sentencia->execute();

        }

    }*/

    $conexion;

    function __construct() {
        $conexion = new ConexionBD();
    }

    $sql = "INSERT INTO Citas VALUES(?, ?, ?, ?, ?, ?);";
    $sentencia = $conexion->prepare($sql);

    $sentencia->bindParam(1, $dia);
    $sentencia->bindParam(2, $hora);
    $sentencia->bindParam(3, $fecha);
    $sentencia->bindParam(4, $servicio);
    $sentencia->bindParam(5, $barber);
    $sentencia->bindParam(6, $cliente);

    $sentencia->execute();


?>