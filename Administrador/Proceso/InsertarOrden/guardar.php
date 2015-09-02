<?php
session_start();
$idPedido=	$_SESSION['idpedido'];
include("../../../clases/conexion.php");
session_start();
if (isset($_SESSION['idpedido']))
{

}
$contadorttabla=0;
$idpedido=$_SESSION['idpedido'];
$concentrado=array();
$cont=0;
foreach ($_REQUEST as $key => $value)
{
	$concentrado[$cont]=$value;
	$cont=$cont+1;
}
echo '<br>';
$InsertarProceso="INSERT INTO ORDENPROCESO (FechaEmicion,Prioridad,Estatus,PEDIDO_idPEDIDO) VALUES('$concentrado[0]','$concentrado[1]','No Iniciado','$idpedido')";
echo $InsertarProceso;
unset($concentrado[0]);
unset($concentrado[1]);
$concentrado=array_values($concentrado);
echo '<br>';
?>
<!DOCTYPE html>
<html lang="esp">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Procesos</title>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<h2>Maquinado</h2>
			<?php
			for ($i=1; $i <=4; $i++)
			{
				switch ($i)
				{
					case 1:
						echo '<h3>Corte</h3>';
						break;
					case 2:
							echo '<h3>Troquelado</h3>';
						break;
					case 3:
							echo '<h3>Gramilado</h3>';
							break;
					case 4:
							echo '<h3>Doblado</h3>';
							break;

				}
				//creacion formmuulario maquinado (corte,troqquelado,gramilado y ddoblado)
				foreach ($concentrado as $key => $value)
				{//selecionamos los productos que se mandaron en el formulario
					$cantidadProducto=$value[1];
					$idProducto=$value[0];

					$CantidadPiezas="SELECT PRODUCTOPIEZA.PIEZA_idPIEZA, PRODUCTOPIEZA.Cantidad,PIEZA.Nombre, PIEZA.Medida1, PIEZA.Medida2, PIEZA.Medida3, MATERIAL.Nombre FROM PRODUCTOPIEZA INNER JOIN PIEZAPROCESO ON PRODUCTOPIEZA.PIEZA_idPIEZA=PIEZAPROCESO.PIEZA_idPIEZA INNER JOIN PIEZA ON PIEZA.idPIEZA=PRODUCTOPIEZA.PIEZA_idPIEZA INNER JOIN MATERIAL ON PIEZA.MATERIAL_idMATERIAL=MATERIAL.idMATERIAL WHERE PRODUCTOPIEZA.PRODUCTO_idPRODUCTO=$idProducto AND PIEZAPROCESO.PROCESO_idPROCESO=$i";
					$selecionProducto="SELECT Nombre FROM PRODUCTO WHERE idPRODUCTO=$idProducto";
					$queryProducto=mysqli_query($conn,$selecionProducto);
					$queryPiezas=mysqli_query($conn,$CantidadPiezas);

					$nombreproducto=mysqli_fetch_array($queryProducto);
					echo '<table id="'.$contadorttabla.'" class="table">';
					echo '<thead>';
					echo '<tr>';
					echo '<td>'.$cantidadProducto.'</td>';
					echo '<td>'.$nombreproducto[0].'</td>';
					echo '<td><a class="btn btn-danger">Eliminar tabla</a></td>';
					echo '</tr>';
					echo '<tr class="success">';
					echo '<td width="80">Cantidad</td>';
					echo '<td>Nombre</td>';
					echo '<td>Medidas</td>';
					echo '<td>Material</td>';
					echo '<td></td>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while ($filaPiezas=mysqli_fetch_array($queryPiezas))
					{
						echo '<tr>';
						$cantidadPieza=$filaPiezas[1];
						$cantidadTotal=$cantidadProducto*$cantidadPieza;
						$NombrePieza=$filaPiezas[2];
						$MedidasPiezas=$filaPiezas[3].' x '.$filaPiezas[4].' x '.$filaPiezas[5];
						$MaterialPieza=$filaPiezas[6];
						echo '<td width="80"><input type="text" class="form-control" id="" name="" value="'.$cantidadTotal.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="" value="'.$NombrePieza.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="" value="'.$MedidasPiezas.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="" value="'.$MaterialPieza.'"></td>';
						echo '<td><a class="btn btn-warning">Eliminar</a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					$contadorttabla=$contadorttabla+1;
				}
				echo '<hr>';
			}
			//proceso de mostrar ensambless para soldaduray punteado
			echo '<h2>Ensambles</h2>';
			echo '<h3>Punteado</h3>';
			foreach ($concentrado as $key => $value)
			{
				$idPoducto=$value[0];
				$cantidadProducto=$value[1];
				$selecionProducto="SELECT Nombre FROM PRODUCTO WHERE idPRODUCTO=$idPoducto";
				$queryProducto=mysqli_query($conn,$selecionProducto);
				$filaproducto=mysqli_fetch_array($queryProducto);
				echo '<label>Producto: '.$filaproducto[0].'</label>';
				echo '<br>';
				echo '<table id="'.$contadorttabla.'" class="table">';
				echo '<thead>';
				echo '<tr class="warning">';
				echo '<td>Cantidad</td>';
				echo '<td>Nombre</td>';
				echo '<td>Descripcion</td>';
				echo '<td></td>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				$selecionarEnsambles="SELECT SUBENSAMBLE.Cantidad, SUBENSAMBLE.Nombre FROM PRODUCTO INNER JOIN ENSAMBLE ON PRODUCTO.idPRODUCTO=ENSAMBLE.PRODUCTO_idPRODUCTO INNER JOIN SUBENSAMBLE ON ENSAMBLE.idENSAMBLE=SUBENSAMBLE.ENSAMBLE_idENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble=SUBENSAMBLE.ENSAMBLE_idENSAMBLE WHERE PRODUCTO.idPRODUCTO=$idPoducto AND SUBENSAMBLEPROCESO.PROCESO_idPROCESO=5";
				$querysoldadura=mysqli_query($conn,$selecionarEnsambles);
				while ($filasoldadura=mysqli_fetch_array($querysoldadura))
				{
					$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
					echo '<tr>';
					echo '<td><input type="text" class="form-control" value="'.$cantidadtotal.'"> </td>';
					echo '<td><input type="text" class="form-control" value="'.$filasoldadura['Nombre'].'"> </td>';
					echo '<td><input type="text" class="form-control"></td>';
					echo '<td><a class="btn btn-warning">Eliminar</a></td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
				$contadorttabla=$contadorttabla+1;
			}
			//sooldadura
			echo '<h3>Soldadura</h3>';
			foreach ($concentrado as $key => $value)
			{
				$idPoducto=$value[0];
				$cantidadProducto=$value[1];
				$selecionProducto="SELECT Nombre FROM PRODUCTO WHERE idPRODUCTO=$idPoducto";
				$queryProducto=mysqli_query($conn,$selecionProducto);
				$filaproducto=mysqli_fetch_array($queryProducto);
				echo '<label>Producto: '.$filaproducto[0].'</label>';
				echo '<br>';
				echo '<table id="'.$contadorttabla.'" class="table">';
				echo '<thead>';
				echo '<tr class="success">';
				echo '<td>Cantidad</td>';
				echo '<td>Nombre</td>';
				echo '<td>Descripcion</td>';
				echo '<td></td>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				$selecionarEnsambles="SELECT SUBENSAMBLE.Cantidad, SUBENSAMBLE.Nombre FROM PRODUCTO INNER JOIN ENSAMBLE ON PRODUCTO.idPRODUCTO=ENSAMBLE.PRODUCTO_idPRODUCTO INNER JOIN SUBENSAMBLE ON ENSAMBLE.idENSAMBLE=SUBENSAMBLE.ENSAMBLE_idENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble=SUBENSAMBLE.ENSAMBLE_idENSAMBLE WHERE PRODUCTO.idPRODUCTO=$idPoducto AND SUBENSAMBLEPROCESO.PROCESO_idPROCESO=6";
				$querysoldadura=mysqli_query($conn,$selecionarEnsambles);
				while ($filasoldadura=mysqli_fetch_array($querysoldadura))
				{
					$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
					echo '<tr>';
					echo '<td><input type="text" class="form-control" value="'.$cantidadtotal.'"</td>';
					echo '<td><input type="text" class="form-control" value="'.$filasoldadura['Nombre'].'"</td>';
					echo '<td><input type="text" class="form-control"></td>';
					echo '<td><a class="btn btn-warning">Eliminar</a></td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
				$contadorttabla=$contadorttabla+1;
			}
			for ($i=1; $i <=2; $i++)
			{ if ($i==1)
				{
				echo '<h3>Lavado</h3>';
				$proceso=7;
				}
				elseif ($i==2)
				{
					echo '<h3>Sacudido</h3>';
					$proceso=10;
				}
				foreach ($concentrado as $key => $value)
				{
					$idPoducto=$value[0];
					$cantidadProducto=$value[1];
					$selecionProducto="SELECT Nombre FROM PRODUCTO WHERE idPRODUCTO=$idPoducto";
					$queryProducto=mysqli_query($conn,$selecionProducto);
					$filaproducto=mysqli_fetch_array($queryProducto);
					echo '<label>Producto: '.$filaproducto[0].'</label>';
					echo '<br>';
					echo '<table id="'.$contadorttabla.'" class="table">';
					echo '<thead>';
					echo '<tr class="success">';
					echo '<td>Cantidad</td>';
					echo '<td>Nombre</td>';
					echo '<td>Descripcion</td>';
					echo '<td></td>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					$selecionarEnsambles="SELECT SUBENSAMBLE.Cantidad, SUBENSAMBLE.Nombre FROM PRODUCTO INNER JOIN ENSAMBLE ON PRODUCTO.idPRODUCTO=ENSAMBLE.PRODUCTO_idPRODUCTO INNER JOIN SUBENSAMBLE ON ENSAMBLE.idENSAMBLE=SUBENSAMBLE.ENSAMBLE_idENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble=SUBENSAMBLE.ENSAMBLE_idENSAMBLE WHERE PRODUCTO.idPRODUCTO=$idPoducto AND SUBENSAMBLEPROCESO.PROCESO_idPROCESO=$proceso";
					$querysoldadura=mysqli_query($conn,$selecionarEnsambles);
					while ($filasoldadura=mysqli_fetch_array($querysoldadura))
					{
						$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
						echo '<tr>';
						echo '<td><input type="text" class="form-control" value="'.$cantidadtotal.'"></td>';
						echo '<td><input type="text" class="form-control" value="'.$filasoldadura['Nombre'].'"></td>';
						echo '<td><input type="text" class="form-control"></td>';
						echo '<td><a class="btn btn-warning">Eliminar</a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					$contadorttabla=$contadorttabla+1;
				}
			}
			//seccion de pintura
			echo '<h3>Pintura</h3>';
			echo '<table id="'.$contadorttabla.'" class="table">';
			echo '<thead>';
			echo '<tr class="success">';
			echo '<td>Cantidad</td>';
			echo '<td>Nombre</td>';
			echo '<td>Color</td>';
			echo '<td></td>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach ($concentrado as $key => $value)
			{
				$idPoducto=$value[0];
				$cantidadProducto=$value[1];
				$selecionProducto="SELECT Nombre FROM PRODUCTO WHERE idPRODUCTO=$idPoducto";
				$queryProducto=mysqli_query($conn,$selecionProducto);
				$filaproducto=mysqli_fetch_array($queryProducto);
				$selecionarEnsambles="SELECT SUBENSAMBLE.Cantidad, SUBENSAMBLE.Nombre FROM PRODUCTO INNER JOIN ENSAMBLE ON PRODUCTO.idPRODUCTO=ENSAMBLE.PRODUCTO_idPRODUCTO INNER JOIN SUBENSAMBLE ON ENSAMBLE.idENSAMBLE=SUBENSAMBLE.ENSAMBLE_idENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble=SUBENSAMBLE.ENSAMBLE_idENSAMBLE WHERE PRODUCTO.idPRODUCTO=$idPoducto AND SUBENSAMBLEPROCESO.PROCESO_idPROCESO=$proceso";
				$querysoldadura=mysqli_query($conn,$selecionarEnsambles);
				while ($filasoldadura=mysqli_fetch_array($querysoldadura))
				{
					$selecionarcolor="SELECT COLOR.Color FROM PEDIDOPRODUCTO INNER JOIN COLOR ON PEDIDOPRODUCTO.COLOR_idCOLOR=COLOR.idCOLOR WHERE PEDIDOPRODUCTO.PEDIDO_idPEDIDO=$idpedido AND PEDIDOPRODUCTO.PRODUCTO_idPRODUCTO=$idPoducto";
					//echo $selecionarcolor;
					$querycolor=mysqli_query($conn,$selecionarcolor);
					$filacolor=mysqli_fetch_array($querycolor);
					$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
					echo '<tr>';
					echo '<td><input type="text" class="form-control" value="'.$cantidadtotal.'"></td>';
					echo '<td><input type="text" class="form-control" value="'.$filasoldadura['Nombre'].'"></td>';
					echo '<td><input type="text" class="form-control" value="'.$filacolor['Color'].'"></td>';
					echo '<td><a class="btn btn-warning">Eliminar</a></td>';
					echo '</tr>';
				}
				$contadorttabla=$contadorttabla+1;
			}
			echo '</tbody>';
			echo '</table>';

			//seccion de terminado
			echo '<h3>Terminado</h3>';
			echo '<table id="'.$contadorttabla.'" class="table">';
			echo '<thead>';
			echo '<tr class="success">';
			echo '<td>Cantidad</td>';
			echo '<td>Nombre</td>';
			echo '<td>Color</td>';
			echo '<td></td>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';

			 ?>
		</div>
	</body>
</html>
<<?php
mysqli_close($conn);
 ?>
