<?php
include('../../../clases/conexion.php');
session_start();
$idordenproceso = $_POST['elegido'];
$proceso = $_SESSION['idproceso'];
$selecmaquinado="SELECT * FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=$proceso AND  Estatus='Iniciado'";
//echo $selecmaquinado;
$querymaquinado=mysqli_query($conn,$selecmaquinado);
echo '<div class="row">';
  echo '<div class="col-md-4">';
  while ($filamaquinado=mysqli_fetch_array($querymaquinado))
  {
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr><td>Cantidad</td><td>Nombre</td><td>Estatus</td><td></td></tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>'.$filamaquinado['Nombre'].'</td>';
    echo '<td>'.$filamaquinado['Estatus'].'</td>';
    echo '<td><a class="btn btn-primary" href="javascript:Maquinado('.$filamaquinado['idMAQUINADO'].');">Visualizar</a></td>';

    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
  }

  echo '</div>';
  echo '<div class="col-md-8" id="tiempos">';
  echo '</div>';
echo '</div>';
mysqli_close($conn);
 ?>
