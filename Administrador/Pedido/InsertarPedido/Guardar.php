<?php
include("../../../clases/conexion.php");
$lista= array();
//$long=count($_POST);
$contador=0;
foreach ($_POST as $key => $value) 
{
	$lista[$contador]=$value;
	$contador=$contador+1;
}
$NumeroPedido=$lista[0];
$vendedor=$lista[1];
$FechaIn=$lista[2];
$FechaSa=$lista[3];
$Estatus="No Iniciado";
$Prioridad=$lista[4];
$TipoPedido=$lista[5];
$Referencia=$lista[6];
//Comprobar si Existe un Pedido Identico
$InsertarPedido="INSERT INTO PEDIDO (NumPedido,FechaIngreso,FechaSalida,Estatus,Prioridad,Tipo,ReferenciaVentas,PERSONAL_idPERSONAL) VALUES('$NumeroPedido','$FechaIn','$FechaSa','$Estatus','$Prioridad','$TipoPedido','$Referencia','$vendedor')";
$queryInsertar=mysqli_query($conn,$InsertarPedido);
$idPedido=mysqli_insert_id($conn);
unset($lista[0]);
unset($lista[1]);
unset($lista[2]);
unset($lista[3]);
unset($lista[4]);
unset($lista[5]);
unset($lista[6]);
$lista=array_values($lista);
$long=count($lista);
while ($long>1) 
{
	$Cantidad=$lista[0];
	$idProducto=$lista[1];
	$Color=$lista[2];
	$Descripcion=$lista[3];
	$InsertarRelacion="INSERT INTO PEDIDOPRODUCTO (Cantidad,Descripcion,PEDIDO_idPEDIDO,COLOR_idCOLOR,PRODUCTO_idPRODUCTO) VALUES('$Cantidad','$Descripcion','$idPedido','$Color','$idProducto')";
	$queryRelacion=mysqli_query($conn,$InsertarRelacion);
	unset($lista[0]);
	unset($lista[1]);
	unset($lista[2]);
	unset($lista[3]);
	$lista=array_values($lista);
	$long=count($lista);
}
header("Location:../index.php");
?>