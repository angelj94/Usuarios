<link rel="stylesheet" href="login.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<div class="cajafuera">
<div class="pagprincipal">
	
<div class="container-fluid">     
<div class="row">
	
<?php
include('conexion.php');
session_start();

if(isset($_SESSION['nombredelusuario']))
{
	$usuarioingresado = $_SESSION['nombredelusuario'];
	$apellidousuario=$_SESSION['apellidousuario'];
	$correousuario=$_SESSION['correousuario'];
	echo "<h1 class='animate animated animate BackInLeft'>Bienvenido:</h1>";
	echo "<h1> $usuarioingresado $apellidousuario </h1>";
	echo "<small class='text-body-secondary'>$correousuario </small>";

}
else
{
	header('location: index.html');
}

if ($_SESSION['rolusuario'] == 'admin') {
	echo "<p>eres el admin</p>";
	echo "<a href='administracion.php'> Administrar</a>";
}
?>

<form method="POST">
<input class="btn btn-Primary mb-3" value="Cerrar sesión" name="btncerrar"/>
</form>
</div>
</div>


<?php

if(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: index.html');
}
	
?>

</div>

</div>