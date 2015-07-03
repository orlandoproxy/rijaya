<?php
include("../../../clases/conexion.php");
$numero=$_POST['q'];
$selecionarPedido="SELECT * FROM PEDIDO WHERE NumPedido LIKE '%$numero%'";
$queryPedido=mysqli_query($conn,$selecionarPedido);
if (mysqli_fetch_assoc($queryPedido)>0) 
{
	$queryPedido=mysqli_query($conn,$selecionarPedido);
	while ($fila=mysqli_fetch_array($queryPedido)) 
	{
		echo '<tr>';
		echo '<td>'.$fila['NumPedido'].'</td>';
		echo '<td>'.$fila['FechaIngreso'].'</td>';
		echo '<td>'.$fila['FechaSalida'].'</td>';
		echo '<td>'.$fila['Estatus'].'</td>';
		echo '<td>'.$fila['Prioridad'].'</td>';
		echo '<td>'.$fila['Tipo'].'</td>';
		echo '<td><a class="btn btn-primary" href="Continua.php?iid='.$fila['idPEDIDO'].'">Selecionar</a></td>';
		echo '</tr>';
	}
}
else
{
	echo '<h4>No hay coincidencias</h4>';
}
mysqli_close($conn);
?>