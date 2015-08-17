<?php
/*
 * =============================================================================
 * «Copyright 2014 Jesús Omar Pérez Camargo»
 * email: jesus.perez.65535@gmail.com
 * facebook: https://www.facebook.com/elhombre.sonriente
 * google+: https://plus.google.com/116784166035161515634
 * =============================================================================
 *                               LICENSE GPL
 * =============================================================================
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * =============================================================================
*/
require_once __DIR__.'/../coleccion/ColeccionSql.class.php';

class Clientes extends ColeccionSql
{
    private $IdCliente;
    private $Codigo;
    private $Mac;

    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
        $this->Tabla = "clientes";
        if($ColBusqueda && $ValorBusqueda)
        {
            $this->establecer($ColBusqueda, $ValorBusqueda, $Columna, $Limite);
        }
    }

    public function establecer($ColBusqueda, $ValorBusqueda, $Columna = array("*"), $Limite = 1)
    {
        if(empty($Columna) || !is_array($Columna)){$Columna = array("*");}
        $Columnas = $Columna;
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->limite("$Limite");
        $this->consultar($Columnas, $this->Tabla);
        $Cliente = $this->extraer(PDO::FETCH_ASSOC);
        $this->IdCliente = $this->iterarColumna($Cliente, "id_cliente");
        $this->Codigo = $this->iterarColumna($Cliente, "codigo");
        $this->Mac = $this->iterarColumna($Cliente, "mac");
    }

    public function actualizar($colBusqueda, $valorBusqueda)
    {
            if($this->IdBillioon)
            {
                $columna[] = "id_cliente='$this->IdCliente'";
            }
            if($this->Nombre)
            {
                $columna[] = "codigo='$this->Codigo'";
            }
            if($this->Bote)
            {
                $columna[] = "mac='$this->Mac'";
            }
            $this->mientras($colBusqueda, $valorBusqueda);
            $this->recargar($columna, $this->Tabla);
    }

    public function insertar()
    {
        $valores = array("'$this->Codigo'","'$this->Mac'");
        $columnas = array("codigo","mac");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function obtenerIdCliente()
    {
        return $this->IdCliente;
    }

    public function establecerIdCliente($idcliente)
    {
        $this->IdCliente = $idcliente;
    }

    public function obtenerCodigo()
    {
        return $this->Codigo;
    }

    public function establecerCodigo($codigo)
    {
        $this->Codigo = $codigo;
    }

    public function obtenerMac()
    {
        return $this->Mac;
    }

    public function establecerMac($mac)
    {
        $this->Mac = $mac;
    }
}
