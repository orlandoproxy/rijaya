<?php
include('../../../clases/conexion.php');
if(count($_REQUEST)>0)
{
	if ($_POST['tipo']==1) 
	{
		$cantidad=$_POST['cantidad'];
		$proceso=$_POST['proceso'];
		$lista=$_POST['lista'];
		$insertarMerma="INSERT INTO MERMA(idPROCESO,idLISTA,Cantidad) VALUES('$proceso','$lista','$cantidad')";
		$querymerma=mysqli_query($conn,$insertarMerma);
	}
	elseif ($_POST['tipo']==2) 
	{
		$idmerma=$_POST['idmerma'];
		$eliminarmerma="DElETE FROM MERMA WHERE idMERMA=$idmerma";
		$queryEliminar=mysqli_query($conn,$eliminarmerma);
	}
	elseif ($_POST['tipo']==3) 
	{
		$fecha=date("Y/m/d");
		$id=$_POST['idpro'];
		$cantidad=$_POST['cantidad'];
		$hora=$_POST['fecha'];
		$mescla=$fecha.':'.$hora;
		$actualizar="UPDATE LISTAMAQUINADO SET Cantidad=$cantidad, Final='$mescla',Estatus='Finalizado' WHERE idLISTAMAQUINADO=$id";
		echo $actualizar;
		$queryactu=mysqli_query($conn,$actualizar);
	}
}
else
{
	echo count($_REQUEST);
}
mysqli_close($conn);
?>