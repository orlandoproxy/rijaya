<?php
include ('../../../clases/conexion.php');
session_start();
//$idProduc = $_SESSION['idProdu'];
//echo $idProduc;
//$consulta= "SELECT * FROM PRODUCTO WHERE idPRODUCTO = '$idProduc'";
//$query = mysql_query($conn,$consulta);
?>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Agregar Piezas</title>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
	<script src="../../../js/jquery.js"></script>
	<script src="js/dinamico.js"></script>
</head>
<body>
<div clas="container">
	<h1>Paso 2 de 3</h1>
	<form class="" action="Mostrar.php" method="post">
		<a class="btn btn-primary" href='JavaScript:AgregarCampo();'>Agregar Pieza</a>
		<div class="table-responsive">
			<table class="table">
			<thead>
				<tr>
					<td>Cantidad</td>
					<td>Nombre Pieza</td>
					<td>Medidas</td>
					<td>Procesos</td>
					<td>Material</td>
				</tr>

			</thead>
			<tbody id="Contenido">

			</tbody>
		</table>
		</div>
		<button class="btn btn-primary" type="submit" >Enviar</button>

	</form>
</div>
</body>
</html>
