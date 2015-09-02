<?php
include("../../../clases/conexion.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
  <SCRIPT TYPE="text/javascript"></SCRIPT>
<title>Insertar nuevo</title>
<div class="container">
	<form method="post" action="guardarrol.php">
		<div class="form-group">
			<label for="Nombre">Nombre</label>
			<select name="Nombre" class="form-control">
				<?php
				$selecionarpersonas="SELECT * FROM PERSONAL WHERE Categoria=5";
				$queryPersonal=mysqli_query($conn,$selecionarpersonas);
				while ($fila=mysqli_fetch_array($queryPersonal))
				{
					echo '<option value='.$fila['idPERSONAL'].'>';
					echo $fila['Nombre']," ",$fila['ApellidoPaterno']," ",$fila['ApellidoMaterno'];

					echo '</option>';
				}
				?>
			</select>


		</div>
		<div class="form-group">
			<label for="Proceso">Proceso</label>
			<select name="Proceso" class="form-control" required>
				<?php
				$SelecionarProcesos="SELECT idPROCESO, Nombre FROM PROCESO";
				$sqlProceso=mysqli_query($conn,$SelecionarProcesos);
				while ($fila2=mysqli_fetch_array($sqlProceso))
				{
					echo '<option value='.$fila2['idPROCESO'].'>';
					echo $fila2['Nombre'];
					echo '</option>';
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="FechaInicio" >Fecha Inicio</label>
			<input type="date" class="form-control" name="FechaInicio" required>
		</div>

		<input type="submit" class="btn btn-success" text="Enviar">
		<a class="btn btn-warning" href="../">Cancelar</a>
	</form>
</div>
</head>
</html>
