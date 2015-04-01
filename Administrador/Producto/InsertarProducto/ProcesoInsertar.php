<?php
include('../../../clases/conexion.php');

$clave = addslashes($_POST['clave']);
$nombre = addslashes($_POST['nombre']);
$tipo = addslashes($_POST['tipo']);
$estatus = addslashes($_POST['estatus']);
$descripcion = addslashes($_POST['descripcion']);
$categoria = addslashes($_POST['categoria']);
$medida1 = addslashes($_POST['medida1']);
$medida2 = addslashes($_POST['medida2']);
$medida3 = addslashes($_POST['medida3']);

$consulta = "SELECT * FROM CATEGORIA WHERE Nombre = '$categoria'";

$cate = mysqli_query($conn,$consulta);
$resp = mysqli_fetch_array($cate);
$categoria = $resp['idCATEGORIA'];
$consulta2 = "SELECT * FROM PRODUCTO WHERE Clave = '$clave' AND Nombre = '$nombre' AND Tipo = '$tipo' AND Estatus = '$estatus' AND CATEGORIA_idCATEGORIA = '$categoria' AND Medida1 = '$medida1' AND Medida2 = '$medida2'";
$respuesta = mysqli_query($conn,$consulta2);
if (mysqli_num_rows($respuesta)<1) 
{
	$consultainser = "INSERT INTO PRODUCTO (Clave,Nombre,Tipo,Estatus,Descripcion,CATEGORIA_idCATEGORIA,Medida1,Medida2,Medida3) VALUES ('$clave','$nombre','$tipo','$estatus','$descripcion','$categoria','$medida1','$medida2','$medida3')";
	
	$rsp = mysqli_query($conn,$consultainser);
	if(!$rsp)
	{
		echo "error";
	}
	else
	{
		session_start();
		$consulta = "SELECT idPRODUCTO FROM PRODUCTO WHERE Clave = '$clave' && Nombre='$nombre' && Tipo='$tipo' && Estatus='$estatus' && Descripcion='$descripcion' && CATEGORIA_idCATEGORIA = '$categoria' && Medida1='$medida1' && Medida2='$medida2'";
	
		$inser = mysqli_query($conn,$consulta);
		while ($sesion=mysqli_fetch_array($inser)) 
		{
			$_SESSION['idProdu'] = $sesion['idPRODUCTO'];
			echo '3';
		}

		
	}

}
else
{
	echo '2';
}
?>