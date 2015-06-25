<?php
include("../../clases/conexion.php");
session_start();
$estatus="";
$q=$_POST['q'];
if (isset($_SESSION['estatus'])) 
{
	$estatus=$_SESSION['estatus'];
}
else
{
	$estatus="Activo";
}
$Selecionarpedido="SELECT * FROM PEDIDO WHERE NumPedido LIKE '%".$q."%' AND Estatus = '$estatus'";
$queryPedido=mysqli_query($conn,$Selecionarpedido);
while ($pedidofila=mysqli_fetch_array($queryPedido)) 
{
	echo '<tr>';
	echo '<td>'.$pedidofila['NumPedido'].'</td>';
	echo '<td>'.$pedidofila['Estatus'].'</td>';
	echo '<td>'.$pedidofila['Prioridad'].'</td>';
	echo '<td><a class="btn btn-success	" href="Selecionarpedido/index.php?refidpe='.$pedidofila['idPEDIDO'].'">Seleccionar</a></td>';
	echo '</tr>';
}
?>