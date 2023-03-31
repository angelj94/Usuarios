<?php

include('conexion.php');
session_start();
$queryusuario 	= mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles");
$mostrar	= mysqli_fetch_all($queryusuario); 
if (!$_SESSION['rolusuario'] =='admin') {
    header("location: principal.php");
}
if (isset($_POST['metodo'])) {
    switch ($_POST['metodo']) {
        case 'Selecionar':
            # code...
            break;
        case 'Editar':
            # code...
            break;
        case 'Borrar':
            # code...
            break;
        case 'Cancelar':
            # code...
            break;
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="cajafuera">
    <?php 
    foreach ($mostrar as $usuario) {
        echo "<br>rol_id = ".$usuario[0];
        echo "<br>usuario_id = ".$usuario[1];
        echo "<br>nombre = ".$usuario[2];
        echo "<br>apellido = ".$usuario[3];
        echo "<br>correo = ".$usuario[4];
        echo "<br>contraseña(hash) = ".$usuario[5];
        echo "<br>rol = ".$usuario[6];
        echo "<br>";
    }
    ?>
    </div>
    
</body>

</html>