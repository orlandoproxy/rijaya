<?php
$texto=$_POST['q'];
$cadena=explode(",", $texto);
$clave=$cadena[0];
$tipo=$cadena[1];
include("../../../clases/conexion.php");
$consultaProducto="SELECT idPRODUCTO,Nombre, Descripcion FROM PRODUCTO WHERE  Clave LIKE '%$clave%' AND Tipo='$tipo' LIMIT 10 ";
$queryConsulta=mysqli_query($conn,$consultaProducto);
echo '<option>... </option>';
while ($fila=mysqli_fetch_array($queryConsulta)) 
{
	echo '<option value='.$fila['idPRODUCTO'].'>'.$fila['Nombre'].'-'.$fila['Descripcion'].'<option>';
}
mysqli_close($conn);
?>