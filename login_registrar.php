<?php

include('conexion.php');

//Para iniciar sesión
if(isset($_POST["btnloginx"]))
{
	$correo = $_POST["txtcorreo"];
	$contraseña 	= $_POST["txtpassword"];

	$queryusuario = mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles WHERE correo = '$correo'");
$nr 		= mysqli_num_rows($queryusuario); 
$mostrar	= mysqli_fetch_array($queryusuario); 
	
if (($nr == 1) && (password_verify($contraseña,$mostrar['contraseña'])) )
	{ 
		session_start();
		$_SESSION['nombredelusuario']=$mostrar['nombre'];
		$_SESSION['rolusuario']= $mostrar['rol'];		
		$_SESSION['apellidousuario']= $mostrar['apellido'];
		$_SESSION['correousuario']= $mostrar['correo'];
		header("Location: principal.php");
	}
else
	{
	echo "<script> alert('Usuario o contraseña incorrecto.');/*window.location= 'index.html' </script>";
	}
}

//Para registrar
if(isset($_POST["btnregistrarx"]))
{
	
	$nombre = $_POST["txtusuario"];
	$contraseña 	= $_POST["txtpassword"];
	$apellido = $_POST["txtapellido"];
	$correo = $_POST["txtcorreo"];

$queryusuario 	= mysqli_query($conn,"SELECT * FROM usuarios NATURAL JOIN roles WHERE correo = '$correo'");
$nr 			= mysqli_num_rows($queryusuario); 

if ($nr == 0)
{

	$pass_fuerte = password_hash($contraseña, PASSWORD_BCRYPT);
	$queryregistrar = "INSERT INTO usuarios (nombre,apellido,correo, contraseña) values ('$nombre','$apellido','$correo', '$pass_fuerte')";
	

if(mysqli_query($conn,$queryregistrar))
{
	echo "<script> alert('Usuario registrado: $nombre');window.location= 'principal.php' </script>";
	session_start();
		$_SESSION['nombredelusuario']=$nombre;
		$_SESSION['rol']= 'usuario';
		$_SESSION['apellidousuario']=$apellido;
		$_SESSION['correousuario']=$correo;

		header("Location: principal.php");
}
else 
{
	echo "Error: " .$queryregistrar."<br>".mysqli_error($conn);
}

}else
{
		echo "<script> alert('Correo ya en uso	: $correo');window.location= 'index.html' </script>";
}

} 

?>