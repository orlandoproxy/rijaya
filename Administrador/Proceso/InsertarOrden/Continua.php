<?php
if (isset($_GET['iid'])) 
{
	$idPedido=$_GET['iid'];
}
else
{
	echo "no hay pedidos selecionados";
}
?>
<!DOCTYPE html>
<html lang="esp">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Selecionar Productos</title>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
</head>
<body>
<form action="guardar.php" method="POST">
	<div class="container">
		<h2>Llene el formulario</h2>
		<div class="row">
			<div class="col-md-2">
				<label for="inicio">Fecha Inicio</label>
				<input type="date" id="inicio" name="inicio" class="form-control" required>
			</div>
			<div class="col-md-2">
				<label for="salida">Fecha salida</label>
				<input id="salida" type="date" name="salida" class="form-control" disabled>
			</div>
			<div class="col-md-2">
				<label for="prioridad">Prioridad</label>
				<select id="prioridad" class="form-control" name="Prioridad" required>
					<option>Normal</option>
					<option>Media</option>
					<option>Urgente</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="estatus">Estatus</label>
				<select class="form-control" id="estatus" id="estatus" disabled>
					<option>No Iniciado</option>
					<option>Activo</option>
					<option>Suspendido</option>
				</select>
			</div>
			<div class="col-md-2">
			</div>

		</div>
		<h2>Seleccione los Productos</h2>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<td></td>
						<td>Cantidad</td>
						<td>Nombre</td>
						<td>Descripcion</td>
						<td>Medidas</td>
						<td>Color</td>
					</tr>
				</thead>
				<tbody>
					<?php
					include("../../../clases/conexion.php");
					$selecionarProductospedido="SELECT PEDIDOPRODUCTO.PRODUCTO_idPRODUCTO,PEDIDOPRODUCTO.Cantidad, PRODUCTO.Nombre,PEDIDOPRODUCTO.Descripcion, PRODUCTO.Medida1, PRODUCTO.Medida2, PRODUCTO.Medida3, COLOR.Color FROM PEDIDOPRODUCTO INNER JOIN PRODUCTO ON PEDIDOPRODUCTO.PRODUCTO_idPRODUCTO=PRODUCTO.idPRODUCTO INNER JOIN COLOR ON PEDIDOPRODUCTO.COLOR_idCOLOR=COLOR.idCOLOR WHERE PEDIDOPRODUCTO.PEDIDO_idPEDIDO=$idPedido";
					$sqlSelecion=mysqli_query($conn,$selecionarProductospedido);
					$cont=0;
					while ($fila=mysqli_fetch_array($sqlSelecion)) 
					{
						echo '<tr>';
						echo '<td><input type="checkbox" class="form-control" value="'.$fila['PRODUCTO_idPRODUCTO'].'" name="producto'.$cont.'[]" required></td>';
						echo '<td><input type="text" class="form-control" name="producto'.$cont.'[]" value="'.$fila['Cantidad'].'" readonly="readonly" size="2"></td>';
						echo '<td>'.$fila['Nombre'].'</td>';
						echo '<td>'.$fila['Descripcion'].'</td>';
						echo '<td>'.$fila['Medida1'].'</td>';
						echo '<td>'.$fila['Color'].'</td>';
						echo '</tr>';
						$cont=$cont+1;
					}
					mysqli_close($conn);
					session_start();
					$_SESSION['idpedido']=$idPedido;
					?>
				</tbody>
			</table>
				<input type="submit" class="btn btn-success" value="enviar">
</form>
		</div>
	</div>
</body>
</html>