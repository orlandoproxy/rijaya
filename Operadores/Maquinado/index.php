<!DOCTYPE html>
<html lang="esp">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Maquinado</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="table-responsive">
			<h1>Lista de Procesos: Corte</h1>
			<table class="table">
				<thead>
					<tr class="active">
						<td>N° proceso</td>
						<td>Cantidad</td>
						<td>Pieza</td>
						<td>Estatus</td>
						<td>Avance</td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr class="success">
						<td>2230</td>
						<td>50</td>
						<td>Poste #</td>
						<td>No iniciado</td>
						<td>0/50</td>
						<td><a class="btn btn-primary" href="TomarProceso/">Iniciar</a></td>
					</tr>
					<tr class="warning">
						<td>2230</td>
						<td>25</td>
						<td>Entrepaño #</td>
						<td>Iniciado</td>
						<td>12/25</td>
						<td><a class="btn btn-primary">Continuar</a></td>
					</tr>
				</tbody>

			</table>
		</div>
	</div>
<a class="btn btn-danger" href="../../">salir</a>
</body>
</html>
<?php
session_start();
unset($_SESSION['id'],$_SESSION['categoria'],$_SESSION['idTerminal']);
?>