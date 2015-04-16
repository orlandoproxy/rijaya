<?php
include('../clases/conexion.php');
//funcion calcular fecha
$q="";
$q=$_POST['q'];
//obtener datos completos
$selectProceso="SELECT * FROM REMPLAZO WHERE Pedido LIKE '%".$q."%' ";
$queryProceso=mysqli_query($conn,$selectProceso);
while ($filaProcesp=mysqli_fetch_array($queryProceso))
 {
 	$total=($filaProcesp['Corte']+$filaProcesp['Prensado']+$filaProcesp['Doblado']+$filaProcesp['Soldadura']+$filaProcesp['Lavado']+$filaProcesp['Pintura']+$filaProcesp['Terminado'])/7;
 	$hoy = "20".date("y")."-".date("m")."-".date("d");
 	$dias=(strtotime($filaProcesp['FechaEntrega'])-strtotime($hoy))/86400;
 	$dias= floor($dias);
	echo '<tr>';
	echo '<td>'.$filaProcesp['Pedido'].'</td><td>'.$filaProcesp['FechaEntrega'].'</td>';
	echo '<td>'.$dias.'</td><td>'.$filaProcesp['Estatus'].'</td>';
	echo '<td>
	<div class="progress">
	 <div class="progress-bar" role="progressbar" aria-valuenow="'.$total.'"
       aria-valuemin="0" aria-valuemax="100" style="width: '.$total.'%;">

	</div>
	</div>
	</td>';
	echo '<td>'.$filaProcesp['ReferenciaVentas'].'</td>';
	echo '</tr>';


}


?>