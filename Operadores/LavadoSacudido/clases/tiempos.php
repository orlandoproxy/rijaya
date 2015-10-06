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
  $insertatiempo="INSERT INTO TIEMPOENSAMBLES (Inicio,ENSAMBLES_idENSAMBLES) VALUES('$fechaactual','$idmaquinado')";

  $querylista=mysqli_query($conn,$insertatiempo);
  $idlista= mysqli_insert_id($conn);
  //-----insertar operadores-------
  foreach ($listaoperadores as $key => $idoperador)
  {
    $insertaroperador="INSERT INTO OPERADORESMAQUINADO (ROLES_idROLES,ENSAMBLES_idENSAMBLES) VALUES('$idoperador','$idmaquinado')";
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
  $selectlistamaquinado="SELECT idTIEMPOENSAMBLES FROM TIEMPOENSAMBLES WHERE ENSAMBLES_idENSAMBLES=$idmaquinado AND Final IS NULL";
  $queryselect=mysqli_query($conn,$selectlistamaquinado);
  while ($filalista=mysqli_fetch_array($queryselect))
  {
    $idlista=$filalista['idTIEMPOENSAMBLES'];
    $updatelista="UPDATE TIEMPOENSAMBLES SET Final='$fechaactual' WHERE idTIEMPOENSAMBLES=$idlista";
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
  $selectlistamaquinado="SELECT idTIEMPOENSAMBLES FROM TIEMPOENSAMBLES WHERE ENSAMBLES_idENSAMBLES=$idmaquinado AND Final IS NULL";
  echo $selectlistamaquinado;
  $queryselect=mysqli_query($conn,$selectlistamaquinado);
  while ($filalista=mysqli_fetch_array($queryselect))
  {
    $idlista=$filalista['idTIEMPOENSAMBLES'];
    $updatelista="UPDATE TIEMPOENSAMBLES SET Final='$fechaactual' WHERE idTIEMPOENSAMBLES=$idlista";
    echo $updatelista;
    $queryupdate=mysqli_query($conn,$updatelista);
  }
  //finalizamos la teare
  $finalizarMaquinado="UPDATE ENSAMBLES SET Estatus='Finalizado' WHERE idENSAMBLES=$idmaquinado";
  $queryfinal=mysqli_query($conn,$finalizarMaquinado);
  mysqli_close($conn);
}

 ?>
