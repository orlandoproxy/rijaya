<?php
if (count($_REQUEST)>0) 
{
	session_start();
	$tipo=$_POST['elegido'];
	$_SESSION['categoprodu']=$tipo;
}
else
{
	header('Location:index.php');
}
echo $tipo;
?>