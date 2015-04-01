<?php
session_start();
session_destroy();
mysql_close();

include("../clases/redireccion.php");

?>