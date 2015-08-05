<?php
if (isset($_GET['idp']) && isset($_GET['ido']))
{
	session_start();
	$_SESSION['idpieza']=$_GET['idp'];
	$_SESSION['idMaquindo']=$_GET['ido'];
	$idPROCESO=$_SESSION['idproceso'];
	$idPieza=$_GET['idp'];
	$idMaquindo=$_GET['ido'];
}
else
{
	header('location: ../');
}
?>
<?php
include("../../../clases/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
	<script type="text/javascript" src="../../../js/jquery.js"></script>
	<script type="text/javascript" src="dinamico.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			<?php
			$seleccionarpieza="SELECT PIEZA.Nombre,PIEZA.Medida1,PIEZA.Medida2,PIEZA.Medida3,MATERIAL.Nombre AS NombreMaterial FROM PIEZA INNER JOIN MATERIAL ON PIEZA.MATERIAL_idMATERIAL=MATERIAL.idMATERIAL WHERE idPIEZA=$idPieza";
			$queryPieza=mysqli_query($conn,$seleccionarpieza);
			$filaPieza=mysqli_fetch_assoc($queryPieza);
			?>
			<h1>Informacion de la Pieza</h1>
			<h3>Nombre:<?php echo $filaPieza['Nombre']; ?></h3>

			<h3>Medidas:<?php echo $filaPieza['Medida1']," X ",$filaPieza['Medida2']," x ",$filaPieza['Medida3']; ?></h3>

			<h3>Material: <?php echo $filaPieza['NombreMaterial']; ?></h3>
			</div>
			<div class="col-md-6">
				<?php
				$proceso=$_SESSION['idproceso'];
				//consultarstatus
				$consultaestatus="SELECT Cantidad,Estatus FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idMaquindo AND PIEZA_idPIEZA=$idPieza AND PROCESO_idPROCESO=$proceso";
				$queryEstatus=mysqli_query($conn,$consultaestatus);
				$filaEsatus=mysqli_fetch_assoc($queryEstatus);
				$consultaReal="SELECT SUM(Cantidad) FROM LISTAMAQUINADO WHERE MAQUINADO_idMAQUINADO=$idMaquindo";
				$querymaquinado=mysqli_query($conn,$consultaReal);
				$filaMa=mysqli_fetch_assoc($querymaquinado);
				?>
			<h1>Progreso de la Produccion</h1>
			<h4>Realizadas:<?php echo $filaMa['SUM(Cantidad)']; ?></h4>
			<h4>Merma:
				<?php
				$selecionarmerma1="SELECT SUM(Cantidad) FROM MERMA WHERE idPROCESO=$idPROCESO AND idLISTA=$idMaquindo";
				$queryMerma1=mysqli_query($conn,$selecionarmerma1);
				$filaMerm=mysqli_fetch_assoc($queryMerma1);
				echo $filaMerm['SUM(Cantidad)'];
				//clase
				?>
			</h4>
			<h4>Total:</h4>
			</div>
			<div class="col-md-2">
				<a class="btn btn-success" href="../">Regresar</a>
				<a class="btn btn-warning" href="../../clases/Salir.php">Salir</a>
			</div>
		</div>
		<table class="table">
			<tr>
				<td>
					<h2>Generar nueva tarea</h2>
					<table>
						<tr>
							<td>
								<a class="btn btn-primary" href="JavaScript:Formulario();">Generar Nueva Tarea</a>
							</td>

							<td>
								<a class="btn btn-primary" href="JavaScript:Ayudante();">Agregar ayudante</a>
							</td>
						</tr>
						<tr>
							<td>
								<div id="formulario"></div>

							</td>

							<td>
								<table id="ayudante" class="table">
								</table>
							</td>
						</tr>
					</table>
					<div class="row">
						<div class="col-md-8">
						</div>

					<div class="col-md-4">

					<div class="col-md-4">

					</div>
					</div>

				</td>
				<td>
						<h2>Hitorial</h2>
						<p>
					<table class="table">
						<thead>
							<tr>
								<td>Inicio</td>
								<td>Cantidad</td>
								<td>Final</td>
								<td>Estatus</td>
								<td></td>
							</tr>
						</thead>
						<tbody id="historial">
							<?php
							$selecionarlista="SELECT * FROM LISTAMAQUINADO WHERE MAQUINADO_idMAQUINADO=$idMaquindo ORDER BY `LISTAMAQUINADO`.`Estatus` ASC";
							//echo $selecionarlista;
							$queryLista=mysqli_query($conn,$selecionarlista);
							while ($filaHisto=mysqli_fetch_array($queryLista))
							{
								echo '<tr>';
									echo '<td>'.$filaHisto['Inicio'].'</td>';
									if ($filaHisto['Cantidad']<=0)
									{
										echo '<td><input type="text" id="cantidad_'.$filaHisto['idLISTAMAQUINADO'].'" class="form-control" size="5"></td>';
										echo '<td>'.$filaHisto['Final'].'</td>';
										echo '<td>'.$filaHisto['Estatus'].'</td>';
										echo '<td><a class="btn btn-warning" href="JavaScript:ActualizarProceso('.$filaHisto['idLISTAMAQUINADO'].');">Terminar Proceso</a></td>';
									}
									else
									{
										echo '<td>'.$filaHisto['Cantidad'].'</td>';
										echo '<td>'.$filaHisto['Final'].'</td>';
										echo '<td>'.$filaHisto['Estatus'].'</td>';
										echo '<td></td>';
									}

								echo '<tr>';
							}
							?>
						</tbody>
					</table>
				</p>
				</td>
				<td>
					<h2>Mermas</h2>
					<table class="table">
						<thead>
							<tr>
								<td>Cantidad</td>
								<td></td>
							</tr>
							<tr>
								<input type="hidden" id="proceso" value="<?php echo $idPROCESO; ?>">
								<input type="hidden" id="maquinado" value="<?php echo $idMaquindo; ?>">
								<td><input type="text" class="form-control" id="cantidadm"></td>
								<td><a href="JavaScript:Merma();" class="btn btn-primary">Agregar Merma</a></td>
							</tr>
						</thead>
						<tbody>
							<?php
							$consultaMerma="SELECT * FROM MERMA WHERE idPROCESO=$idPROCESO AND idLISTA=$idMaquindo";
							$queryMerma=mysqli_query($conn,$consultaMerma);
							while ($filaMerma=mysqli_fetch_array($queryMerma))
							{
								echo '<tr>';
								echo '<td>'.$filaMerma['Cantidad'].'</td>';
								echo '<td><a class="btn btn-danger" href="JavaScript:EliminarMerma('.$filaMerma['idMERMA'].');">Eliminar</a></td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
