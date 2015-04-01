<?php
include '../../../clases/conexion.php';
//session_start();

if ( (isset($_SESSION['idProdu']) == FALSE)&&(isset($_GET['IDPro'])==FALSE) ) 
{
	header('Location:../../index.php');
}
elseif (isset($_SESSION['idProdu']) == TRUE) 
{
	$idproducto= $_SESSION['idProdu'];
}
elseif (isset($_GET['IDPro'])== TRUE) 
{
	$idproducto = $_GET['IDPro'];
}
?>
<?php
// seleccion producto
$sqlProducto = "SELECT * FROM PRODUCTO WHERE idPRODUCTO = '$idproducto' ";
$respuesta= mysqli_query($conn,$sqlProducto);
$respuestaProdu= mysqli_fetch_assoc($respuesta);
//echo $sqlProducto;
?>
<html>
<head>
	<title>Informacion Producto</title>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
</head>
<body>

	<h2>Informacion del Producto</h2>
<br>
<label>Clave: <?php echo $respuestaProdu['Clave']; ?> </label>
<br>
<label>Nombre: <?php echo $respuestaProdu['Nombre']; ?></label>
<br>
<label>Tipo: <?php echo $respuestaProdu['Tipo']; ?></label>
<br>
<label>Estatus: <?php echo $respuestaProdu['Estatus']; ?></label>
<br>
<label>Descripción: <?php echo $respuestaProdu['Descripcion']; ?></label>
<br>
<label>Medidas: <?php echo $respuestaProdu['Medida1'],"cm x ",$respuestaProdu['Medida2'],"cm x",$respuestaProdu['Medida3'],"cm"; ?></label>
<br>
<br>
<br>
<h3>Piezas</h3>
<div class="table-responsive">
<table class="table">
	<tr>
		<td>Cantidad</td>
		<td>Nombre</td>
		<td>Medidas</td>
		<td>Material</td>		
					<?php
					$sqlConsulPro="SELECT Nombre FROM `PROCESO`";
					$respuestaProceso=mysqli_query($conn,$sqlConsulPro);					
					while ($filaProc=mysqli_fetch_array($respuestaProceso)) 
					{
						echo '<td>';
						echo $filaProc['Nombre'];
						echo '</td>';
					}
					?>
				</tr>
			
				<?php 
				$sqlproducPieza="SELECT `PIEZA_idPIEZA`, `Cantidad` FROM PRODUCTOPIEZA WHERE PRODUCTO_idPRODUCTO='$idproducto'";
				$sqlconsulta4 = mysqli_query($conn,$sqlproducPieza);
				while ($filaProduPieza=mysqli_fetch_array($sqlconsulta4)) 
				{
					echo '<tr>';
					echo '<td>';
					echo $filaProduPieza['Cantidad'];
					echo '</td>';
					$idPieza = $filaProduPieza['PIEZA_idPIEZA'];
					$sqlPieza="SELECT * FROM PIEZA WHERE idPIEZA = '$idPieza'";

					$sqlconsulta5=mysqli_query($conn,$sqlPieza);
					while ($filaPieza=mysqli_fetch_array($sqlconsulta5)) 
					{
						echo '<td>';
						echo $filaPieza['Nombre'];
						echo '</td>';
						echo '<td>';
						echo $filaPieza['Medida1'],'cm x ',$filaPieza['Medida2'],'cm x ',$filaPieza['Medida3'],'cm';
						echo '</td>';
						$idmaterial= $filaPieza['MATERIAL_idMATERIAL'];
						$sqlmaterial="SELECT Nombre FROM MATERIAL WHERE idMATERIAL='$idmaterial'";
						$sqlconsulta6=mysqli_query($conn,$sqlmaterial);
						$nombrematerial=mysqli_fetch_assoc($sqlconsulta6);
						echo '<td>';
						echo $nombrematerial['Nombre'];
						echo '</td>';
						$sqlProcesoBu="SELECT idPROCESO FROM PROCESO";
						$sqlconsulta7=mysqli_query($conn,$sqlProcesoBu);

						while ($filaProceso=mysqli_fetch_array($sqlconsulta7)) 
						{

							$idproceso=$filaProceso['idPROCESO'];
							$sqlbusqueda="SELECT * FROM PIEZAPROCESO WHERE PROCESO_idPROCESO='$idproceso' && PIEZA_idPIEZA='$idPieza'";
							$sqlconsulta8=mysqli_query($conn,$sqlbusqueda);
							
							if (mysqli_num_rows($sqlconsulta8)>0) 
							{
								//tenemos coincidencias
								echo '<td>';
								echo '<img src="../../../iconos/glyphicons-207-ok-2.png">';
								echo '</td>';
							}
							else
							{
								echo '<td>';
								echo '<img src="../../../iconos/glyphicons-208-remove-2.png">';
								echo '</td>';

							}

						}



					}
					echo '</tr>';
				}
				?>
				
</table>
</div>
<a class="btn btn-success" href="../index.php">Continuar</a>
</body>
</html>

