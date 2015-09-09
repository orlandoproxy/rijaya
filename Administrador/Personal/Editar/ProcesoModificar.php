<?php
include("../../../clases/conexion.php");
$Nombre=$_POST['Nombre'];
$ApellidoPa=$_POST['ApellidoPaterno'];
$ApellidoMaterno=$_POST['ApellidoMaterno'];
$NombreUsu=$_POST['NombreUsuario'];
$Contra=md5($_POST['Contrase']);
$Categoria=$_POST['Categoria'];
$Estatus=$_POST['Estatus'];
session_start();
$id=$_SESSION['id'];
$catego;
switch ($Categoria) {
	case 'Administrador':
	$catego=1;
		break;
	case 'Jefe de Produccion':
		$catego=2;
		break;
	case 'Vendedor':
		$catego=3;
		break;
	case 'Operador':
		$catego=4;
		break;
}
$sqlModificar="UPDATE PERSONAL SET Nombre='$Nombre', ApellidoPaterno='$ApellidoPa', ApellidoMaterno='$ApellidoMaterno', Usuario='$NombreUsu', Contra='$Contra', Estatus='$Estatus',Categoria='$catego' WHERE idPERSONAL='$id'";
$queryModificar=mysqli_query($conn,$sqlModificar);
mysqli_close($conn);
		header("Refresh: 7; URL=../index.php");
		echo '<h3>Exito al Modificar Personal</h3>';
		echo '<br>';

?>
