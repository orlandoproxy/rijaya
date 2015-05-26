<?php
require_once __DIR__.'/Filtrador.class.php';
require_once __DIR__.'/databases/Proxy.class.php';

class Validacion extends Filtrador
{
    private $Usuario;
    private $Password;
    private $Conexion;
    
    public function __construct()
    {
        $this->Usuario = "";
        $this->Password = "";
        parent::__construct();
        $Proxy = new Proxy();
        $this->Conexion = $Proxy->conexionSql();
    }
    
    private function obtenerUsuario($usuario)
    {
        $this->Usuario = $this->filtrarVariable($usuario);
    }
    
    private function obtenerPassword($password)
    {
        $this->Password = $this->filtrarVariable($password);
    }
    
    public function obtenerSession($usuario, $password)
    {
        $this->obtenerUsuario($usuario);
        $this->obtenerPassword($password);
        $Consultar = $this->Conexion->prepare("SELECT usuario, password FROM usuarios WHERE usuario='$this->Usuario' and password='$this->Password'");
        $Consultar->execute();
        if($datos = $Consultar->fetchAll())
        {
            return True;
        }
        
        return FALSE;
    }
}
