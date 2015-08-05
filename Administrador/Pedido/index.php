<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pedidos</title>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="js/buscar.js"></script>
<script type="text/javascript" src="js/categoria.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Pedido</a></li>
            <li ><a href="../Producto">Producto</a></li>
            <li><a href="../Proceso">Procesos</a></li>
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
  <a href="InsertarPedido/" class="btn btn-primary btn-lg">Nuevo Pedido</a>
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
      session_start();
      if (isset($_SESSION['estatus']))
        {
          $_SESSION['estatus'] = "Activo";
        }
        else
        {

        }
      include("../../clases/conexion.php");
      $selecionarPedido="SELECT * FROM PEDIDO WHERE Estatus='No Iniciado' ";
      $queryPedido=mysqli_query($conn,$selecionarPedido);
      while ($filaPedido=mysqli_fetch_array($queryPedido))
      {
        $idPedido=$filaPedido['idPEDIDO'];
        echo '<tr>';
        echo '<td>'.$filaPedido['NumPedido'].'</td>';
        echo '<td>'.$filaPedido['Estatus'].'</td>';
        echo '<td>'.$filaPedido['Prioridad'].'</td>';
        echo '<td><a class="btn btn-primary" href="selecionar/index.php?iped='.$idPedido.'">Selecionar</a></td>';
        echo '<td><a id="editar_'.$filaPedido['idPEDIDO'].'" class="btn btn-warning">Editar</a></td>';
        echo '</tr>';
      }

      mysqli_close($conn);
      ?>
    </div>
</div>
</div>
</body>
</html>
