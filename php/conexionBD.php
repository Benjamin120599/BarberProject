<?php
    
    class ConexionBD {
        private $conexion;
        
        private $host = 'localhost:3306';
        private $usuario = 'Cliente';
        private $contraseña = '6ba72d0901bd4e16';
        private $bd = 'BD_Barber';

        public function __construct() {
            try {
                $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->bd", $this->usuario, $this->contraseña);
                $this->conexion->exec("set names utf8");
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo 'Conexión Establecida';
                return $this->conexion;
            } catch (PDOException $e) {
                //echo 'Conexión Fallida '.$e->getMessage();
                die();
            }
        }

        public function prepare($sql) {
            return $this->conexion->prepare($sql);
        }


    }
    
?>