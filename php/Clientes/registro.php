<?php
    session_start();

    include('clientesDAO.php');
    //=========================================================================
    
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nombre = $_POST['name'];
    $pap = $_POST['primerAp'];
    $sap = $_POST['segundoAp'];
    $tel = $_POST['telefono'];
    $tipo = 2;


    $key = '6LeLKgYaAAAAAM6-ENbZwKt8W21wZtxqdBazSXej';

    if (isset($_POST['g-recaptcha-response'])) {
        
        $captcha = $_POST['g-recaptcha-response']; 
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $key, 'response' => $captcha, 'remoteip' => $_SERVER['REMOTE_ADDR']);
        
        $curlConfig = array(CURLOPT_URL => $url, CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $data);
        
        $ch = curl_init();
        curl_setopt_array($ch, $curlConfig);
        $response = curl_exec($ch);
        curl_close($ch);
    }
        
    $jsonResponse = json_decode($response);
    
    if ($jsonResponse->success === true) {

        //MI CODIGO

        $datosValidos = false;
        if(strlen($user) > 5) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoUser'] = $user;
            $_SESSION['errorUser'] = "¡Usuario no permitido!";
        }

        if(strlen($pass) > 5) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoPass'] = $pass;
            $_SESSION['errorPass'] = "¡Contraseña muy corta!";
        } 

        if(strlen($nombre) > 0 && !is_numeric($nombre)) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoName'] = $nombre;
            $_SESSION['errorName'] = "¡Nombre no válido!";
        }

        if(strlen($pap) > 0 && !is_numeric($pap)) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoPap'] = $pap;
            $_SESSION['errorPap'] = "¡Apellido no válido!";
        }

        if(ctype_alpha($sap)) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoSap'] = $sap;
            $_SESSION['errorSap'] = "¡Apellido no válido!";
        }

        if(strlen($tel) == 10 && is_numeric($tel)) {
            $datosValidos = true;
        } else {
            $datosValidos = false;
            $_SESSION['datoTel'] = $tel;
            $_SESSION['errorTel'] = "¡Telefono no válido!";
        }


        if($datosValidos) {
            $cDAO = new ClienteDAO();
            $cDAO->agregarCliente($user, $pass, $nombre, $pap, $sap, $tel, $tipo);
        } else {
            //Cerrar conexión
            $_SESSION['datoUser'] = $user;
            $_SESSION['datoPass'] = $pass;
            $_SESSION['datoName'] = $nombre;
            $_SESSION['datoPap'] = $pap;
            $_SESSION['datoSap'] = $sap;
            $_SESSION['datoTel'] = $tel;
            
            header('location:../../vistas/signup.php');
        }
    
        //AQUI TERMINA MI CODIGO
    } else { 
        header('location:../../vistas/signup.php');    
    }
    
?>