<?php
include('../clases/conexion.php');
$usu = addslashes($_POST['usu']);
$pass = addslashes($_POST['pass']);
$usuario = "SELECT * FROM PERSONAL WHERE Usuario='$usu'";
$consultausu= mysqli_query($conn,$usuario);
if (mysqli_num_rows($consultausu)<1) 
{
	echo 'a';
}


?>