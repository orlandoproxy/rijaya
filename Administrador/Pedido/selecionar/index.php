<?php
include("../../../clases/conexion.php");
$id=$_GET['iped'];
$seleccionPedido="SELECT * FROM PEDIDO WHERE idPEDIDO=$id";
$querySeleccion=mysqli_query($conn,$seleccionPedido);
while ($filaPedido=mysqli_fetch_array($querySeleccion))
{
	$Numero=$filaPedido['NumPedido'];
	$FechaInicial=$filaPedido['FechaIngreso'];
	$FechaSalida=$filaPedido['FechaSalida'];
	$Estatus=$filaPedido['Estatus'];
	$Prioridad=$filaPedido['Prioridad'];
	$Tipo=$filaPedido['Tipo'];
	$Referencia=$filaPedido['ReferenciaVentas'];
	$idVendedor=$filaPedido['PERSONAL_idPERSONAL'];
}
?>
<html lang="esp">
<head>
	<title>Pedido N° <?php echo $Numero; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1>Informacion del Pedido N°<?php echo $Numero; ?></h1>
	<h4>Fecha de Emicion: <?php echo $FechaInicial; ?></h4>
	<h4>Fecha de Entrega: <?php echo $FechaSalida; ?></h4>
	<h4>Estatus: <?php echo $Estatus;?></h4>
	<h4>Prioridad: <?php echo $Prioridad;?></h4>
	<h4>Tipo de Pedido:<?php echo $Tipo; ?></h4>
	<h4>Referencia de Venta:<?php echo $Referencia; ?></h4>
	<?php
	$SeleccionarVendedor="SELECT * FROM PERSONAL WHERE idPERSONAL=$idVendedor";
	$queryvendedor=mysqli_query($conn,$SeleccionarVendedor);
	while ($filaVendedor=mysqli_fetch_array($queryvendedor))
	{
		$nombre=$filaVendedor['Nombre'];
		$apellidopa=$filaVendedor['ApellidoPaterno'];
		$apellidoma=$filaVendedor['ApellidoMaterno'];
	}
	?>
	<h4>Vendedor: <?php echo $apellidopa," ",$apellidoma," ",$nombre; ?></h4>
<hr>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr class="success">
				<td>Clave</td>
				<td>Nombre</td>
				<td>Cantidad</td>
				<td>Color</td>
				<td>Descripcion</td>
				<td>Progreso</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$selecionarProductos="SELECT * FROM PEDIDOPRODUCTO WHERE PEDIDO_idPEDIDO=$id";
			$queryproductos=mysqli_query($conn,$selecionarProductos);
			while ($filaproduc=mysqli_fetch_array($queryproductos))
			{
				echo '<tr>';
				$idProducto=$filaproduc['PRODUCTO_idPRODUCTO'];
				$Selecproducto="SELECT Clave,Nombre FROM PRODUCTO WHERE idPRODUCTO=$idProducto";
				$querydatospr=mysqli_query($conn,$Selecproducto);
				$datospro=mysqli_fetch_assoc($querydatospr);
				$idcolor=$filaproduc['COLOR_idCOLOR'];
				$selecioncolor="SELECT Color FROM COLOR WHERE idCOLOR=$idcolor";
				$queryColor=mysqli_query($conn,$selecioncolor);
				$litacolor=mysqli_fetch_assoc($queryColor);

				$clave=$datospro['Clave'];
				$nombre=$datospro['Nombre'];
				$cantidad=$filaproduc['Cantidad'];
				$color=$litacolor['Color'];
				$descripcion=$filaproduc['Descripcion'];
				echo '<td>'.$clave.'</td>';
				echo '<td>'.$nombre.'</td>';
				echo '<td>'.$cantidad.'</td>';
				echo '<td>'.$color.'</td>';
				echo '<td>'.$descripcion.'</td>';
				echo '<td>0%</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	<a class="btn btn-success" href="../">Continuar</a>
</div>
</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
