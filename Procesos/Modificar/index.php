<?php
include('../../clases/conexion.php');
session_start();
if (isset($_SESSIO['id'])) 
{
	header('Location: ../ index.html');
}
else
{
	$id = $_SESSION['id'];
}
$consulta = "SELECT * FROM REMPLAZO WHERE idPEDIDO = '$id'";
$query=mysqli_query($conn,$consulta);
$fila = mysqli_fetch_array($query);


?>
<html lang="esp">
<head>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/insertar.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Insertar Control</title>

<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<div class="form-horizontal">
			<div class="form-group">
				<label for="Pedido" fom class="col-lg-2 control-label">N° Pedido</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="Pedido" value="<?php echo $fila['Pedido']; ?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="Fecha" class="col-lg-2 control-label" >Fecha Entrega:</label>
				<div class="col-lg-10">
					<input class="form-control" type="date" id="Fecha" step="1" min="2012-01-01" max="2020-01-01" value="<?php echo $fila['FechaEntrega']; ?>">
				</div>
			</div>
			<div class="form-gruop">
				<label for="Estatus" class="col-lg-2 control-label">Estatus</label>
				<div class="col-lg-10">
					<select id="Estatus" class="form-control" value="<?php echo $fila['Estatus']; ?>">
						<option>Entregado</option>
						<option>En Progreso</option>
						<option>Vencido</option>						
					</select>
				</div>
			</div>
			<div class="form-group">
				<h3>Procesos</h3>
				<div class="table-responsive">
					<table class="table">
					<tr class="success">
					<td>
						<label class="form-inline">Corte:</label>
						<input type="text" id="Corte" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Corte']; ?>">
					</td>
					<td>
						<label class="form-inline">Prensado:</label>
						<input type="text" id="Prensado" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Prensado']; ?>">
					</td>
					<td>
						<label class="form-inline">Doblado:</label>
						<input type="text" id="Doblado" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Doblado']; ?>">
					</td>
					<td>
						<label class="form-inline">Soldadura:</label>
						<input type="text" id="Soldadura" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Soldadura']; ?>">
					</td>
					<td>
						<label class="form-inline">Lavado:</label>
						<input type="text" id="Lavado" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Lavado']; ?>">
					</td>
					<td>
						<label class="form-inline">Pintura:</label>
						<input type="text" id="Pintura" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Pintura']; ?>">
					</td>
					<td>
						<label class="form-inline">Termiando:</label>
						<input type="text" id="Terminado" class="form-inline" placeholder="0% - 100%" size="5" value="<?php echo $fila['Terminado']; ?>">
					</td>

				</tr>
					</table>

				</div>				
			</div>
			<div class="form-group">
				<label for="Referencia" class="col-lg-2 control-label" >Refreencia Rijaya Comercial: </label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="Referencia" placeholder="Introduce el N° de refrerencia" value="<?php echo $fila['ReferenciaVentas']; ?>">
				</div>
			</div>
			<button id="Guardar" class="btn btn-primary">Actualizar</button>
		</div>
		<div id="mensaje"></div>
	</div>
</body>
</html>