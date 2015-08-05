<?php

//include('../../clases/redireccion.php');
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Producto</title>
  <script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="js/Buscar.js"></script>
  <script type="text/javascript" src="js/categoria.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="propio.css">
</head>
  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Pedido">Pedido</a></li>
            <li class="active"><a href="#">Producto</a></li>
            <li><a href="../Proceso">Procesos</a></li>
            <li ><a href="../Material">Material</a></li>
            <li><a href="../Personal">Personal</a></li>
            <li><a href="../Roles">Roles</a></li>
            <li><a href="../Configuracion">Configuracion</a></li>
            <li><a href="../../clases/cerrar.php">Salir</a></li>

          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

<div class="container">


<p>
  <a href="InsertarProducto/" class="btn btn-primary btn-lg">Nuevo Producto</a>
</p>
<table >
  <tr>
        <td>
      <select class="form-control" id="Tipo">
        <option >Linea</option>
        <option >Prototipo</option>
        <option >Especial</option>
      </select>
    </td>
    <td>
      <input class="form-control" type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" Placeholder="Buscar" />
    </td>
  </tr>
</table>

    <div >
    <table  class="table table-condensed">
    <thead>
      <tr>
      <td>Clave</td>
      <td>Nombre</td>
      <td>Tipo</td>
      <td>Estatus</td>
      <td>Medidas</td>
      <td>Categoria</td>
      <td>Selecionar</td>
      <td>Editar</td>
    </tr>
    </thead>
    <tbody id="myDiv">
    </div>
</div>
</div>
</div>

</body>
</html>
