<?php
include('../../../clases/conexion.php');
$Nombre = $_POST['nombre'];
$ApellidoPa = $_POST['apellidopa'];
$ApellidoMa = $_POST['apellidoma'];
$NombreUsuario = $_POST['nombreusuario'];
$Contra=md5($_POST['contra']);
$Estatus=$_POST['estatus'];
$Categoria=$_POST['categoria'];
$catego=$Categoria;

$sqlSeleccionar="SELECT * FROM PERSONAL WHERE Nombre='".$Nombre."' AND ApellidoPaterno='".$ApellidoPa."' AND ApellidoMaterno='".$ApellidoMa."' AND Usuario='".$NombreUsuario."' AND Estatus='".$Estatus."' AND Categoria='".$catego."'";
$sqlQueryInsertar=mysqli_query($conn,$sqlSeleccionar);
if ($resul=mysqli_fetch_assoc($sqlQueryInsertar)<1) 
{
	//cuando el nuevo usuario no esta registrado en la base de datos
	$sqlInsertarPersonal="INSERT INTO PERSONAL (Nombre,ApellidoPaterno,ApellidoMaterno,Usuario,Contra,Estatus,Categoria) VALUES('$Nombre','$ApellidoPa','$ApellidoMa','$NombreUsuario','$Contra','$Estatus','$catego')";
	$sqlQueryInsertar2=mysqli_query($conn,$sqlInsertarPersonal);
	if (!$sqlQueryInsertar2) 
	{
		header("Refresh: 7; URL=../index.php");
		echo '<h3>Error al Insertar Personal ,Por favor intentelo mas tarde, pulse </h3>';
		echo '<br>';
		
	}
	else
	{
		header("Refresh: 7; URL=../index.php");
		echo '<h3>Exito al Insertar Nuevo personal</h3>';
		echo '<br>';
		
	}

}
else
{
	//cuando el nuevo usuario existe dentro de la base de datos
	header("Refresh: 7; URL=../index.php");
	echo '<h3>El Usuario esta existente en el sistema, pulse </h3>';
	
}
?>