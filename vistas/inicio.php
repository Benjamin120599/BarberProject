<?php
    session_start();

    if(!isset($_SESSION['nombre'])) {
        header('Location: login.php');    
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Inicio</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    
</body>
</html>
