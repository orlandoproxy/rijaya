<?php
include('../../clases/conexion.php');
$pedido = addslashes($_POST['pedido']);
$fecha = addslashes($_POST['fecha']);
$estatus = addslashes($_POST['estatus']);
$corte = addslashes($_POST['corte']);
$prensado = addslashes($_POST['prensado']);
$doblado = addslashes($_POST['doblado']);
$soldadura = addslashes($_POST['soldadura']);
$lavado = addslashes($_POST['lavado']);
$pintura = addslashes($_POST['pintura']);
$terminado = addslashes($_POST['terminado']);
$referencia = addslashes($_POST['referencia']);
$consulta1="SELECT Pedido FROM REMPLAZO WHERE Pedido='$pedido' && FechaEntrega= '$fecha'";
$query1=mysqli_query($conn,$consulta1);
if (mysqli_num_rows($query1)>0) 
{
	//proceso ya existente
	echo '1';
}
else
{
	$insertar1="INSERT INTO REMPLAZO (Pedido,FechaEntrega,Estatus,Corte,Prensado,Doblado,Soldadura,Lavado,Pintura,Terminado,ReferenciaVentas) VALUES ('$pedido','$fecha','$estatus',$corte,'$prensado','$doblado','$soldadura','$lavado','$terminado','$pintura','$referencia')";
	$query2=mysqli_query($conn,$insertar1);
	$id = mysqli_insert_id($conn);
	if (!$query2) 
	{
		//error al insertar 
		echo "2";
	}
	else
	{
		echo "3";
		session_start();
		$_SESSION['id'] = $id;

	}

}
mysqli_close($conn);
?>