<?php
require_once __DIR__.'/../../core/Validacion.class.php';

$Validacion = new Validacion();
if($sesion = $Validacion->obtenerSession($_POST['user'], $_POST['password']))
{
    $mensaje = array("mensaje"=>"inicio session");
    print_r(json_encode($mensaje));
}
else
{
    $mensaje = array("mensaje"=>"*El usuario o password que introdujo no es correcto, por favor vuelva a intentarlo");
    print_r(json_encode($mensaje));    
}
