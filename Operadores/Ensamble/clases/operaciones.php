<?php
include('../../../clases/conexion.php');
session_start();
$proceso=$_SESSION['idproceso'];
//print_r($_REQUEST);
$idmaquinado=$_POST['id'];
$selecionarlistamaquinado="SELECT * FROM ENSAMBLESSUBENSAMBLE WHERE idENSAMBLESSUBENSAMBLE=$idmaquinado";
echo $selecionarlistamaquinado;
$querylista=mysqli_query($conn,$selecionarlistamaquinado);

echo '<div class="row">';
      echo '<div class="col-md-12">';
      //-------------------------------------seleciuonamos los tiempos--------------
     $selecionartareas="SELECT * FROM TIEMPOENSAMBLES WHERE ENSAMBLES_idENSAMBLES=$idmaquinado AND Final IS NULL";

     $querytareas=mysqli_query($conn,$selecionartareas);
     $estatustareas=mysqli_num_rows($querytareas);
     if ($estatustareas>0)
     {
      //existen tareas activas
      echo '<a id="Inicio" class="btn btn-primary" disabled>Iniciar</a>';
      echo '<a id="Pausa" class="btn btn-warning" href="javascript:Pausa('.$idmaquinado.');">Pausa</a>';
      echo '<a id="Finalizar" class="btn btn-danger" href="javascript:Finalizar('.$idmaquinado.');">Finalizar</a>';
     }
     else {
       //no hay actividades o listas iniciadas
       echo '<a id="Inicio" class="btn btn-primary" href="javascript:Tiempos('.$idmaquinado.',1);">Iniciar</a>';
       echo '<a id="Pausa" class="btn btn-warning" disabled>Pausa</a>';
       echo '<a id="Finalizar" class="btn btn-danger" disabled>Finalizar</a>';
     }

     ///------------------------fin los tiempos
      //-------
        $selecionarRol="SELECT ROLES.idROLES, PERSONAL.Nombre, PERSONAL.ApellidoPaterno, PERSONAL.ApellidoMaterno FROM ROLES INNER JOIN PERSONAL ON ROLES.PERSONAL_idPERSONAL=PERSONAL.idPERSONAL WHERE ROLES.PROCESO_idPROCESO=$proceso AND ROLES.Estatus='Activo'";
        $queryroles=mysqli_query($conn,$selecionarRol);
        echo '<hr>';
      echo '<label for="">Seleccione a un Operador</label>';
      echo '<br>';
      echo '<form id="form">';
      echo '<label>Nombre: </label>';
      $cont=0;
        while ($filaproceso=mysqli_fetch_array($queryroles))
        {
          echo '<input type="checkbox" name="rol[]" value="'.$filaproceso['idROLES'].'">';
          echo $filaproceso['Nombre'].' '.$filaproceso['ApellidoPaterno'].', ';
          $cont=$cont+1;
        }
        echo '</form>';
      echo '<table class="table">';
      echo '<thead>';
      echo '<tr>';
      echo '<td>Cantidad</td>';
      echo '<td>Nombre</td>';
      echo '<td>Descripcion</td>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($filalista=mysqli_fetch_array($querylista))
      {

        echo '<tr>';
        echo '<td>'.$filalista['Cantidad'].'</td>';
        echo '<td>'.$filalista['NombrePiezas'].'</td>';
        echo '<td>'.$filalista['Descripcion'].'</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';


      echo '</div>';
echo '</div>';
mysqli_close($conn);
 ?>
