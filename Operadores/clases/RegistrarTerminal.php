<?php
include("../../clases/conexion.php");
$Clave=$_POST['escaneo'];
$seleccionarClave="SELECT ClaveTerminal FROM TERMINAL WHERE ClaveTerminal='$Clave'";
$queryClave=mysqli_query($conn,$seleccionarClave);
if (mysqli_num_rows($queryClave)>0) 
{

	$verificarEstats="SELECT * FROM TERMINAL WHERE Estatus=1 AND ClaveTerminal='$Clave'";
	
	$queryEstatus=mysqli_query($conn,$verificarEstats);
	if (mysqli_num_rows($queryEstatus)>0) 
	{

		$seleccionarid="SELECT idTERMINAL FROM TERMINAL WHERE ClaveTerminal='$Clave' AND Estatus=1";
		$queryid=mysqli_query($conn,$seleccionarid);
		while ($filaid=mysqli_fetch_array($queryid)) 
		{
			session_start();
			$_SESSION['idTerminal']=$filaid['idTERMINAL'];
			echo '3';
		}
	}
	else
	{
		echo '2';
	}
}
else
{
	echo '1';
}
mysqli_close($conn);
?>