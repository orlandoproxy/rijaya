<?php
include('../clases/conexion.php');
//include('../clases/redireccion.php');
echo $_SESSION['Nombreusu'];
?>
<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Documentos</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse">
		<div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Pedido</a></li>
            <li><a href="../Administrador/Producto/">Producto</a></li>
            <li><a href="#">Procesos</a></li>
            <li><a href="Material/">Material</a></li>
            <li><a href="#">Personal</a></li>
            <li><a href="#">Roles</a></li>
            <li><a href="#">Areas/Proceso</a></li>
            <li><a href="../clases/cerrar.php">Salir</a></li>

          </ul>
        </div>
	</div>
    <div class="container">
        <p>
              <a href="InsertarProducto/" class="btn btn-primary btn-lg">Nuevo Producto</a>
        </p>
    </div>
</body>
</html>