<?php
//print_r($_REQUEST);
if (isset($_SESSION["idProdu"])) 
{
	include("../../../clases/conexion.php");
session_start();
$cadena=[];
$contador=0;
$idProducto=$_SESSION["idProdu"];
$tama=count($_REQUEST);

if (is_array($_REQUEST)==TRUE) 
{
	foreach ($_REQUEST as $cadena[$contador] => $value) 
	{
		$cadena[$contador]=$value;
		$contador=$contador+1;
	}

}
print_r($cadena);
$NombreEnsamble=$cadena[0];
$InsertarEnsamble="INSERT INTO ENSAMBLE (Nombre,PRODUCTO_idPRODUCTO) VALUES('$NombreEnsamble','$idProducto')";
$queryInsertarEnsamble=mysqli_query($conn,$InsertarEnsamble);
$Referencia=mysqli_insert_id($conn);
unset($cadena[0]);
$cadena=array_values($cadena);
while (count($cadena)>1) 
{

	$Cantidad=$cadena[0];
	$NombreSub=$cadena[1];
	$Procesos=$cadena[2];
	$Piezas=$cadena[3];

	echo "_________";
	$InsertarSubensamble="INSERT INTO SUBENSAMBLE (Nombre,Ensamble_idEnsamble,Cantidad) VALUES('$NombreSub',$Referencia,$Cantidad)";
	echo $InsertarSubensamble;
	$queryInsertarSubensamble=mysqli_query($conn,$InsertarSubensamble);
	$idSubensamble=mysqli_insert_id($conn);
	foreach ($Procesos as $key => $value) 
	{
		$InsertarProceso="INSERT INTO SUBENSAMBLEPROCESO (SUBENSAMBLE_idSubensamble,PROCESO_idPROCESO) VALUES('$idSubensamble','$value')";
		echo $InsertarProceso;
		$querysubensableproceso=mysqli_query($conn,$InsertarProceso);
	}
	foreach ($Piezas as $key => $value) 
	{
		$InsertarPieza="INSERT  INTO SUBENSAMBLEPIEZA (SUBENSAMBLE_idSubensamble,PIEZA_idPIEZA) VALUES('$idSubensamble','$value')";
		echo $InsertarPieza;
		$queryPieza=mysqli_query($conn,$InsertarPieza);
	}
	unset($cadena[0]);
	unset($cadena[1]);
	unset($cadena[2]);
	unset($cadena[3]);
	$cadena=array_values($cadena);
}
mysqli_close($conn);
unset($_SESSION["idProdu"]);
header("Location: ../");
}
else
{
	header("Location: ../");

}

?>