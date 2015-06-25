<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Insertar Pedido</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
<script type="text/javascript" src="../js/AgregarProducto.js"></script>
<script type="text/javascript" src="../js/buscar.js"></script>
</head>
<body>
	<div class="container">
<form method="post" action="Guardar.php">
		<h4>Datos Generales</h4>
		<table>
			<tr>
				<td>
					<div class="form-group">
						<label for="Pedido">Numero de pedido</label>
						<input type="text" class="form-control" name="numpedido" id="Pedido" onkeyup="loadPedido()" placeholder="N° de Pedido" required>

					</div>
				</td>
				<td>
					<div class="form-group">
						<label for="Vendedor">Vendedor</label>
						<select class="form-control" name="vendedor" id="Vendedor">
						<?php
						include("../../../clases/conexion.php");
						$selecinarVendedor="SELECT * FROM PERSONAL WHERE Categoria=1";
						$querySeleccionar=mysqli_query($conn,$selecinarVendedor);
						while ($fila=mysqli_fetch_array($querySeleccionar)) 
						{
							echo '<option value='.$fila['idPERSONAL'].'>'.$fila['ApellidoPaterno'].' '.$fila['ApellidoMaterno'].' '.$fila['Nombre'].'</option>';
						}
						mysqli_close($conn);
						?>
					    </select>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label for="FechaInicial">Fecha Inicial</label>
						<input type="date" class="form-control" name="fechaIngreso" id="FechaInicial" required>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label for="FechaInicial">Fecha Entrega</label>
						<input type="date" class="form-control" name="fechaEntrega" id="FechaEntrega" required>
					</div>
				</td>
				<td>
					<div class="form-group">
					<label for="Prio">Prioridad</label>
					<select class="form-control" name="prioridad" id="Prio">
						<option>Normal</option>
						<option>Media</option>
						<option>Urgente</option>
					</select>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label for="Tipo">Tipo de Pedido</label>
						<select name="tipo" id="Tipo" class="form-control">
							<option>Produccion Interna</option>
							<option>Rijaya Comercial</option>
							<option>Cliente Especial</option>
						</select>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label>Referencia del Pedido</label>
						<input type="text" class="form-control" name="referencia" maxlength="100" required>
					</div>
				</td>
			</tr>
			<tr>
				<td>
				
			</td>
			</tr>
		</table>
		<div class="alert" id="cont"></div>
		<a class="btn btn-primary" href='JavaScript:AgregarProducto();'>Agregar Producto</a>
		<hr>
		<table class="table">
			<thead>
				<tr>
					<td>Cantidad</td>
					<td>Tipo</td>
					<td>Clave</td>
					<td>Nombre Producto</td>
					<td>Color</td>
					<td>Descripcion</td>
				</tr>
			</thead>
			<tbody id="contenedor">

			</tbody>
		</table>
		<button type="submit" class="btn btn-success">Enviar</button>		
</form>
	</div>
</body>
</html>