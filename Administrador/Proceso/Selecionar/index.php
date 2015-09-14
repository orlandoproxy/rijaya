<?php
include('../../../clases/conexion.php');

$idordenproceso=$_GET["id"];
 ?>
 <html lang="esp">
 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="../../../css/bootstrap.css" media="screen" title="no title" charset="utf-8">
 <title>proceso</title>
 </head>
 <body>
   <h1>Maquinado</h1>
   <h2>Corte</h2>
   <table class="table">
     <tbody>
      <tr>
        <td>Nombre</td>
        <td>Estatus</td>
        <td></td>
      </tr>
     </tbody>
   <?php

   $selecionarCorte="SELECT * FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=1";
   $querycorte=mysqli_query($conn,$selecionarCorte);
   while ($filaCorte=mysqli_fetch_array($querycorte))
   {
     echo '<tr>';
     echo '<td>'.$filaCorte["Nombre"].'</td>';
     echo '<td>'.$filaCorte["Estatus"].'</td>';
     echo '</tr>';

   }
   ?>
   </table>

   <h2>Troquelado</h2>
   <table class="table">
     <tbody>
      <tr>
        <td>Nombre</td>
        <td>Estatus</td>
        <td></td>
      </tr>
     </tbody>
   <?php

   $selecionartroquel="SELECT * FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=2";
   $querytroquel=mysqli_query($conn,$selecionartroquel);
   while ($filatroquel=mysqli_fetch_array($querytroquel))
   {
     echo '<tr>';
     echo '<td>'.$filatroquel["Nombre"].'</td>';
     echo '<td>'.$filatroquel["Estatus"].'</td>';
     echo '</tr>';

   }
   ?>
   </table>

   <h2>Gramilado</h2>
   <table class="table">
     <tbody>
      <tr>
        <td>Nombre</td>
        <td>Estatus</td>
        <td></td>
      </tr>
     </tbody>
   <?php

   $selecionarCorte="SELECT * FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=3";
   $querycorte=mysqli_query($conn,$selecionarCorte);
   while ($filaCorte=mysqli_fetch_array($querycorte))
   {
     echo '<tr>';
     echo '<td>'.$filaCorte["Nombre"].'</td>';
     echo '<td>'.$filaCorte["Estatus"].'</td>';
     echo '</tr>';

   }
   ?>
   </table>

   <h2>Doblado</h2>
   <table class="table">
     <tbody>
      <tr>
        <td>Nombre</td>
        <td>Estatus</td>
        <td></td>
      </tr>
     </tbody>
   <?php

   $selecionarCorte="SELECT * FROM MAQUINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=4";
   $querycorte=mysqli_query($conn,$selecionarCorte);
   while ($filaCorte=mysqli_fetch_array($querycorte))
   {
     echo '<tr>';
     echo '<td>'.$filaCorte["Nombre"].'</td>';
     echo '<td>'.$filaCorte["Estatus"].'</td>';
     echo '</tr>';

   }
   ?>
   </table>

   <h1>Ensambles</h1>
   <h2>Punteado</h2>
   <table class="table">
     <head>
       <tr>
         <td>Nombre</td>
         <td>Estatus</td>
       </tr>
     </head>
     <tbody>
       <?php
       $selecensamble="SELECT * FROM ENSAMBLES WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=5";
       $queryensamble=mysqli_query($conn,$selecensamble);
       while ($filaensamble=mysqli_fetch_array($queryensamble))
       {
         echo '<tr>';
         echo '<td>'.$filaensamble["nombre"].'</td>';
         echo '<td>'.$filaensamble["Estatus"].'</td>';
         echo '</tr>';
       }
         ?>
     </tbody>
   </table>

   <h2>Soldadura</h2>
   <table class="table">
     <head>
       <tr>
         <td>Nombre</td>
         <td>Estatus</td>
       </tr>
     </head>
     <tbody>
       <?php
       $selecensamble="SELECT * FROM ENSAMBLES WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=6";
       $queryensamble=mysqli_query($conn,$selecensamble);
       while ($filaensamble=mysqli_fetch_array($queryensamble))
       {
         echo '<tr>';
         echo '<td>'.$filaensamble["Nombre"].'</td>';
         echo '<td>'.$filaensamble["Estatus"].'</td>';
         echo '</tr>';
       }
         ?>
     </tbody>
   </table>

   <h1>Lavados y sacudido</h1>
   <h2>Lavado</h2>
   <?php
   $selectcionarLavado="SELECT * FROM LAVADOSACUDIDO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=7";
   $queryLavado=mysqli_query($conn,$selectcionarLavado);
   while ($filalavado=mysqli_fetch_array($queryLavado))
   {
     $estatus=$filalavado["Estatus"];
     echo '<table class="table">';
     echo '<thead>';
     echo '<tr><td>Nombre</td><td>Estatus</td></tr>';
     echo '</thead>';
     echo '<tbody>';
     $idlista=$filalavado["idLAVADOSACUDIDO"];
     $selecionarlista="SELECT * FROM LISTALAVADOSACUDIDO WHERE LAVADOSACUDIDO_idLAVADOSACUDIDO=$idlista";
     $querylista=mysqli_query($conn,$selecionarlista);
     while ($filalista=mysqli_fetch_array($querylista))
     {
       echo '<tr>';
       echo '<td>'.$filalista["NombreSacudidoLavado"].'</td>';
       echo '<td>'.$estatus.'</td>';
       echo '</tr>';
     }
     echo '</tbody>';
     echo '</table>';
   }
    ?>

    <h2>Sacudido</h2>
    <?php
    $selectcionarLavado="SELECT * FROM LAVADOSACUDIDO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso AND PROCESO_idPROCESO=10";
    $queryLavado=mysqli_query($conn,$selectcionarLavado);
    while ($filalavado=mysqli_fetch_array($queryLavado))
    {
      $estatus=$filalavado["Estatus"];
      echo '<table class="table">';
      echo '<thead>';
      echo '<tr><td>Nombre</td><td>Estatus</td></tr>';
      echo '</thead>';
      echo '<tbody>';
      $idlista=$filalavado["idLAVADOSACUDIDO"];
      $selecionarlista="SELECT * FROM LISTALAVADOSACUDIDO WHERE LAVADOSACUDIDO_idLAVADOSACUDIDO=$idlista";
      $querylista=mysqli_query($conn,$selecionarlista);
      while ($filalista=mysqli_fetch_array($querylista))
      {
        echo '<tr>';
        echo '<td>'.$filalista["NombreSacudidoLavado"].'</td>';
        echo '<td>'.$estatus.'</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
     ?>

  <h1>Pintura</h1>
  <?php
  $selecionarpintura="SELECT * FROM PINTURA WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso";
  $querypintura=mysqli_query($conn,$selecionarpintura);
  while ($filapintura=mysqli_fetch_array($querypintura))
  {
    $idpintura=$filapintura["idPintura"];

  echo '<table class="table">';
  echo '<thead>';
  echo '<tr>';
  echo '<td>Nombre</td><td>Estatus</td>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  $selecionlistapintura="SELECT * FROM LISTAPINTURA WHERE PINTURA_idPintura=$idpintura";
  $querylistapintura=mysqli_query($conn,$selecionlistapintura);
  while ($filalistapintura=mysqli_fetch_array($querylistapintura))
  {
    echo '<tr>';
    echo '<td>'.$filalistapintura["NombreProducto"].'</td>';
    echo '<td>'.$filapintura["Estatus"].'</td>';
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  }
   ?>

   <h1>Terminado</h1>
  <?php
  $selecionarTerminado="SELECT * FROM TERMINADO WHERE ORDENPROCESO_idORDENPROCESO=$idordenproceso";
  $queryTerminado=mysqli_query($conn,$selecionarTerminado);
  while ($filaterminado=mysqli_fetch_array($queryTerminado))
  {
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<td>Nombre</td><td>Estatus</td>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $idterminado=$filaterminado["idTERMINADO"];
    $selecionarlistaterminado="SELECT * FROM LISTATERMINADO WHERE TERMINADO_idTERMINADO=$idterminado";
    $querylistaterminado=mysqli_query($conn,$selecionarlistaterminado);
    while ($listafilaterminado=mysqli_fetch_array($querylistaterminado))
    {
      echo '<tr>';
      echo '<td>'.$listafilaterminado["Nombre"].'</td>';
      echo '<td>'.$filaterminado["Estatus"].'</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
  }
   ?>
 </br>
 <a class="btn btn-primary" href="../">Continuar</a>
 </body>
 </html>
 <?php
  mysqli_close($conn);
  ?>
