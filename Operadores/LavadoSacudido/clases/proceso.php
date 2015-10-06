<?php
include('../../../clases/conexion.php');
session_start();
$idordenproceso = $_POST['elegido'];
$proceso = $_SESSION['idproceso'];
$selecmaquinado="SELECT LAVADOSACUDIDO.idLAVADOSACUDIDO, LAVADOSACUDIDO.Estatus, LISTALAVADOSACUDIDO.NombreSacudidoLavado, LISTALAVADOSACUDIDO.Cantidad FROM LAVADOSACUDIDO INNER JOIN LISTALAVADOSACUDIDO ON LAVADOSACUDIDO.idLAVADOSACUDIDO=LISTALAVADOSACUDIDO.idLISTALAVADOSACUDIDO WHERE LAVADOSACUDIDO.ORDENPROCESO_idORDENPROCESO=$idordenproceso AND LAVADOSACUDIDO.PROCESO_idPROCESO=$proceso AND  LAVADOSACUDIDO.Estatus='Iniciado'";
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
    echo '<td>'.$filamaquinado['Cantidad'].'</td>';
    echo '<td>'.$filamaquinado['NombreSacudidoLavado'].'</td>';
    echo '<td>'.$filamaquinado['Estatus'].'</td>';
    echo '<td><a class="btn btn-primary" href="javascript:Ensamble('.$filamaquinado['idLAVADOSACUDIDO'].');">Visualizar</a></td>';

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
