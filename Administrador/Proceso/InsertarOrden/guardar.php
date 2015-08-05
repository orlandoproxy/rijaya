<?php
include("../../../clases/conexion.php");
session_start();
if (isset($_SESSION['idpedido']))
{

}
$idpedido=$_SESSION['idpedido'];
$concentrado=array();
$cont=0;
foreach ($_REQUEST as $key => $value)
{
	$concentrado[$cont]=$value;
	$cont=$cont+1;
}
print_r($concentrado);
echo '<br>';
$seleccionarpdido="SELECT NumPedido FROM PEDIDO WHERE idPEDIDO=$idpedido";
echo "Seleccion Pedido";
echo '<br>';
echo $seleccionarpdido;
echo '<br>';
$queripedido=mysqli_query($conn,$seleccionarpdido);
$filapedido=mysqli_fetch_assoc($queripedido);
$numero=$filapedido['NumPedido'];
$FechaEmicion=$concentrado[0];
$prioridad=$concentrado[1];
$estatus="No Iniciado";
$insertarProduccion="INSERT INTO ORDENPROCESO (FechaEmicion,Prioridad,Estatus,PEDIDO_idPEDIDO) VALUES('$FechaEmicion','$prioridad','$estatus','$idpedido')";

$queryinsertar=mysqli_query($conn,$insertarProduccion);
$idproduccion=mysqli_insert_id($conn);
$clave=$numero."-".$idproduccion;
$actualizarProduccion="UPDATE ORDENPROCESO SET Clave='$clave' WHERE idORDENPROCESO=$idproduccion";
$queryactualizar=mysqli_query($conn,$actualizarProduccion);
//comensamos con losproductos
unset($concentrado[0]);
unset($concentrado[1]);
$concentrado=array_values($concentrado);
foreach ($concentrado as $key => $value)
{
	print_r($value);
	echo '<br>';
	$idproducto=$value[0];
	$cantidaadProducto=$value[1];
	$selecionarPiezas="SELECT PIEZA_idPIEZA, Cantidad FROM PRODUCTOPIEZA WHERE PRODUCTO_idPRODUCTO=$idproducto";
	echo $selecionarPiezas;
	echo "selecion de piezas";
	echo '<br>';
	$querypieza=mysqli_query($conn,$selecionarPiezas);
	while ($filaPieza=mysqli_fetch_array($querypieza))
	{
		$idpieza=$filaPieza['PIEZA_idPIEZA'];
		$cantidadpieza=$filaPieza['Cantidad'];
			echo '<br>';
		$selecionarprocesos="SELECT PROCESO_idPROCESO FROM PIEZAPROCESO WHERE PIEZA_idPIEZA=$idpieza";
			echo $selecionarprocesos;
				echo '<br>';
		$queryPiezaProceso=mysqli_query($conn,$selecionarprocesos);
		while ($filaProceso=mysqli_fetch_array($queryPiezaProceso))
		{
			$cantidadtotal=$cantidadpieza*$cantidaadProducto;
			$idproceso=$filaProceso['PROCESO_idPROCESO'];
	echo '<br>';
				$insertarMaquinado="INSERT INTO MAQUINADO (idMAQUINADO,ORDENPROCESO_idORDENPROCESO,PIEZA_idPIEZA,Cantidad,Estatus,PROCESO_idPROCESO) VALUES('NULL','$idproduccion','$idpieza','$cantidadtotal','No Iniciado','$idproceso')";
echo $insertarMaquinado;
	echo '<br>';
				$sqlMaquinado=mysqli_query($conn,$insertarMaquinado);

		}
	}
	//ensambles
	//Seleccionar ensambles de productos
		echo '<br>';
	$selecionarSubensambles="SELECT idENSAMBLE FROM ENSAMBLE WHERE PRODUCTO_idPRODUCTO=$idproducto";
	echo $selecionarSubensambles;
		echo '<br>';
	$querySubensamble=mysqli_query($conn,$selecionarSubensambles);
	//Selecionamos los subensambles
	while ($resilSubensamble=mysqli_fetch_array($querySubensamble))
	{

			echo '<br>';
		$idsubensmble=$resilSubensamble['idENSAMBLE'];
		$SelecionarprocesosEnsambles="SELECT SUBENSAMBLE.Cantidad,SUBENSAMBLEPROCESO.PROCESO_idPROCESO FROM SUBENSAMBLE INNER JOIN SUBENSAMBLEPROCESO ON SUBENSAMBLE.idSubensamble=SUBENSAMBLEPROCESO.SUBENSAMBLE_idSubensamble WHERE SUBENSAMBLE.idSubensamble=$idsubensmble";
		$queryProcesosEnsamble=mysqli_query($conn,$SelecionarprocesosEnsambles);
		echo $SelecionarprocesosEnsambles;
			echo '<br>';
		while ($filaen=mysqli_fetch_array($queryProcesosEnsamble))
		{
				echo '<br>';
			$cantidadEnsamble=$filaen['Cantidad'];
			$idpro=$filaen['PROCESO_idPROCESO'];
			$total=$cantidadEnsamble*$cantidaadProducto;
			if ($idpro==5 || $idpro==6 || $idpro==7)
			{
					echo '<br>';
				$InsertarEnsamble="INSERT INTO ENSAMBLES(Cantidad,Estatus,ORDENPROCESO_idORDENPROCESO,PROCESO_idPROCESO,SUBENSAMBLE_idSubensamble) VALUES('$total','No Iniciado','$idproduccion','$idpro','$idsubensmble')";
				$queryagregarensamble=mysqli_query($conn,$InsertarEnsamble);
				echo $InsertarEnsamble;
					echo '<br>';
			}
			elseif ($idpro==8)
			{
					echo '<br>';
				$SelecionarPintura="SELECT COLOR.Color FROM ORDENPROCESO INNER JOIN PEDIDOPRODUCTO ON ORDENPROCESO.PEDIDO_idPEDIDO=PEDIDOPRODUCTO.PEDIDO_idPEDIDO INNER JOIN COLOR ON PEDIDOPRODUCTO.COLOR_idCOLOR=COLOR.idCOLOR WHERE PEDIDOPRODUCTO.PEDIDO_idPEDIDO=$idpedido AND PEDIDOPRODUCTO.PRODUCTO_idPRODUCTO=$idproducto";
				echo $SelecionarPintura;
				$querypintura=mysqli_query($conn,$SelecionarPintura);
				$Colorpitura=mysqli_fetch_assoc($querypintura);
				$color=$Colorpitura['Color'];
				echo '<br>';

				$insertrPintura="INSERT INTO PINTURA(ORDENPROCESO_idORDENPROCESO,Cantidad,Estatus,SUBENSAMBLE_idSubensamble,Color) VALUES('$idpro','$total','No Iniciado','$idsubensmble','$color')";
			echo $insertrPintura;
				$queryAgregarpintura=mysqli_query($conn,$insertrPintura);
			}
			elseif ($idpro==9)
			{
					echo '<br>';
				$Insertarteerminado="INSERT INTO TERMINADO(ORDENPROCESO_idORDENPROCESO,Estatus,Canridad,PROCESO_idPROCESO) VALUES('$idproduccion','No Iniciado','$total',''$idpro')";
				$queryTerminado=mysqli_query($conn,$Insertarteerminado);
				echo $Insertarteerminado;
					echo '<br>';
			}
		}
	}

}



mysqli_close($conn);
//header('Location: ../');
?>
