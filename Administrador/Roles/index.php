<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Roles</title>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="clases/final.js"></script>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../Pedido">Pedido</a></li>
            <li ><a href="../Producto">Producto</a></li>
            <li><a href="../Proceso">Procesos</a></li>
            <li><a href="../Material">Material</a></li>
            <li><a href="../Personal">Personal</a></li>
            <li class="active"><a href="#">Roles</a></li>
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
    <a href="InsertarRol/" class="btn btn-primary btn-lg">Nuevo Rol</a>
  </div>

</div>
<div class="container">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td>Nombre</td>
          <td>Proceso</td>
          <td>Fecha Entrada</td>
          <td></td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <?php
        include("../../clases/conexion.php");
        $ConsultaTabla="SELECT PERSONAL.Nombre,PROCESO.Nombre AS NombreProceso, ROLES.idROLES, ROLES.FechaEntrada, ROLES.FechaSalida FROM `ROLES` INNER JOIN PERSONAL ON PERSONAL_idPERSONAL=idPERSONAL INNER JOIN PROCESO ON idPROCESO=PROCESO_idPROCESO WHERE ROLES.Estatus='Activo'";
        $queryTabla=mysqli_query($conn,$ConsultaTabla);
        while ($filatabla=mysqli_fetch_array($queryTabla))
        {
          echo '<tr>';
          echo '<td>'.$filatabla['Nombre'].'</td>';
          echo '<td>'.$filatabla['NombreProceso'].'</td>';
          echo '<td>'.$filatabla['FechaEntrada'].'</td>';
          if (count($filatabla['FechaSalida'])>0)
          {
            echo '<td></td>';
            echo '<td></td>';
          }
          else
          {
          echo  '<td><a class="btn btn-success" href="JavaScript:Finalizar('.$filatabla['idROLES'].');">Finalizar</a></td>';
          echo  '<td></td>';
          }
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
