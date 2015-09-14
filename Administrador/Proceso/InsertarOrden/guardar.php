<?php
session_start();
$idPedido=	$_SESSION['idpedido'];
include("../../../clases/conexion.php");
if (isset($_SESSION['idpedido']))
{

}
$contadorttabla=0;
$idpedido=$_SESSION['idpedido'];
$selecionarpedido="SELECT NumPedido FROM PEDIDO WHERE idPEDIDO=$idPedido";
$querypedido=mysqli_query($conn,$selecionarpedido);
$filapedido=mysqli_fetch_assoc($querypedido);
$numeropedido=$filapedido["NumPedido"];
$concentrado=array();
$cont=0;
foreach ($_REQUEST as $key => $value)
{
	$concentrado[$cont]=$value;
	$cont=$cont+1;
}
echo '<br>';
$Selecionarordenproceso="SELECT count(*) FROM `ORDENPROCESO` WHERE PEDIDO_idPEDIDO=$idpedido";
$queryselecionar=mysqli_query($conn,$Selecionarordenproceso);
$tamanioproceso=mysqli_fetch_assoc($queryselecionar);
$numero=$tamanioproceso["count(*)"]+1;
$referencia=$numeropedido.'-'.$numero;
$InsertarProceso="INSERT INTO ORDENPROCESO (FechaEmicion,Prioridad,Estatus,PEDIDO_idPEDIDO,Clave) VALUES('$concentrado[0]','$concentrado[1]','Iniciado','$idpedido','$referencia')";
$queryproceso=mysqli_query($conn,$InsertarProceso);
$idprocesoproduccion= mysqli_insert_id($conn);
$_SESSION['idpro']=$idprocesoproduccion;
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
	<script src="../../../js/jquery.js"></script>
	<script src="js/form.js"></script>
	</head>
	<body>
		<form method="post" action="Mostrar.php">
		<div id="contenedor" class="container">

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
					echo '<table id="1_'.$i.'_'.$contadorttabla.'" class="table">';
					echo '<thead>';
					echo '<tr>';
					echo '<input type="hidden" name="1_'.$i.'_'.$contadorttabla.'_[tipo]" value="1">';
					echo '<input type="hidden" name="1_'.$i.'_'.$contadorttabla.'_[proceso]" value="'.$i.'">';
					echo '<td width="20"><input type="hidden" name="1_'.$i.'_'.$contadorttabla.'_[idProducto]" value="'.$idProducto.'" > <input type="text" class="form-control" name="1_'.$i.'_'.$contadorttabla.'_[cantidad]" value="'.$cantidadProducto.'"</td>';
					echo '<td><input type="text" class="form-control" name="1_'.$i.'_'.$contadorttabla.'_[nombre]" value="'.$nombreproducto[0].'"</td>';
					echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(1,'.$i.','.$contadorttabla.');">Eliminar tabla</a></td>';
					echo '</tr>';
					echo '<tr class="success">';
					echo '<td >Cantidad</td>';
					echo '<td>Nombre</td>';
					echo '<td>Medidas</td>';
					echo '<td>Material</td>';
					$totalmaquinado="SELECT COUNT(*) FROM PRODUCTOPIEZA INNER JOIN PIEZAPROCESO ON PRODUCTOPIEZA.PIEZA_idPIEZA=PIEZAPROCESO.PIEZA_idPIEZA INNER JOIN PIEZA ON PIEZA.idPIEZA=PRODUCTOPIEZA.PIEZA_idPIEZA INNER JOIN MATERIAL ON PIEZA.MATERIAL_idMATERIAL=MATERIAL.idMATERIAL WHERE PRODUCTOPIEZA.PRODUCTO_idPRODUCTO=$idProducto AND PIEZAPROCESO.PROCESO_idPROCESO=$i";
					$querytotal=mysqli_query($conn,$totalmaquinado);
					$resultadototal=mysqli_fetch_array($querytotal);
					echo '<td><a class="btn btn-primary" href="javascript:AgregarMas('.$resultadototal['COUNT(*)'].');">Agregar</a></td>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					$countpieza=0;
					while ($filaPiezas=mysqli_fetch_array($queryPiezas))
					{
						echo '<tr id="'.$countpieza.'" >';
						$cantidadPieza=$filaPiezas[1];
						$cantidadTotal=$cantidadProducto*$cantidadPieza;
						$NombrePieza=$filaPiezas[2];

						$MedidasPiezas=$filaPiezas[3].' x '.$filaPiezas[4].' x '.$filaPiezas[5];
						$MaterialPieza=$filaPiezas[6];
						echo '<td width="20"><input type="text" class="form-control" id="" name="1_'.$i.'_'.$contadorttabla.'_[piezas][lista_'.$countpieza.'][cantidadpieza]" value="'.$cantidadTotal.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="1_'.$i.'_'.$contadorttabla.'_[piezas][lista_'.$countpieza.'][nombrepieza]" value="'.$NombrePieza.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="1_'.$i.'_'.$contadorttabla.'_[piezas][lista_'.$countpieza.'][medidas]" value="'.$MedidasPiezas.'"></td>';
						echo '<td><input type="text" class="form-control" id="" name="1_'.$i.'_'.$contadorttabla.'_[piezas][lista_'.$countpieza.'][material]" value="'.$MaterialPieza.'"></td>';
						echo '<td><a class="btn btn-warning" onclick="EliminarFila(1,'.$i.','.$contadorttabla.','.$countpieza.')">Eliminar</a></td>';
						echo '</tr>';
						$countpieza=$countpieza+1;
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
				echo '<br>';
				echo '<table id="2_5_'.$contadorttabla.'" class="table">';
				echo '<thead>';
				echo '<tr>';
				echo '<input type="hidden" name="2_5_'.$contadorttabla.'_[tipo]" value="2">';
				echo '<input type="hidden" name="2_5_'.$contadorttabla.'_[proceso]" value="5">';
				echo '<input type="hidden" name="2_5_'.$contadorttabla.'_[idProducto]" value="'.$idPoducto.'">';
				echo '<td width="20"><input type="text" class="form-control" id="2_5_'.$contadorttabla.'_[cantidad]" name="2_5_'.$contadorttabla.'_[cantidad]" value="'.$cantidadProducto.'"></td>';
				echo '<td><input type="text" class="form-control" id="2_5_'.$contadorttabla.'_[nombre]" name="2_5_'.$contadorttabla.'_[nombre]" value="'.$filaproducto[0].'"></td>';
				echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(2,5,'.$contadorttabla.');">Eliminar tabla</a></td>';
				echo '</tr>';
				echo '<tr class="success">';
				echo '<td>Cantidad</td>';
				echo '<td>Nombre</td>';
				echo '<td>Descripcion</td>';
				$selecionarEnsambles="SELECT SUBENSAMBLE.Cantidad, SUBENSAMBLE.Nombre FROM PRODUCTO INNER JOIN ENSAMBLE ON PRODUCTO.idPRODUCTO=ENSAMBLE.PRODUCTO_idPRODUCTO INNER JOIN SUBENSAMBLE ON ENSAMBLE.idENSAMBLE=SUBENSAMBLE.ENSAMBLE_idENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble=SUBENSAMBLE.ENSAMBLE_idENSAMBLE WHERE PRODUCTO.idPRODUCTO=$idPoducto AND SUBENSAMBLEPROCESO.PROCESO_idPROCESO=5";
				$querysoldadura=mysqli_query($conn,$selecionarEnsambles);
				echo '<td></td>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				$countpunteado=0;
				while ($filasoldadura=mysqli_fetch_array($querysoldadura))
				{
					$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
					echo '<tr>';
					echo '<td width="20"><input type="text" class="form-control" name="2_5_'.$contadorttabla.'_[ensamble_'.$countpunteado.'][cantidad]" value="'.$cantidadtotal.'"> </td>';
					echo '<td><input type="text" class="form-control" id="2_5_'.$contadorttabla.'_[ensamble_'.$countpunteado.'][nombre]" value="'.$filasoldadura['Nombre'].'"> </td>';
					echo '<td><input type="text" class="form-control" id="2_5_'.$contadorttabla.'_[ensamble_'.$countpunteado.'][descripcion]"></td>';
					echo '<td><a class="btn btn-warning">Eliminar</a></td>';
					echo '</tr>';
					$countpunteado=$countpunteado+1;
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
				echo '<br>';
				echo '<table id="2_6_'.$contadorttabla.'" class="table">';
				echo '<thead>';
				echo '<tr>';
				echo '<input type="hidden" name="2_6_'.$contadorttabla.'_[tipo]" value="2">';
				echo '<input type="hidden" name="2_6_'.$contadorttabla.'_[proceso]" value="6">';
				echo '<input type="hidden" name="2_6_'.$contadorttabla.'_[idProducto]" value="'.$idPoducto.'">';
				echo '<td width="20"><input type="text" class="form-control" id="2_6_'.$contadorttabla.'_[cantidad]" name="2_6_'.$contadorttabla.'_[cantidad]" value="'.$cantidadProducto.'"></td>';
				echo '<td><input type="text" class="form-control" id="2_6_'.$contadorttabla.'_[nombre]" name="2_6_'.$contadorttabla.'_[nombre]" value="'.$filaproducto[0].'"></td>';
				echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(2,6,'.$contadorttabla.');">Eliminar tabla</a></td>';
				echo '</tr>';
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
				$counsoldadura=0;
				while ($filasoldadura=mysqli_fetch_array($querysoldadura))
				{
					$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
					echo '<tr>';
					echo '<td width="20"><input type="text" class="form-control" id="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][cantidad]" name="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][cantidad]" value="'.$cantidadtotal.'"> </td>';
					echo '<td><input type="text" class="form-control" id="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][nombre]" name="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][nombre]" value="'.$filasoldadura['Nombre'].'"> </td>';
					echo '<td><input type="text" class="form-control" id="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][descripcion]" name="2_6_'.$contadorttabla.'_[ensamble][lista_'.$counsoldadura.'][descripcion]"></td>';
					echo '<td><a class="btn btn-warning">Eliminar</a></td>';
					$counsoldadura=$counsoldadura+1;
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

					echo '<br>';
					echo '<table id="3_'.$proceso.'_'.$contadorttabla.'" class="table">';
					echo '<thead>';
					echo '<tr>';
					echo '<input type="hidden" name="3_'.$proceso.'_'.$contadorttabla.'_[tipo]" value="3">';
					echo '<input type="hidden" name="3_'.$proceso.'_'.$contadorttabla.'_[proceso]" value="'.$proceso.'" >';
					echo '<input type="hidden" name="3_'.$proceso.'_'.$contadorttabla.'_[idProducto]" value="'.$idPoducto.'">';
					echo '<td width="20"><input type="text" class="form-control" id="3_'.$proceso.'_'.$contadorttabla.'_[cantidad]" name="3_'.$proceso.'_'.$contadorttabla.'_[cantidad]" value="'.$cantidadProducto.'"></td>';
					echo '<td><input type="text" class="form-control" id="3_'.$proceso.'_'.$contadorttabla.'_[nombre]" name="3_'.$proceso.'_'.$contadorttabla.'_[nombre]" value="'.$filaproducto[0].'"></td>';
					echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(3,'.$proceso.','.$contadorttabla.');">Eliminar tabla</a></td>';
					echo '</tr>';
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
					$countensoldadura=0;
					while ($filasoldadura=mysqli_fetch_array($querysoldadura))
					{
						$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
						echo '<tr id="3_'.$proceso.'_'.$contadorttabla.'">';
						echo '<td><input type="text" class="form-control" name="3_'.$proceso.'_'.$contadorttabla.'_[ensamble][lista'.$countensoldadura.'][cantidad]" value="'.$cantidadtotal.'"></td>';
						echo '<td><input type="text" class="form-control" name="3_'.$proceso.'_'.$contadorttabla.'_[ensamble][lista'.$countensoldadura.'][nombre]" value="'.$filasoldadura['Nombre'].'"></td>';
						echo '<td><input type="text" class="form-control" name="3_'.$proceso.'_'.$contadorttabla.'_[ensamble][lista'.$countensoldadura.'][descripcion]"></td>';
						echo '<td><a class="btn btn-warning">Eliminar</a></td>';
						echo '</tr>';
						$countensoldadura=$countensoldadura+1;
					}
					echo '</tbody>';
					echo '</table>';
					$contadorttabla=$contadorttabla+1;
				}
			}
			//seccion de pintura
			$proceso=8;
				echo '<h3>Pintura</h3>';
				echo '<table id="4_'.$proceso.'_'.$contadorttabla.'" class="table">';
				echo '<thead>';
				echo '<tr class="success">';
				echo '<td>Cantidad</td>';
				echo '<td>Nombre</td>';
				echo '<td>Color</td>';
				echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(4,'.$proceso.','.$contadorttabla.');">Eliminar tabla</a></td>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				echo '<input type="hidden" name="4_'.$proceso.'_'.$contadorttabla.'_[tipo]" value="4">';
				echo '<input type="hidden" name="4_'.$proceso.'_'.$contadorttabla.'_[proceso]" value="'.$proceso.'" >';
				$countpintura=0;
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
						echo '<input type="hidden" name="4_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][idProducto]" value="'.$idProducto.'">';
						echo '<input type="hidden" name="4_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][proceso]" value="'.$proceso.'">';
						echo '<td><input type="text" class="form-control" name="4_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][cantidad]" value="'.$cantidadtotal.'"></td>';
						echo '<td><input type="text" class="form-control" name="4_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][nombre]" value="'.$filasoldadura['Nombre'].'"></td>';
						echo '<td><input type="text" class="form-control" name="4_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][color]" value="'.$filacolor['Color'].'"></td>';
						echo '<td><a class="btn btn-warning">Eliminar</a></td>';
						echo '</tr>';

					}
					$countpintura=$countpintura+1;
					//$contadorttabla=$contadorttabla+1;
				}
				echo '</tbody>';
				echo '</table>';
				$contadorttabla=$contadorttabla+1;

				//seccion de terminado
				$proceso=9;
					echo '<h3>Terminado</h3>';
					echo '<table id="5_'.$proceso.'_'.$contadorttabla.'" class="table">';
					echo '<thead>';
					echo '<tr class="success">';
					echo '<td>Cantidad</td>';
					echo '<td>Nombre</td>';
					echo '<td>Descripcion</td>';
					echo '<td><a class="btn btn-danger" href="javaScript:EliminarTabla(5,'.$proceso.','.$contadorttabla.');">Eliminar tabla</a></td>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					echo '<input type="hidden" name="5_'.$proceso.'_'.$contadorttabla.'_[tipo]" value="5">';
					echo '<input type="hidden" name="5_'.$proceso.'_'.$contadorttabla.'_[proceso]" value="'.$proceso.'" >';
					$countpintura=0;
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
							//$selecionarcolor="SELECT COLOR.Color FROM PEDIDOPRODUCTO INNER JOIN COLOR ON PEDIDOPRODUCTO.COLOR_idCOLOR=COLOR.idCOLOR WHERE PEDIDOPRODUCTO.PEDIDO_idPEDIDO=$idpedido AND PEDIDOPRODUCTO.PRODUCTO_idPRODUCTO=$idPoducto";
							//echo $selecionarcolor;
						//	$querycolor=mysqli_query($conn,$selecionarcolor);
						//	$filacolor=mysqli_fetch_array($querycolor);
							$cantidadtotal=$cantidadProducto*$filasoldadura['Cantidad'];
							echo '<tr>';
							echo '<input type="hidden" name="5_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][idProducto]" value="'.$idProducto.'">';
							echo '<input type="hidden" name="5_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][proceso]" value="'.$proceso.'">';
							echo '<td><input type="text" class="form-control" name="5_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][cantidad]" value="'.$cantidadtotal.'"></td>';
							echo '<td><input type="text" class="form-control" name="5_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][nombre]" value="'.$filasoldadura['Nombre'].'"></td>';
							echo '<td><input type="text" class="form-control" name="5_'.$proceso.'_'.$contadorttabla.'_[lista_'.$countpintura.'][color]" value=""></td>';
							echo '<td><a class="btn btn-warning">Eliminar</a></td>';
							echo '</tr>';

						}
						$countpintura=$countpintura+1;
						//$contadorttabla=$contadorttabla+1;
					}
					echo '</tbody>';
					echo '</table>';
					$contadorttabla=$contadorttabla+1;
		 ?>
		</div>
		<input type="submit"class="btn btn-danger" value="Enviar">
		</form>
	</body>
</html>
<?php
mysqli_close($conn);
 ?>
