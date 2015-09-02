<?php
$respuesta=$_POST['catego'];
if ($respuesta==1)
{
  $clave=$_POST['id'];
  Activar($clave);
}
elseif($respuesta==2)
{
  $clave=$_POST['id'];
  Desactivar($clave);
}
elseif ($respuesta==3)
{
  $clave=$_POST['id'];
  Suspender($clave);
}
elseif ($respuesta==4)
{
  print_r($_REQUEST);
  $nombre=$_POST['nombre'];
  $clave = $_POST['clave'];
  echo $nombre;
  echo $clave;
  Guardar($nombre,$clave);
}
//funcioones
function Agregar()
{

}
function Activar($valor)
{
  include('../../../clases/conexion.php');
  $id=$valor;
  $activarTerminal="UPDATE TERMINAL SET Estatus=1, Estado='ACTIVO' WHERE idTERMINAL=$id";
  echo $activarTerminal;
  $queryActivar=mysqli_query($conn,$activarTerminal);
  mysqli_close($conn);
}
function Desactivar($valor)
{
  include('../../../clases/conexion.php');
  $id=$valor;
  $desactivarTerminal="UPDATE TERMINAL SET Estatus=1, Estado='INACTIVO' WHERE idTERMINAL=$id";
  echo $desactivarTerminal;
  $queryActivar=mysqli_query($conn,$desactivarTerminal);
  mysqli_close($conn);
}
function Suspender($valor)
{
  include('../../../clases/conexion.php');
  $id=$valor;
  $suspenderTerminal="UPDATE TERMINAL SET Estatus=0, Estado='SUSPENDIDO' WHERE idTERMINAL=$id";
  echo $suspenderTerminal;
  $queryActivar=mysqli_query($conn,$suspenderTerminal);
  mysqli_close($conn);
}
function Guardar($nombre,$clave)
{
  $Nombre=$nombre;
  $Clave=$clave;
  include('../../../clases/conexion.php');
  $insertarTerminal="INSERT INTO TERMINAL (ClaveTerminal,NombreTerminal,Estado,Estatus) VALUES ('$Clave','$Nombre','INACTIVO','1')";
  $queryInsertr=mysqli_query($conn,$insertarTerminal);
  mysqli_close($conn);
}
?>
