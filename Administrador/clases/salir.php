<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['idproceso']);
unset($_SESSION['idpieza']);
unset($_SESSION['idMaquindo']);
header('location: ../../');
?>