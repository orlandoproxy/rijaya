<?php
include("../../../clases/conexion.php");
print_r($_REQUEST);
echo '<hr>';
session_start();
$idproceso=$_SESSION['idpro'];
echo $idproceso;
foreach ($_REQUEST as $key => $value)
{
  if ($value["tipo"]==1)
  {
    //maquinado
    $proceso=$value["proceso"];
    $idproducto=$value["idProducto"];
    $cantidad=$value["cantidad"];
    $nombre=$value["nombre"];
    if (isset($value['piezas']))
    {
      $piezas=$value["piezas"];
      //print_r($piezas);
      $tamaPiezas=count($piezas);
    }
    else
    {
      $tamaPiezas=0;
    }
    //echo $tamaPiezas;
    if ($tamaPiezas>0)
    {
      //comprobmos que no esta vacio
      $insertarmaquiado="INSERT INTO MAQUINADO (ORDENPROCESO_idORDENPROCESO,Nombre,Estatus,PROCESO_idPROCESO,PRODUCTO_idPRODUCTO) VALUES('$idproceso','$nombre','Iniciado','$proceso','$idproducto')";
      $querymaquinado=mysqli_query($conn,$insertarmaquiado);
      $idmaquinado=mysqli_insert_id($conn);
      echo $insertarmaquiado;
      echo '</br>';
      echo '</br>';
      foreach ($piezas as $key => $valor)
      {
        $cantidadPieza=$valor["cantidadpieza"];
        $nombrePieza=$valor["nombrepieza"];
        $medidas=$valor["medidas"];
        $material=$valor["material"];
        $lisamaquinado="INSERT INTO MAQUINADOPIEZA (MAQUINADO_idMAQUINADO,PROCESO_idPROCESO,Cantidad,Nombre,Medidas,Material) VALUES('$idmaquinado','$proceso','$cantidadPieza','$nombrePieza','$medidas','$material')";
        echo $lisamaquinado;
        echo '</br>';
        $querylistama=mysqli_query($conn,$lisamaquinado);

      }
    }
    else
    {
      //esta vacio
    }
    echo '<hr>';
  }
  elseif ($value["tipo"]==2)
  {
    //ensambles
    $proceso=$value["proceso"];
    $idproducto=$value["idProducto"];
    $cantidad=$value["cantidad"];
    $nombre=$value["nombre"];
    if (isset($value['ensamble']))
    {
      $ensamble=$value["ensamble"];
      //print_r($piezas);
      $tamaensamble=count($ensamble);
    }
    else
    {
      $tamaensamble=0;
    }
    if ($tamaensamble>0)
    {
      # code...
      $insertarensamble="INSERT INTO ENSAMBLES (ORDENPROCESO_idORDENPROCESO,Estatus,PROCESO_idPROCESO,PRODUCTO_idPRODUCTO,Nombre,Cantidad) VALUES('$idproceso','Iniciado','$proceso','$idproducto','$nombre','$cantidad')";
      $queryensamble=mysqli_query($conn,$insertarensamble);
      $idensamble=mysqli_insert_id($conn);
      echo $insertarensamble;
      echo '</br>';
      echo '</br>';
      foreach ($ensamble as $pos => $valor)
      {
        $nombre=$valor["nombre"];
        $descripcion=$valor["descripcion"];
        $cantidadpie= $valor["cantidad"];
        $insertarsubensamble="INSERT INTO ENSAMBLESSUBENSAMBLE (ENSAMBLES_idENSAMBLES,NombrePiezas,Cantidad,Descripcion) VALUES('$idensamble','$nombre','$cantidadpie','$descripcion')";
        $querylistaensamble=mysqli_query($conn,$insertarsubensamble);
        echo $insertarsubensamble;
        echo '</br>';
      }
    }
    else
    {
      //esta vacio
    }
    echo '<hr>';
  }
  elseif ($value["tipo"]==3)
  {
    $proceso=$value["proceso"];
    $idproducto=$value["idProducto"];
    $cantidad=$value["cantidad"];
    $nombre=$value["nombre"];
    if (isset($value["ensamble"]))
    {
      $ensamble=$value["ensamble"];
      $tamaensamble=count($ensamble);
    }
    else
    {
      $tamaensamble=0;
    }
    if ($ensamble>0)
    {
      $insertarlavadosacudido="INSERT INTO LAVADOSACUDIDO (ORDENPROCESO_idORDENPROCESO,Estatus,PROCESO_idPROCESO,PRODUCTO_idPRODUCTO) VALUES('$idproceso','Iniciado','$proceso','$idproducto')";
      $queryladosacuidido=mysqli_query($conn,$insertarlavadosacudido);
      $idlavadosacudido=mysqli_insert_id($conn);
      echo $insertarlavadosacudido;
      echo '</br>';
      echo '</br>';
      foreach ($ensamble as $pos => $valor)
      {
        $cantidadlava=$valor["cantidad"];
        $nombrelava=$valor["nombre"];
        $descripcionlava=$valor["descripcion"];
        $insertarlistalava="INSERT INTO LISTALAVADOSACUDIDO (NombreSacudidoLavado,Cantidad,Descripcion,LAVADOSACUDIDO_idLAVADOSACUDIDO) VALUES('$nombrelava','$cantidadlava','$descripcionlava','$idlavadosacudido')";
        $querylaado=mysqli_query($conn,$insertarlistalava);
        echo $insertarlistalava;
        echo '</br>';
      }
    }
    echo '<hr>';
  }
  elseif ($value["tipo"]==4)
  {
    $proceso=$value["proceso"];
    $insertalpitura="INSERT INTO PINTURA (ORDENPROCESO_idORDENPROCESO,Estatus,PROCESO_idPROCESO) VALUES('$idproceso','Iniciado','8')";
    $querypintura=mysqli_query($conn,$insertalpitura);
    $idpintura=mysqli_insert_id($conn);
    echo $insertalpitura;
    echo '</br>';
    echo '</br>';
    //detectar lista de pintura
    foreach ($value as $pos => $lista)
    {
      if (count($lista)>2)
      {
        //pertenece a listade pintura
        echo '<hr>';
        print_r($lista);
        echo '<hr>';
          $idproducto=$lista["idProducto"];
          $cantidapintura=$lista["cantidad"];
          $nombrepintura=$lista["nombre"];
          $colorpintura=$lista["color"];
          $insertarlistapintura="INSERT INTO LISTAPINTURA (PINTURA_idPintura,NombreProducto,Cantidad,Color,PRODUCTO_idPRODUCTO) VALUES('$idpintura','$nombrepintura','$cantidapintura','$colorpintura','$idproducto')";
          $querylistapin=mysqli_query($conn,$insertarlistapintura);
          echo $insertarlistapintura;
          echo '</br>';

      }
      else
      {
        //nada , no es lista de pintura
      }
    }
    echo '<hr>';
  }
  elseif ($value["tipo"]==5)
  {
    $proceso=$value["proceso"];
    $insertarterminado="INSERT INTO TERMINADO (Estatus,PROCESO_idPROCESO,ORDENPROCESO_idORDENPROCESO) VALUES('Iniciado','9','$idproceso')";
    $queryterminado=mysqli_query($conn,$insertarterminado);
    $idterminado=mysqli_insert_id($conn);
    echo $insertarterminado;
    echo '</br>';
    echo '</br>';
    foreach ($value as $pos => $lista)
    {
      if (count($lista)>2)
      {
        $idproducto=$lista["idProducto"];
        $cantidad=$lista["cantidad"];
        $nombre=$lista["nombre"];
        $descripcion=$lista["color"];
        $insertarlistaterminado="INSERT INTO LISTATERMINADO (PROCESO_idPROCESO,PRODUCTO_idPRODUCTO,Cantidad,Nombre,TERMINADO_idTERMINADO,Descripcion) VALUES('9','$idproducto','$cantidad','$nombre','$idterminado','$descripcion')";
        echo $insertarlistaterminado;
        echo '</br>';
        $querylistaterminado=mysqli_query($conn,$insertarlistaterminado);
      }
      else
      {
        # code...
      }
    }

  }
}

mysqli_close($conn);
 ?>
 <a href="../">Regresar</a>
