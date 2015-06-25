<?php
include("../../../clases/conexion.php");
$selecionarColores="SELECT idCOLOR, Color FROM COLOR";
$querycolor=mysqli_query($conn,$selecionarColores);
while ($filacolor=mysqli_fetch_array($querycolor)) 
{
	echo '<option value='.$filacolor['idCOLOR'].'>'.$filacolor['Color'].'</option>';
}
mysqli_close($conn);
?>