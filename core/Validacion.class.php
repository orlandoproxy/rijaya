<?php
require_once __DIR__.'/Filtrador.class.php';
require_once __DIR__.'/databases/Proxy.class.php';

class Validacion extends Filtrador
{
    private $Usuario;
    private $Password;
    private $Codigo;
    private $Conexion;
    
    public function __construct()
    {
        $this->Usuario = "";
        $this->Password = "";
        $this->Codigo = "";
        parent::__construct();
        $Proxy = new Proxy();
        $this->Conexion = $Proxy->conexionSql();
    }
    
    private function obtenerUsuario($usuario)
    {
        $this->Usuario = $this->filtrarVariable($this->limitarCadena($usuario, 5, 20));
    }
    
    private function obtenerPassword($password)
    {
        $this->Password = $this->filtrarVariable($this->limitarCadena($password, 5, 20));
    }
    
    private function obtenerCodigo($codigo)
    {
        $this->Codigo = $this->filtrarVariable($this->limitarCadena($codigo, 5, 10));
    }
    
    public function obtenerSessionUser($usuario, $password)
    {
        $this->obtenerUsuario($usuario);
        $this->obtenerPassword($password);
        $Consultar = $this->Conexion->prepare("SELECT usuario, password FROM usuarios WHERE usuario='$this->Usuario' and password='$this->Password'");
        $Consultar->execute();
        if($datos = $Consultar->fetchAll())
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function obtenerSessionOpera($codigo)
    {
        $this->obtenerCodigo($codigo);
        $Consultar = $this->Conexion->prepare("SELECT codigo FROM empleados WHERE codigo='$this->Codigo' and cargo='operador'");
        $Consultar->execute();
        if($datos = $Consultar->fetchAll())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
