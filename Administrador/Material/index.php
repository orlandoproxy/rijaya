<?php
include('../../clases/conexion.php');
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Material</title>
<script type="text/javascript" src="js/buscar.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse">
		<div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Pedido</a></li>
            <li><a href="../Producto/">Producto</a></li>
            <li><a href="#">Procesos</a></li>
            <li class="active"><a href="#">Material</a></li>
            <li><a href="#">Personal</a></li>
            <li><a href="#">Roles</a></li>
            <li><a href="#">Areas/Proceso</a></li>
            <li><a href="../clases/cerrar.php">Salir</a></li>

          </ul>
        </div>

	</div>
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
</div>
<div>
</body>
</html>