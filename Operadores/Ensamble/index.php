<?php
session_start();
if (isset($_SESSION['idproceso'])) 
{
	$proceso=$_SESSION['idproceso'];
	echo $proceso;
}
else
{
	
	 header('location: ../../');
}
include("../../clases/conexion.php");
?>
<!DOCTYPE html>
<html lang="esp">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Maquinado</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
	<div class="row">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">

		<div id="navbar" class="navbar-collapse collapse">
			<div class="navbar-form navbar-left">
				<label>Bienvenido:<?php
				$idoperdor=$_SESSION['id'];
				echo $idoperdor;
				$selecionaroperador="SELECT Nombre,ApellidoPaterno,ApellidoMaterno FROM PERSONAL WHERE idPERSONAL=$idoperdor";
				$queryoperador=mysqli_query($conn,$selecionaroperador);
				$fila=mysqli_fetch_assoc($queryoperador);
				echo $fila['Nombre']," ",$fila['ApellidoPaterno']," ",$fila['ApellidoMaterno']; 
				

				 ?></label>
			</div>
			<div class="navbar-form navbar-right">
				<a class="btn btn-warning" href="../clases/Salir.php">Salir</a>
			</div>
		</div>
			</div>
	</nav>

	</div>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
				<div class="table-responsive">
		<h1>Lista de Ensamble: 
			<?php
			$proceso=$_SESSION['idproceso'];
			$selecProceso="SELECT Nombre FROM PROCESO WHERE idPROCESO=$proceso";
			$queryProceso=mysqli_query($conn,$selecProceso);
			$filaproceso=mysqli_fetch_assoc($queryProceso);
			echo $filaproceso['Nombre']; 
			?>
		</h1>
			<table class="table">
				<thead>
					<tr class="active">
						<td>N° proceso</td>
						<td>Cantidad</td>
						<td>Pieza</td>
						<td>Estatus</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
					$seleccionarmaquinado="SELECT ORDENPROCESO.Clave,MAQUINADO.Cantidad,PIEZA.Nombre,MAQUINADO.Estatus,PIEZA.idPIEZA,MAQUINADO.idMAQUINADO FROM MAQUINADO INNER JOIN ORDENPROCESO ON ORDENPROCESO.idORDENPROCESO=MAQUINADO.ORDENPROCESO_idORDENPROCESO INNER JOIN PIEZA ON PIEZA.idPIEZA=MAQUINADO.PIEZA_idPIEZA WHERE MAQUINADO.PROCESO_idPROCESO=$proceso";
					echo $seleccionarmaquinado;
					$querymaqunado=mysqli_query($conn,$seleccionarmaquinado);
					while ($filama=mysqli_fetch_array($querymaqunado)) 
					{
						if ($filama['Estatus'] == 'No Iniciado') 
						{
							$clase="success";
						}
						elseif ($filama['Estatus'] == 'En proceso') 
						{
							$clase="warning";
						}
						$idPIEZA=$filama['idPIEZA'];
						$idOrden=$filama['idMAQUINADO'];
						echo '<tr class="'.$clase.'">';
						echo '<td>'.$filama['Clave'].'</td>';
						echo '<td>'.$filama['Cantidad'].'</td>';
						echo '<td>'.$filama['Nombre'].'</td>';
						echo '<td>'.$filama['Estatus'].'</td>';
						echo '<td><a class="btn btn-primary" href="TomarProceso/?idp='.$idPIEZA.'&ido='.$idOrden.'">Tomar Orden</a></td>';
						echo '</tr>';
					}
					?>	
				</tbody>

			</table>
		</div>
	</div>

	</div>
</body>
</html>
<?php
mysqli_close($conn);
?>