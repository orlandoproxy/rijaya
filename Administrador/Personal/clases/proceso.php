<?php
include('../../../clases/conexion.php');
$Tipo=$_POST['elegido'];
$selecionarTipo="SELECT * FROM PERSONAL WHERE Categoria=$Tipo";
$queryPersonal=mysqli_query($conn,$selecionarTipo);
while ($filaPersonal=mysqli_fetch_array($queryPersonal))
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
