<?php

include('conexion.php');
session_start();
if (!$_SESSION['rolusuario'] =='admin') {
    header("location: principal.php");
}
$SelectedRol =0;
$selectedID = 0;
$selectedNombre = '';
$selectedApellido = '';
$selectedCorreo = '';

if (isset($_POST['metodo'])) {
    switch ($_POST['metodo']) {
        case 'Selecionar':
            $querymetodo = mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles WHERE usuarios_id = '$_POST[usuario_id]';");
            $selected	= mysqli_fetch_array($querymetodo); 
            if (isset($selected)) {
                $selectedID = $selected['usuarios_id'];
                $selectedNombre = $selected['nombre'];
                $selectedApellido = $selected['apellido'];
                $selectedCorreo = $selected['correo'];
                $selectedRol = $selected['rol_id'];		
            }
        break;
        case 'Editar':
            $querymetodo = mysqli_query($conn,"UPDATE `usuarios` SET `nombre` = '$_POST[nombre]', `apellido` = '$_POST[apellido]', `correo` = '$_POST[correo]', `rol_id` = '$_POST[rol]' WHERE `usuarios`.`usuarios_id` = '$_POST[usuario_id]';");
        break;
        case 'Borrar':
            $querymetodo = "DELETE FROM usuarios WHERE usuarios_id = '$_POST[usuario_id]';";
            $conn->query($querymetodo);
        break;
        case 'Cancelar':
            $selectedID = 0;
            $selectedNombre = "";
            $selectedApellido = "";
            $selectedCorreo = "";
            $selectedRol = "";
        break;
    }
}
?>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <link rel="stylesheet" href="login.css">
    </head>
    
    <body>
    <div class="cajafuera">
        <form action="administracion.php" method="post">
            <label for="usuario_id">ID de usuario</label>
            <input type="number" name="usuario_id" id="" readonly <?php echo"value='$selectedID'";?>>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="" <?php echo"value='$selectedNombre'";?>>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="" <?php echo"value='$selectedApellido'";?>>
            <label for="correo">Correo</label>
            <input type="text" name="correo" id="" <?php echo"value='$selectedCorreo'";?>>
            <label for="rol">Rol</label>
            <select name="rol" id="">
                <?php
                $queryrol 	= mysqli_query($conn,"SELECT * FROM roles;");
                $roles	= mysqli_fetch_all($queryrol);
                foreach ($roles as $key => $value) {
                    echo "<option value='$value[0]'";
                    if (isset($selectedRol)) {
                        if ($selectedRol==$value[0]) {
                            echo " selected";
                        }else{
                            echo"";
                        }
                    }
                    echo ">$value[1]</option>";
                }
                ?>
            </select>
            <input type="submit" name='metodo' value="Editar">
            <input type="submit" name='metodo' value="Cancelar">
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre y apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $queryusuario 	= mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles WHERE usuarios_id != 1;");
                    $mostrar	    = mysqli_fetch_all($queryusuario); 
                foreach ($mostrar as $key => $usuario) {
                    echo "
                    <tr>
                    <td>$usuario[1]</td>
                    <td>$usuario[2] $usuario[3]</td>
                    <td>$usuario[4]</td>
                    <td>$usuario[6]</td>
                        <td>
                            <form action='administracion.php' method='post'>
                                <input type='hidden' name='usuario_id' value='$usuario[1]'>
                                <input type='submit' name='metodo' value='Selecionar'>
                                <input type='submit' name='metodo' value='Borrar'>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
</body>

</html>