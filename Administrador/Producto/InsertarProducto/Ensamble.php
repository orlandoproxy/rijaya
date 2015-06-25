<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Ensambles</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="../../../js/jquery.js"></script>
	<script type="text/javascript" src="js/ensamble.js"></script>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		
		<h2>Ensambles</h2>
		<form class="form-group" method="post" action="ProcesoInsertar2.php">
			<label for="NombreEnsamble">Nombre</label>
			<input type="text" name="nombreensamble" id="nombreEnsamble" class="form-control" placeholder="Introduce el Nombre" required>
			<a class="btn btn-primary" id="agregar" href="javascript:AgregarEnsamble()">Agregar Subensamble</a>
			<hr class="hr">
			<table>
				<thead>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody id="contenedor"></tbody>
			</table>
			<input class="btn btn-success" type="submit"></input>
			</form>
		</div>
	</div>
</body>
</html>
