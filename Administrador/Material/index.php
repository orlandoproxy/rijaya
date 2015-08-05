<?php
//include('../../clases/conexion.php');
?>
<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Material</title>
<script type="text/javascript" src="js/buscar.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Pedido">Pedido</a></li>
            <li ><a href="../Producto">Producto</a></li>
            <li><a href="../Proceso">Procesos</a></li>
            <li class="active"><a href="#">Material</a></li>
            <li><a href="../Personal">Personal</a></li>
            <li><a href="../Roles">Roles</a></li>
            <li><a href="../Configuracion">Configuracion</a></li>
            <li><a href="../clases/salir.php">Salir</a></li>


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
  <a href="InsertarMaterial/" class="btn btn-primary btn-lg">Nuevo Material</a>
</p>
<input class="glyphicon glyphicon-search" type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" Placeholder="Buscar" />

    <div >
    <table  class="table">
    <thead>
      <tr>
      <td>Clave</td>
      <td>Nombre</td>
      <td>Categoria</td>
      <td></td>
      <td></td>
    </tr>
    </thead>
    <tbody id="myDiv">
    </div>
</div>
</div>
</body>
</html>
