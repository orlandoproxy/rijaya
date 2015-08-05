<?php
include("../../../clases/conexion.php");
$idNombre=$_POST['Nombre'];
$idProceso=$_POST['Proceso'];
$Fecha=$_POST['FechaInicio'];
$verificarrol="SELECT * FROM ROLES WHERE PROCESO_idPROCESO='$idProceso' AND PERSONAL_idPERSONAL='$idNombre' AND FechaEntrada='$Fecha'";
$mysqlverificar=mysqli_query($conn,$verificarrol);
$tamaño=mysqli_fetch_assoc($mysqlverificar);
if ($tamaño>0) 
{
	header("Refresh: 7; URL=../index.php");
		echo '<h3>El Rol ya esta registrado</h3>';
		echo '<br>';}
else
{
	$insertarRol="INSERT INTO ROLES (PROCESO_idPROCESO,PERSONAL_idPERSONAL,FechaEntrada,Estatus) VALUES('$idProceso','$idNombre','$Fecha','Activo')";
	$queryrol=mysqli_query($conn,$insertarRol);
	header("Refresh: 7; URL=../index.php");
		echo '<h3>Exito al Insertar Nuevo rol</h3>';
		echo '<br>';
}
mysqli_close($conn);
?>