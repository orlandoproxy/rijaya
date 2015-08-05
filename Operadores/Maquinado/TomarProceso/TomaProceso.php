<?php
if (isset($_POST['fecha']) && isset($_POST['ayudantes'])) 
{
	$fecha = $_POST['fecha'];
	$ayudantes =$_POST['ayudantes'];
	session_start();
	$idpieza=$_SESSION['idpieza'];
	$idMaquindo=$_SESSION['idMaquindo'];
	$lista= explode(',', $ayudantes);
	$terminal=$_SESSION['idTerminal'];
	$proceso=$_SESSION['idproceso'];
}
else
{
	header('location: ../');
}
include('../../../clases/conexion.php');
//comprobar estatu
$comprobar="SELECT * FROM LISTAMAQUINADO WHERE MAQUINADO_idMAQUINADO=$idMaquindo AND Estatus='En Proceso'";
$querycomprobar=mysqli_query($conn,$comprobar);
$filacompro=mysqli_fetch_assoc($querycomprobar);
if (count($filacompro)>0) 
{
	echo '1';
}
else
{
	$insertarLista="INSERT INTO LISTAMAQUINADO (inicio,Estatus,MAQUINADO_idMAQUINADO,TERMINAL_idTERMINAL) VALUES('$fecha','En proceso','$idMaquindo','$terminal')";
$queryInsertarLista=mysqli_query($conn,$insertarLista);
$idlista=mysqli_insert_id($conn);

foreach ($lista as $pos => $id) 
{
	$insertarrelacion="INSERT INTO LISTAOPERADORES (LISTA_idLISTA,idPROCESO,idROLES) VALUES('$idlista','$proceso','$id')";
	$queryoperadore=mysqli_query($conn,$insertarrelacion);
	
}
$SelectEstatus="SELECT Estatus FROM MAQUINADO WHERE idMAQUINADO=$idMaquindo";
$queryestatus=mysqli_query($conn,$SelectEstatus);
$filaEsatus=mysqli_fetch_assoc($queryestatus);
if ($filaEsatus['Estatus']=='No Iniciado') 
{
	//actualizarestatus
	$actualizarestatus="UPDATE MAQUINADO SET Estatus='En Proceso' WHERE idMAQUINADO=$idMaquindo";
	$queryActualizar=mysqli_query($conn,$actualizarestatus);	
}

}
mysqli_close($conn);
?>