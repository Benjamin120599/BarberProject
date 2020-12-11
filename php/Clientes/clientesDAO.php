<?php
    include('../conexionBD.php');

    class ClienteDAO {

        private $conexion;

        public function __construct() {
            $this->conexion = new ConexionBD();
        }

        public function buscarCliente($user) {
            $sql = "SELECT * FROM Usuarios WHERE User=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute([$user]);

            if($row = $sentencia->fetch()){
                echo $row['Nombre'];
                return true;
            } 

            //return json_encode($respuesta);
        }

        public function agregarCliente($user, $pass, $nombre, $primerAP, $segundoAp, $tel, $tipo) {
            
            if($this->buscarCliente($user)) {
                echo "<script>alert('El usuario ya existe'); window.location.href='../../vistas/signup.php';</script>";
            } else {
                
                $sql = "INSERT INTO Usuarios VALUES(?, ?, ?, ?, ?, ?, ?)";
                $sentencia = $this->conexion->prepare($sql);
                $respuesta = $sentencia->execute([$user, sha1($pass), $nombre, $primerAP, $segundoAp, $tel, $tipo]);

                if(json_encode($respuesta)) {
                    $_SESSION['user'] = $user;
                    $_SESSION['tipoUser'] = $tipo;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['primerAp'] = $primerAP;
                    $_SESSION['segundoAp'] = $segundoAp;
                    $_SESSION['telefono'] = $tel;
                    
                    header('location:../../vistas/signup.php');
                } else {
                    echo "<script>alert('No se pudo registrar');
                            window.location.href='../../vistas/signup.php';</script>";
                    //header('location:../../vistas/signup.php');
                }
            }
            
        }

        



    }


?>