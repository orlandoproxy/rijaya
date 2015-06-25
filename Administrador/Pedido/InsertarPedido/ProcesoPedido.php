<?php
include("../../../clases/conexion.php");
$Numero=$_POST['q'];

	$SelecionarNumero="SELECT NumPedido FROM PEDIDO WHERE NumPedido=$Numero";
	//echo $SelecionarNumero;
	$queryNumero=mysqli_query($conn,$SelecionarNumero);
	$largo=mysqli_fetch_assoc($queryNumero);
	if ($largo>0) 
	{
		echo '<div class="alert-danger">Numero de pedido ocupado, intente con uno distinto</div>';
	}
	else
	{
		echo '<div class="alert-success">Numero de pedido disponible</div>';
	}

mysqli_close($conn);
?>