<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personal</title>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="canvas.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Pedido">Pedido</a></li>
            <li><a href="../Producto">Producto</a></li>
            <li><a href="../Proceso">Procesos</a></li>
            <li><a href="../Material">Material</a></li>
            <li class="active"><a href="#">Personal</a></li>
            <li><a href="../Roles">Roles</a></li>
          <li><a href="../Configuracion">Configuracion</a></li>
            <li><a href="../../clases/cerrar.php">Salir</a></li>

          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

<div class="container">
  <p>
     <a href="Insertar/" class="btn btn-primary btn-lg">Nuevo Personal</a>
  </p>
  <table class="table table-condensed">
    <thead>
      <tr>
        <td>Nombre's</td>
        <td>Apellido Paterno</td>
        <td>Apellido Materno</td>
        <td>Nombre Usuario</td>
        <td>Estatus</td>
        <td>Categoria</td>
        <td></td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      <?php
      include('../../clases/conexion.php');
      $consultaPersonal="SELECT * FROM PERSONAL";
      $queryConsulta=mysqli_query($conn,$consultaPersonal);
      while ($filaPersonal=mysqli_fetch_array($queryConsulta))
      {
        echo '<tr>';
        echo '<td>'.$filaPersonal['Nombre'].'</td>';
        echo '<td>'.$filaPersonal['ApellidoPaterno'].'</td>';
        echo '<td>'.$filaPersonal['ApellidoMaterno'].'</td>';
        echo '<td>'.$filaPersonal['Usuario'].'</td>';
        echo '<td>'.$filaPersonal['Estatus'].'</td>';
        switch ($filaPersonal['Categoria'])
        {
          case '1':
           echo '<td>Administrador</td>';
          break;
                    case '2':
           echo '<td>Jefe de Produccion</td>';
          break;
                    case '3':
           echo '<td>Contador</td>';
          break;
                    case '4':
           echo '<td>Vendedor</td>';
          break;
                    case '5':
           echo '<td>Operador</td>';
          break;


        }
        echo '<td><a class="btn btn-primary" href="Seleccionar/index.php?idpersonal='.$filaPersonal['idPERSONAL'].'">Selecionar</a></td>';
        echo '<td><a class="btn btn-info" href="Editar/index.php?idpersonal='.$filaPersonal['idPERSONAL'].'">Editar</a></td>';
        echo '</tr>';
      }
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
</div>
</div>
</body>
</html>
