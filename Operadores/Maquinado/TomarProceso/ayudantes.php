<?php
include("../../../clases/conexion.php");
session_start();
$idMaquinado=$_SESSION['idMaquindo'];
$idproceso=$_SESSION['idproceso'];
$seleccionarayudante="SELECT ROLES.idROLES, ROLES.PERSONAL_idPERSONAL, PERSONAL.Nombre,PERSONAL.ApellidoPaterno,PERSONAL.ApellidoMaterno FROM ROLES INNER JOIN PERSONAL ON ROLES.PERSONAL_idPERSONAL=PERSONAL.idPERSONAL WHERE ROLES.Estatus='Activo' AND ROLES.PROCESO_idPROCESO=$idproceso";
echo $seleccionarayudante;
$queryselecionar=mysqli_query($conn,$seleccionarayudante);
//echo $seleccionarayudante;
while ($fila=mysqli_fetch_array($queryselecionar)) 
{
	echo '<option value='.$fila['idROLES'].'>'.$fila['Nombre'].' '.$fila['ApellidoPaterno'].'</option>';
}
mysqli_close($conn);
?>