<?php
$estatus=$_POST['estatus'];
if ($estatus==1)
{
  Agregar();
}
elseif ($estatus==2)
{
  Pausar();
}
elseif ($estatus==3)
{
  Finalizar();
}
//---------------------------funciones---------------------
function Agregar()
{
  include('../../../clases/conexion.php');
  $operador= $_POST['operadores'];
  $listaoperadores=explode(',',$operador);
  $idmaquinado=$_POST['idmaquinado'];
  $fechaactual=$_POST['fecha'];
  //------------querys--------
  $insertatiempo="INSERT INTO TIEMPOSMAQUINADO (Inicio,MAQUINADO_idMAQUINADO) VALUES('$fechaactual','$idmaquinado')";

  $querylista=mysqli_query($conn,$insertatiempo);
  $idlista= mysqli_insert_id($conn);
  //-----insertar operadores-------
  foreach ($listaoperadores as $key => $idoperador)
  {
    $insertaroperador="INSERT INTO OPERADORESMAQUINADO (ROLES_idROLES,MAQUINADO_idMAQUINADO) VALUES('$idoperador','$idmaquinado')";
    echo $insertaroperador;
    $queryoperador=mysqli_query($conn,$insertaroperador);
  }
  mysqli_close($conn);
}

function Pausar()
{
  include('../../../clases/conexion.php');
  $idmaquinado=$_POST['idmaquinado'];
  $fechaactual=$_POST['fecha'];
  //SELECIONAR LISTAS VACIAS
  $selectlistamaquinado="SELECT idTIEMPOSMAQUINADO FROM TIEMPOSMAQUINADO WHERE MAQUINADO_idMAQUINADO=$idmaquinado AND Final IS NULL";
  $queryselect=mysqli_query($conn,$selectlistamaquinado);
  while ($filalista=mysqli_fetch_array($queryselect))
  {
    $idlista=$filalista['idTIEMPOSMAQUINADO'];
    $updatelista="UPDATE TIEMPOSMAQUINADO SET Final='$fechaactual' WHERE idTIEMPOSMAQUINADO=$idlista";
    echo $updatelista;
    $queryupdate=mysqli_query($conn,$updatelista);
  }
  mysqli_close($conn);
}

function Finalizar()
{
  include('../../../clases/conexion.php');
  $idmaquinado=$_POST['idmaquinado'];
  $fechaactual=$_POST['fecha'];
  //SELECIONAR LISTAS VACIAS
  $selectlistamaquinado="SELECT idTIEMPOSMAQUINADO FROM TIEMPOSMAQUINADO WHERE MAQUINADO_idMAQUINADO=$idmaquinado AND Final IS NULL";
  echo $selectlistamaquinado;
  $queryselect=mysqli_query($conn,$selectlistamaquinado);
  while ($filalista=mysqli_fetch_array($queryselect))
  {
    $idlista=$filalista['idTIEMPOSMAQUINADO'];
    $updatelista="UPDATE TIEMPOSMAQUINADO SET Final='$fechaactual' WHERE idTIEMPOSMAQUINADO=$idlista";
    echo $updatelista;
    $queryupdate=mysqli_query($conn,$updatelista);
  }
  //finalizamos la teare
  $finalizarMaquinado="UPDATE MAQUINADO SET Estatus='Finalizado' WHERE idMAQUINADO=$idmaquinado";
  $queryfinal=mysqli_query($conn,$finalizarMaquinado);
  mysqli_close($conn);
}

 ?>
