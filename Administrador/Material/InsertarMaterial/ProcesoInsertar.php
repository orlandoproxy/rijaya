<?php
include("../../../clases/conexion.php");
$clave = addslashes($_POST['clave']);
$nombre = addslashes($_POST['nombre']);
$catego = addslashes($_POST['catego']);
$consultaclave = "SELECT Clave FROM MATERIAL Where Clave = '$clave'";
$sqlConsulta1=mysqli_query($conn,$consultaclave);
if (mysqli_num_rows($sqlConsulta1)>0) 
{
	echo '1';
}
elseif (mysqli_num_rows($sqlConsulta1)<1) 
{
	$queryinsertar = "INSERT INTO MATERIAL (Clave,Nombre,Categoria) VALUES ('$clave','$nombre','$catego')";
	$sqlInsertar1 = mysqli_query($conn,$queryinsertar);
	if(!$sqlInsertar1)
		{
			echo '2';
		}
		else
			{
				echo '3';
			}
	
}
mysqli_close($conn);
?>