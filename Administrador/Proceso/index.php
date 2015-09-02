<?php
include("../../clases/conexion.php");
mysqli_close($conn);
?>
<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Procesos</title>
<script type="text/javascript" src="js/buscar.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="../Pedido">Pedido</a></li>
            <li ><a href="../Producto">Producto</a></li>
            <li class="active"><a href="#">Procesos</a></li>
            <li><a href="../Material">Material</a></li>
            <li><a href="../Personal">Personal</a></li>
            <li><a href="../Roles">Roles</a></li>
            <li><a href="../Configuracion">Configuracion</a></li>
            <li><a href="../../clases/cerrar.php">Salir</a></li>

          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav>
        <div class="container">

  <div class="row row-offcanvas row-offcanvas-right">
<br>
<br>
<br>
<p>
  <a href="InsertarOrden/" class="btn btn-primary btn-lg">Nueva Orden de Produccion</a>
</p>
<div class="form-group">
  <table>
    <tr>
      <td>
        <select id="Categoria" class="form-control">
          <option>Activo</option>
          <option>No Iniciado</option>
          <option>Cancelado</option>
          <option>Finalizado</option>
        </select>
      </td>
      <td>
        <input class="form-control" type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" Placeholder="Buscar" />
      </td>
    </tr>
  </table>
</div>
    <div >
    <table  class="table">
    <thead>
      <tr>
      <td>N° Pedido</td>
      <td>Estatus</td>
      <td>Prioridad</td>
      <td></td>
      <td></td>
    </tr>
    </thead>
    <tbody id="myDiv">
      <?php
      include("../../clases/conexion.php");
      $selecionarPedido="SELECT * FROM ORDENPROCESO";
      $queryPedido=mysqli_query($conn,$selecionarPedido);
      while ($filaPedido=mysqli_fetch_array($queryPedido))
      {
        echo '<tr>';
        echo '<td>'.$filaPedido['Clave'].'</td>';
        echo '<td>'.$filaPedido['FechaEmicion'].'</td>';
        echo '<td>'.$filaPedido['FechaEmicion'].'</td>';
        echo '<td><a class="btn btn-primary">Selecionar</a></td>';
        echo '<td><a>Editar</a></td>';
        echo '</tr>';
      }

      mysqli_close($conn);
      ?>
    </div>
</div>
</div>
</body>
</html>
