<?php
include('../../clases/conexion.php');
 ?>
<html lang="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Configuraciones</title>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<script type="text/javascript" src="../../js/jquery.js">
</script>
<script type="text/javascript" src="../../js/bootstrap.js">
</script>
<script type="text/javascript" src="clases/terminal.js">
</script>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div  class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../"><img src="../../iconos/flecha.png"/>Regresar</a></li>
            <li class="active"><a href="#">Terminales</a></li>
            <li><a href="#">Colores</a></li>
            <li><a href="../clases/salir.php">Salir</a></li>
          </ul>
          </div>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav>
    <br>
    <br>
    <br>
    <br><br>
    <div class="container">
      <a class="btn btn-primary" href="#empleado" data-toggle="modal">Nueva Terminal</a>
      <div id="empleado" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
        <div class="modal-header">
          <h3>Agregar Terminal</h3>
        </div>
        <div class="modal-body">
          <label for="clave">Clave</label>
          <input type="text" id="clave" class="form-control">
          <label for="nombre">Nombre Terminal</label>
          <input type="text" class="form-control" id="nombre" >

        </div>
        <div class="modal-footer">
          <a href="JavaScript:Guardar()" class="btn btn-primary">Guardar</a>
        </div>
      </div>
      </div>
      </div>
      <h2>Terminales Activas</h2>
        <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <td>Clave</td>
                      <td>Nombre</td>
                      <td>Estado</td>
                      <td></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $seleccionarActivas="SELECT * FROM TERMINAL WHERE Estado='ACTIVO' AND Estatus=1";
                      $queryActivo=mysqli_query($conn,$seleccionarActivas);
                      while ($filaActivo=mysqli_fetch_array($queryActivo))
                      {
                        echo '<tr>';
                        echo '<td>'.$filaActivo['ClaveTerminal'].'</td>';
                        echo '<td>'.$filaActivo['NombreTerminal'].'</td>';
                        echo '<td>'.$filaActivo['Estado'].'</td>';
                        echo '<td><a class="btn btn-warning" href="javascript:Desactivar('.$filaActivo['idTERMINAL'].');">Desactivar</a></td>';
                        echo '<td><a class="btn btn-danger" href="javascript:Suspender('.$filaActivo['idTERMINAL'].');">Suspender</a></td>';
                        echo '</tr>';
                       }
                      ?>
                  </tbody>
                </table>
        </div>
        <h2>Terminales Inactivas</h2>
        <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <td>Clave</td>
                    <td>Nombre</td>
                    <td>Estado</td>
                    <td></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $seleccionarInactivos="SELECT * FROM TERMINAL WHERE Estado='INACTIVO' AND Estatus=1";
                  $queryInactivo=mysqli_query($conn,$seleccionarInactivos);
                  while ($filaInactivo=mysqli_fetch_array($queryInactivo))
                  {
                    echo '<tr>';
                    echo '<td>'.$filaInactivo['ClaveTerminal'].'</td>';
                    echo '<td>'.$filaInactivo['NombreTerminal'].'</td>';
                    echo '<td>'.$filaInactivo['Estado'].'</td>';
                    echo '<td><a class="btn btn-primary" href="javascript:Activar('.$filaInactivo['idTERMINAL'].');">Activar</a></td>';
                    echo '<td><a class="btn btn-danger" href="javascript:Suspender('.$filaInactivo['idTERMINAL'].');">Suspender</a></td>';
                    echo '</tr>';
                  }
                   ?>
                </tbody>
              </table>
        </div>
        <h2>Terminales Suspendidas</h2>
          <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <td>Clave</td>
                      <td>Nombre</td>
                      <td>Estado</td>
                      <td></td>
                      <td></td>
                    </tr>
                  </thead>
                  <?php
                  $selecionarSuspendido="SELECT * FROM TERMINAL WHERE Estado='SUSPENDIDO' AND Estatus=0";
                  $querySuspendido=mysqli_query($conn,$selecionarSuspendido);
                  while ($filaSuspendido=mysqli_fetch_array($querySuspendido))
                  {
                    echo '<tr>';
                    echo '<td>'.$filaSuspendido['ClaveTerminal'].'</td>';
                    echo '<td>'.$filaSuspendido['NombreTerminal'].'</td>';
                    echo '<td>'.$filaSuspendido['Estado'].'</td>';
                    echo '<td><a class="btn btn-primary" href="javascript:Activar('.$filaSuspendido['idTERMINAL'].');">Activar</a></td>';
                    //echo '<td><a class="btn btn-warning" href="javascript:Suspender('.$filaSuspendido['idTERMINAL'].');">Suspender</a></td>';
                    echo '</tr>';
                  }
                  ?>
                </table>
          </div>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
 ?>
