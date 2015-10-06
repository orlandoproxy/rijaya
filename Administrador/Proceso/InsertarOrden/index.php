<?php
include('../../clases/redireccion.php');
?>
<!DOCTYPE html>
<html lang="esp">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generar Orden de Proceso</title>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
	<script type="text/javascript" src="../../../js/jquery.js"></script>
	<script type="text/javascript" src="../js/dinamico.js"></script>
</head>
<body>
<div class="container">
		<div class="row">
			<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-left">
            <input id="buscar" type="text" class="form-control" placeholder="Buscar..." onkeyup="loadXMLDoc()">
            <a class="btn btn-primary">Generar</a>
          </form>
        </div>
      </div>
    </nav>
	</div>
	<br>
	<br>
	<br>
	<br>
	<table class="table">
		<thead>
			<tr>
				<td>N° Pedido</td>
				<td>Fecha Entrada</td>
				<td>Fecha Salida</td>
				<td>Estatus</td>
				<td>Prioridad</td>
				<td>Referencia</td>
				<td></td>
			</tr>
		</thead>
		<tbody id="contenedor">
		</tbody>
	</table>
</div>
</div>
</body>
<script type="text/javascript" src="../../../js/jquery.js"></script>
<script type="text/javascript" src="../../../js/bootstrap.min.js"></script>
</html>
