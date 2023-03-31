<link rel="stylesheet" href="login.css">
<div class="cajafuera">
<div class="pagprincipal">
	
<?php
include('conexion.php');
session_start();

if(isset($_SESSION['nombredelusuario']))
{
	$usuarioingresado = $_SESSION['nombredelusuario'];
	$apellidousuario=$_SESSION['apellidousuario'];
	$correousuario=$_SESSION['correousuario'];
	echo "<h1>Bienvenido: $usuarioingresado. $apellidousuario </h1>";
	echo "<p>$correousuario </p>";

}
else
{
	header('location: index.html');
}
if ($_SESSION['rolusuario'] == 'admin') {
	echo 'eres el admin';
	echo "<a href='administracion.php'> Administrar</a>";
}
?>
<form method="POST">
<tr><td colspan='2' align="center"><input type="submit" value="Cerrar sesión" name="btncerrar" /></td></tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: index.html');
}
	
?>

</div>

</div>