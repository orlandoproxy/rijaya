<?php
session_start();
if(isset($_SESSION['Nombreusu'])==false or isset($_SESSION['Prioridad'])==false)
{
	header('Location: ../index.php');
}
else
{
	
	
}
?>