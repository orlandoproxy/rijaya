<?php
include('../../clases/conexion.php');
$q="";
$q=$_POST['q'];
$limite = 25;
$pag=0;
//pagina pedida
$pag = (int) $_GET["pag"];
if ($pag < 1) 
{
$pag = 1;
}
$offset = ($pag-1) * $limite;

//query
$sql= "SELECT SQL_CALC_FOUND_ROWS idMATERIAL, Nombre, Clave, Categoria FROM MATERIAL WHERE (CONCAT(Nombre, Clave, Categoria)LIKE'%".$q."%')LIMIT $offset, $limite";
$sqlTotal = "SELECT COUNT(*) FROM MATERIAL WHERE (CONCAT(Nombre, Clave, Categoria)LIKE'%".$q."%') ";

$rs = mysqli_query($conn,$sql);
$rsTotal = mysqli_query($conn,$sqlTotal);

$rowTotal = mysqli_fetch_array($rsTotal);
$total = $rowTotal[0];
while ($fila = mysqli_fetch_array($rs)) 
{
	echo '<tr>';
	echo '<td>'.$fila['Clave'].'</td><td>'.$fila['Nombre'].'</td><td>'.$fila['Categoria'].'</td>';
	echo '<td></td><td></td>';
	echo '</tr>';
}
echo '</tbody>';
echo '</table>';
$totalpag = ceil($total/$limite);
$links = array();
for ($i=1; $i<=$totalpag ; $i++) 
{
	$links[] = "<a href=\"?pag=$i\">$i</a>";
}
echo implode(" - ", $links);

?>