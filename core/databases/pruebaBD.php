<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Proxy.class.php';

class Prueba
{
    private $Conexion;
    
    public function __construct()
    {
        $Proxy = new Proxy();
        $this->Conexion = $Proxy->conexionSql();
    }
    
    public function Imprimir()
    {
        $Consultar = $this->Conexion->prepare("SELECT * FROM usuarios");
        $Consultar->execute();
        $datos = $Consultar->fetchAll(PDO::FETCH_ASSOC);
        foreach($datos as $row)
        {
            echo $row['usuario'];
        }
    }
}

$poco = new Prueba();
$poco->Imprimir();