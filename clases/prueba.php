<?php
session_start();
echo $_SESSION["Nombreusu"];
session_destroy();
?>