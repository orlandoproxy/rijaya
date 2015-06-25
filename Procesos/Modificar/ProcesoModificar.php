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
session_start();
$id = $_SESSION['idPedido'];
$modificar= "UPDATE REMPLAZO SET Pedido='$pedido', FechaEntrega='$fecha', Estatus='$estatus', Corte='$corte', Prensado='$prensado', Doblado='$doblado', Soldadura='$soldadura', Lavado='$lavado', Pintura='$pintura', Terminado='$terminado', ReferenciaVentas='$referencia' WHERE idPEDIDO='$id' ";
$querymodificar=mysqli_query($conn,$modificar);
if (!$querymodificar) 
{
	//mensaje de error
	echo '1';
}
else
{
	echo '2';
}	

?>