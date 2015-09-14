<?php
header("Content-Type: text/html;charset=utf-8");
include("../../../clases/conexion.php");
session_start();
$id = $_SESSION["idProdu"];
$consultaPieza="SELECT PIEZA_idPIEZA FROM PRODUCTOPIEZA WHERE PRODUCTO_idPRODUCTO = '$id'";
$queryPieza=mysqli_query($conn,$consultaPieza);

while ($fila=mysqli_fetch_array($queryPieza))
{
	$consultaNombre="SELECT Nombre FROM PIEZA WHERE idPieza=".$fila["PIEZA_idPIEZA"]."";
	$queryNombre=mysqli_query($conn,$consultaNombre);
	$nombre=mysqli_fetch_assoc($queryNombre);
	echo '<option value='.$fila["PIEZA_idPIEZA"].'>'.$nombre["Nombre"];
	echo '</option>';
}
mysqli_close();
?>
