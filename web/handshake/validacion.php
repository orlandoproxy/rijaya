<?php
session_start();
if(!isset($_SESSION['usuario']['iduser']))
{
    require_once __DIR__.'/../../core/Validacion.class.php';

    $Validacion = new Validacion();
    if(isset($_POST['user']) && isset($_POST['password']))
    {
        if($sesion = $Validacion->obtenerSessionUser($_POST['user'], $_POST['password']))
        {
            
        }
        else
        {
            $mensaje = array("mensaje"=>"*El usuario o contrase&ntilde;a que introdujo es incorrecto, por favor vuelva a intentarlo");
            print_r(json_encode($mensaje));    
        }
    }
    if(isset($_POST['codigo']))
    {
        if($sesion = $Validacion->obtenerSessionOpera($_POST['codigo']))
        {
            $mensaje = array("mensaje"=>"inicio session");
            print_r(json_encode($mensaje));
        }
        else
        {
            $mensaje = array("mensaje"=>"*El codigo de operador es incorrecto, por favor vuelva a intentarlo");
            print_r(json_encode($mensaje));    
        }
    }
}
