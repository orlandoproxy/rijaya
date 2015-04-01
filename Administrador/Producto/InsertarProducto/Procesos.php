<?php
include('../../../clases/conexion.php');
$consultaProc= "SELECT Nombre FROM PROCESO";
$resultadoProceso = mysqli_query($conn,$consultaProc);

?>
<html>
<head>
	<title>Ejemplo</title>
</head>
<body>
<?php
	if (mysqli_num_rows($resultadoProceso)>1) 
{
	while ($option=mysqli_fetch_array($resultadoProceso)) 
	{
		
		echo '<input type="checkbox" name="'.$option['Nombre'].'" text="'.$option['Nombre'].'" />'.$option['Nombre'].',  ';
		
	 }
}
?>
</body>

</html>
