<?php
include('../../clases/conexion.php');
$q="";
$q=$_POST['q'];
//SELECT PRODUCTO.idPRODUCTO, PRODUCTO.Nombre,PRODUCTO.Tipo,PRODUCTO.Estatus,PRODUCTO.Medida1,PRODUCTO.Medida2,CATEGORIA.Nombre AS NombreCatego FROM PRODUCTO INNER JOIN CATEGORIA ON PRODUCTO.CATEGORIA_idCATEGORIA=CATEGORIA.idCATEGORIA WHERE
$producto="SELECT PRODUCTO.idPRODUCTO,PRODUCTO.Clave, PRODUCTO.Nombre,PRODUCTO.Tipo,PRODUCTO.Estatus,PRODUCTO.Medida1,PRODUCTO.Medida2,PRODUCTO.Medida3,CATEGORIA.Nombre AS NombreCatego FROM PRODUCTO INNER JOIN CATEGORIA ON PRODUCTO.CATEGORIA_idCATEGORIA=CATEGORIA.idCATEGORIA WHERE (CONCAT(PRODUCTO.CLave,PRODUCTO.Nombre,PRODUCTO.Tipo,PRODUCTO.Estatus,CATEGORIA.Nombre)LIKE'%".$q."%')";
//$producto="SELECT idPRODUCTO,Nombre,Tipo,Estatus,Clave FROM PRODUCTO WHERE Nombre LIKE'%".$q."%' ";

$red=mysqli_query($conn,$producto);
if (mysqli_num_rows($red)==0)
{
	echo "No hay Coincidencias";
}
else
{

	
	while ($fila=mysqli_fetch_array($red)) 
	{
		echo '<tr>';
		echo '<td>'.$fila['Clave'].'</td><td>'.$fila['Nombre'].'</td><td>'.$fila['Tipo'].'</td>';
		switch ($fila['Estatus']) 
		{
			case 'Activo':
				echo '<td class="active">'.$fila['Estatus'].'</td>';
				break;
			case 'Suspendido':
				echo '<td class="danger">'.$fila['Estatus'].'</td>';
				break;
			case 'Incompleto':

				echo '<td class="warning">'.$fila['Estatus'].'</td>';
				break;

		}
		echo '<td>'.$fila['Medida1'].'.cm X '.$fila['Medida2'].'.cm X '.$fila['Medida3'].'.cm </td>';
		echo '<td>'.$fila['NombreCatego'].'</td>';
		echo '<td><a class="label label-success" href="Selecionar/index.php?IDPro='.$fila['idPRODUCTO'].'">Selecionar</a></td>';
		echo '<td><a class="label label-info" href="Editar/index.php?IDPro='.$fila['idPRODUCTO'].'">Editar</a></td>';
		echo '</tr>';

	}
	echo '</tbody>';
	echo '</table>';
}
?>