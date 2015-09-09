<?php
include('../../../clases/conexion.php');
$diaActual = date('Y-j-d');
if (count($_REQUEST)>0)
{
  $id=$_POST['id'];
  $modificarRol="UPDATE ROLES SET Estatus='FINALIZADO',FechaSalida='$diaActual' WHERE idROLES=$id";
  $queryRol=mysqli_query($conn,$modificarRol);
  if (!$queryRol)
  {
    echo 1;
  }
  else {
    echo 2;
  }
}
mysqli_close($conn);
 ?>
