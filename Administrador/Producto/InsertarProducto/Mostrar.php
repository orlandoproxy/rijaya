<?php 
include('../../../clases/conexion.php');
session_start();
$IDPRODU= $_SESSION['idProdu'];
$cadena= [];
$cont=0;
$valor=count($_REQUEST);
echo $IDPRODU;
echo '<br/>';
if (is_array($_REQUEST)==true)
{
	foreach ($_REQUEST as $cadena[$cont] => $value) 
	{
		$cadena[$cont] = $value;
		$cont=$cont+1;
	}
	while (count($cadena)>1) 
	{
			$cantidad = $cadena[0];
	$nombre = $cadena[1];
	$medida1 = $cadena[2];
	$medida2 = $cadena[3];
	$medida3 = $cadena[4];
	$listapro = $cadena[5];
	$material = $cadena[6];
	//seleccionar material
	$selecMaterial= "SELECT idMaterial FROM MATERIAL WHERE Clave LIKE'%".$material."%'";
	//insertar pieza
	$ResMaterial = mysqli_query($conn,$selecMaterial);
	if (mysqli_num_rows($ResMaterial)>0) 
	{
		$ListaMaterial = mysqli_fetch_array($ResMaterial);
		$idMaterial = $ListaMaterial['idMaterial'];
		
	}
	$selecPieza = "SELECT * FROM PIEZA WHERE Nombre='$nombre' && MATERIAL_idMATERIAL='$idMaterial' && Medida1='$medida1' && Medida2='$medida2' && Medida3='$medida3' ";
	$ResPieza = mysqli_query($conn,$selecPieza);
		$insertarpieza=mysqli_query($conn,"INSERT INTO PIEZA (Nombre,MATERIAL_idMATERIAL,Medida1,Medida2,Medida3) VALUES ('$nombre','$idMaterial','$medida1','$medida2','$medida3')");
		$ResPieza = mysqli_query($conn,$selecPieza);
		$idpieza= mysqli_fetch_array($ResPieza);
		$pieza= $idpieza['idPIEZA'];
		//insertar pieza producto
		$querypiezaprodu= mysqli_query($conn,"INSERT INTO PRODUCTOPIEZA (PRODUCTO_idPRODUCTO,PIEZA_idPIEZA,Cantidad) VALUES ('$IDPRODU','$pieza','$cantidad')");
		echo "INSERT INTO PRODUCTOPIEZA (PRODUCTO_idPRODUCTO,PIEZA_idPIEZA,Cantidad) VALUES ('$IDPRODU','$pieza')";
		for ($j=0; $j < count($listapro) ; $j++) 
		{ 			
			$querypro= mysqli_query($conn,"SELECT idPROCESO FROM PROCESO WHERE NOMBRE = '$listapro[$j]'");
			$listaid=mysqli_fetch_array($querypro);
			$idproinser= $listaid['idPROCESO'];
			$querypiepro= mysqli_query($conn,"INSERT INTO PIEZAPROCESO (PIEZA_idPIEZA,PROCESO_idPROCESO) VALUES ('$pieza','$idproinser')");

		}
		unset($cadena[0]);
		unset($cadena[1]);
		unset($cadena[2]);
		unset($cadena[3]);
		unset($cadena[4]);
		unset($cadena[5]);
		unset($cadena[6]);
		$cadena= array_values($cadena);


	
	}
	
	
	header('Location:Ensamble.php');
}

?>





