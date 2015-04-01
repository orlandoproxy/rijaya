<?php
include('../../clases/conexion.php');
//include('../../clases/redireccion.php');
?>
<html>
<head>
	<title>Producto</title>
	<script type="text/javascript" src="js/Buscar.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="propio.css">
</head>
  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
        	          <ul class="nav navbar-nav">
            <li ><a href="#">Pedido</a></li>
            <li class="active"><a href="#">Producto</a></li>
            <li><a href="#">Pieza</a></li>
            <li><a href="#">Procesos</a></li>
            <li><a href="#">Personal</a></li>
            <li><a href="#">Roles</a></li>
            <li><a href="#">Areas/Proceso</a></li>
            <li><a href="../clases/cerrar.php">Salir</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
    
  <input class="glyphicon glyphicon-search" type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" Placeholder="Buscar" />

    <div >
    <table  class="table">
    <thead>
      <tr>
      <td>Clave</td>
      <td>Nombre</td>
      <td>Tipo</td>
      <td>Estatus</td>
      <td>Selecionar</td>
      <td>Editar</td>
    </tr>
    </thead>
    <tbody id="myDiv">
    </div>
</div>

</body>
</html>
