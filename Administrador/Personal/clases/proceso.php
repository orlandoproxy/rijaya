<?php
include('../../../clases/conexion.php');
$Tipo=$_POST['elegido'];
echo $Tipo;
mysqli_close($conn);

 ?>
