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
namespace Modelo\Nucleo\BaseDeDatos\ORM\Tablas;
use Modelo\Nucleo\BaseDeDatos\ORM\Coleccion\ColeccionSql;

class Participacion extends ColeccionSql
{
    private $IdBillioon;
    private $Participacion;
    private $IdUsuario;
    private $Estado;
    private $Tabla;
    
    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
        $this->Tabla = "qscmixl6_participacion";
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
        $Participacion = $this->extraer(\PDO::FETCH_ASSOC);
        $this->IdBillioon = $this->iterarColumna($Participacion, "id_billioon");
        $this->Participacion = $this->iterarColumna($Participacion, "participacion");
        $this->IdUsuario = $this->iterarColumna($Participacion, "id_usuario");
        $this->Estado = $this->iterarColumna($Participacion, "estado");
    }
    
    public function actualizar($ColBusqueda, $ValorBusqueda)
    {
        if($this->IdBillioon)
        {
            $columna[] = "id_billioon='".$this->IdBillioon."'";
        }
        if($this->Participacion)
        {
            $columna[] = "participacion='".$this->Participacion."'";
        }
        if($this->IdUsuario)
        {
            $columna[] = "id_usuario='".$this->IdUsuario."'";
        }
        if($this->Estado)
        {
            $columna[] = "estado='".$this->Estado."'";
        }
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->recargar($columna, $this->Tabla);
    }
    
    public function insertar()
    {
        $valores = array("'$this->IdBillioon'","$this->Participacion","$this->IdUsuario","$this->Estado");
        $columnas = array("id_billioon","participacion","id_usuario","estado");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function obtenerIdBillioon()
    {
        return $this->IdBillioon;
    }
    
    public function establecerIdBillioon($idbillioon)
    {
        $this->IdBillioon = $idbillioon;
    }
    public function obtenerParticipacion()
    {
        return $this->Participacion;
    }

    public function establecerParticipacion($participacion)
    {
        $this->Participacion = $participacion;
    }
    
    public function obtenerIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function establecerIdUsuario($idusuario)
    {
        $this->IdUsuario = $idusuario;
    }
    
    public function obtenerEstado()
    {
        return $this->Estado;
    }
    
    public function establecerEstado($estado)
    {
        $this->Estado = $estado;
    }
}