<?php
require_once __DIR__.'/../../core/Validacion.class.php';
$Validacion = new Validacion();
if($sesion = $Validacion->obtenerSession($_POST['user'], $_POST['password']))
{
    echo "Ha iniciado session";
}
else
{
    echo "No ha podido iniciar session";
}
