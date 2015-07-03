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
$seleccionarpdido="SELECT NumPedido FROM PEDIDO WHERE idPEDIDO=$idpedido";
$queripedido=mysqli_query($conn,$seleccionarpdido);
$filapedido=mysqli_fetch_assoc($queripedido);
$numero=$filapedido['NumPedido'];
$FechaEmicion=$concentrado[0];
$prioridad=$concentrado[1];
$estatus="No Iniciado";
$insertarProduccion="INSERT INTO ORDENPROCESO (FechaEmicion,Prioridad,Estatus,PEDIDO_idPEDIDO) VALUES('$FechaEmicion','$prioridad
	','$estatus','$idpedido')";
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
	$cantidadpePedido=$value[1];
	$selecionarPiezas="SELECT PIEZA_idPIEZA, Cantidad FROM PRODUCTOPIEZA WHERE PRODUCTO_idPRODUCTO=$idproducto";
	echo $selecionarPiezas;
	echo '<br>';
	$querypieza=mysqli_query($conn,$selecionarPiezas);
	while ($filaPieza=mysqli_fetch_array($querypieza)) 
	{
		$idpieza=$filaPieza['PIEZA_idPIEZA'];
		$cantidadpieza=$filaPieza['Cantidad'];
		$selecionarprocesos="SELECT PROCESO_idPROCESO FROM PIEZAPROCESO WHERE PIEZA_idPIEZA=$idpieza";
		echo $selecionarprocesos;
		echo '<br>';
		$queryPiezaProceso=mysqli_query($conn,$selecionarprocesos);
		while ($filaProceso=mysqli_fetch_array($queryPiezaProceso)) 
		{
			$cantidadtotal=$cantidadpieza*$cantidadpePedido;
			$idproceso=$filaProceso['PROCESO_idPROCESO'];

				$insertarMaquinado="INSERT INTO MAQUINADO (idMAQUINADO,ORDENPROCESO_idORDENPROCESO,PIEZA_idPIEZA,Cantidad,Estatus,PROCESO_idPROCESO) VALUES('NULL','$idproduccion','$idpieza','$cantidadtotal','No Iniciado','$idproceso')";
				echo $insertarMaquinado;
				echo '<br>';
				$sqlMaquinado=mysqli_query($conn,$insertarMaquinado);

		}
	}
	
}

mysqli_close($conn);
?>