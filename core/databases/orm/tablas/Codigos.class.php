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

class Codigos extends ColeccionSql
{
    private $IdCodigo;
    private $Codigo;
    private $Precio;
    private $Tiempo;
    private $Activo;
    private $ActivoMaster;

    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
        $this->Tabla = "codigos";
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
        $Codigo = $this->extraer(PDO::FETCH_ASSOC);
        $this->IdCodigo = $this->iterarColumna($Codigo, "id_codigo");
        $this->Codigo = $this->iterarColumna($Codigo, "codigo");
        $this->Precio = $this->iterarColumna($Codigo, "precio");
        $this->Tiempo = $this->iterarColumna($Codigo, "tiempo");
        $this->Activo = $this->iterarColumna($Codigo, "activo");
        $this->ActivoMaster = $this->iterarColumna($Codigo, "activomaster");
    }

    public function actualizar($ColBusqueda, $ValorBusqueda)
    {
        $con = 0;
        if($this->IdCodigo)
        {
            $columna[$con] = "id_codigo='".$this->IdCodigo."'";
            $con++;
        }
        if($this->Codigo)
        {
            $columna[$con] = "codigo='".$this->codigo."'";
            $con++;
        }
        if($this->Precio)
        {
            $columna[$con] = "precio='".$this->Precio."'";
            $con++;
        }
        if($this->Tiempo)
        {
            $columna[$con] = "tiempo='".$this->Tiempo."'";
            $con++;
        }
        if($this->Activo)
        {
            $columna[$con] = "activo='".$this->Activo."'";
            $con++;
        }
        if($this->ActivoMaster)
        {
            $columna[$con] = "activomaster='".$this->ActivoMaster."'";
            $con++;
        }
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->recargar($columna, $this->Tabla);
    }

    public function insertar()
    {
        $valores = array("'$this->Codigo'","$this->Precio","$this->Tiempo","$this->Activo","$this->ActivoMaster");
        $columnas = array("codigo","precio","tiempo","activo","activomaster");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function obtenerIdCodigo()
    {
        return $this->IdCodigo;
    }

    public function obtenerCodigo()
    {
        return $this->Codigo;
    }

    public function establecerCodigo($codigo)
    {
        $this->IdCodigo = $codigo;
    }

    public function obtenerPrecio()
    {
        return $this->Precio;
    }

    public function establecerPrecio($precio)
    {
        $this->Precio = $precio;
    }

    public function obtenerTiempo()
    {
        return $this->Tiempo;
    }

    public function establecerTiempo($tiempo)
    {
        $this->Tiempo = $tiempo;
    }

    public function obtenerActivo()
    {
        return $this->Activo;
    }

    public function establecerActivo($activo)
    {
        $this->Activo = $activo;
    }

    public function obtenerActivoMaster()
    {
        return $this->ActivoMaster;
    }

    public function establecerActivoMaster($activomaster)
    {
        $this->ActivoMaster = $activomaster;
    }
}
