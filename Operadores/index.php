<?php
include('../clases/conexion.php');
session_start();
if (isset($_SESSION['id'])) 
{
	$idOperador=$_SESSION['id'];
}
else
{
	echo $idOperador;
	//header('Location: ../');
}

if (isset($_SESSION['idTerminal'])) 
{
	$SelecionRol="SELECT PROCESO_idPROCESO FROM ROLES WHERE PERSONAL_idPERSONAL=$idOperador AND FechaSalida is null";
	echo $SelecionRol;
	$queryRol=mysqli_query($conn,$SelecionRol);

	while ($fila=mysqli_fetch_array($queryRol)) 
	{
		$proceso=$fila['PROCESO_idPROCESO'];
		switch ($proceso) 
		{
			case 1:
				header("Location: Maquinado/");
				break;
			case 2:
				header("Location: Maquinado/");
				break;
			case 3:
				header("Location: Maquinado/");
				break;
			case 4:
				header("Location: Maquinado/");
				break;

			case 5:
				header("Location: Ensamble/");
				break;
			case 6:
				header("Location: Ensamble/");
				break;
			case 7:
				header("Location: Ensamble/");
				break;
			case 8:
				header("Location: Pintura/");
				break;
			case 9:
				header("Location: Terminado/");
				break;
			case 0:
				header("Location: ../");
				break;

			default:
				
				break;
		}

		$_SESSION['idproceso']=$proceso;	
	}
}
else
{
	header("Location: Registrar.php");

}
mysqli_close($conn);

?>
