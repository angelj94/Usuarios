<?php

include('conexion.php');
session_start();
if (!$_SESSION['rolusuario'] =='admin') {
    header("location: principal.php");
}
elseif(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: index.html');
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <link rel="stylesheet" href="login.css">
    </head>
    
    <body>
    <div class="cajafuera">
        <div class="container-fluid"> 
            <div class="mb-3 row">        
            <div class="col-4">     
                                  
                    <form  action="administracion.php" method="post">
                         
            <div class="col-2">
                        <label for="usuario_id">ID de usuario</label>
                        <input type="number" name="usuario_id" id="" readonly <?php echo"value='$selectedID'";?>>
            </div>  
            <div class="col-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="" <?php echo"value='$selectedNombre'";?>>
            </div>
            <div class="col-2">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="" <?php echo"value='$selectedApellido'";?>>
            </div>
            <div class="col-2">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="" <?php echo"value='$selectedCorreo'";?>>
            </div>
            <div class="col-2">
                        <label for="rol">Rol</label>
                        <select name="rol" id="">
            </div>
                    
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
                        
                        <input class="btn btn-success mb-3"  type="submit" name='metodo' value="Editar">
                        
                        <input class="btn btn-secondary mb-3" type="submit" name='metodo' value="Cancelar">
                        
                        <input class="btn btn-dark mb-3" type="submit" value="Cerrar sesión" name="btncerrar">
                           
       
                    </form>
          
                        </div>  
                        </div>                   
    
               
          
         
          <div class="col-8">
          <div class="table-responsive">
          <table class="table table-primary table align-middle"> 
            <thead>
        <tr>
            <th scope="col"> ID </th>         
            <th scope="col"> Nombre y apellido </th>
            <th scope="col"> Correo </th>    
            <th scope="col"> Rol </th>
            <th class="align-middle"colspan="2"> Acción </th>
        </tr>     
                        </thead>
                    
                        <tbody class="table-group-divider">
                <?php 
                    $queryusuario 	= mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles WHERE usuarios_id != 1;");
                    $mostrar	    = mysqli_fetch_all($queryusuario); 
                foreach ($mostrar as $key => $usuario) {
                    echo "
                    <form action='administracion.php' method='post'>  
                     <tr>
                    <td>$usuario[1]</td>
                    <td>$usuario[2] $usuario[3]</td>
                    <td>$usuario[4]</td>
                    <td>$usuario[6]</td>
                                
                            
                                <input type='hidden' name='usuario_id' value='$usuario[1]'>
                               <td> <input class='btn btn-primary' type='submit' name='metodo' value='Selecionar'>
                            <input class='btn btn-danger' type='submit' name='metodo' value='Borrar'></td>
                                
                            
                            </tr>
                            </form> ";
  
                }
                ?>
            
            
            </tbody>
            </table>
      
 </div> 
           
</div>  
        
           
          
    
</body>

</html>