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

class Telefonos extends ColeccionSql
{
    private $IdUsuario;
    private $NumeroTelefonico;

    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
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
        $this->consultar($Columnas, "qscmixl6_telefonos");
        $Telefono = $this->extraer(\PDO::FETCH_ASSOC);
        $this->IdUsuario = $this->iterarColumna($Telefono, "id_usuario");
        $this->NumeroTelefonico = $this->iterarColumna($Telefono, "numero_telefonico");

    }
    
    public function actualizar($ColBusqueda, $ValorBusqueda)
    {
        $con = 0;
        if($this->IdUsuario)
        {
            $columna[$con] = "id_usuario='".$this->IdUsuario."'";
            $con++;
        }
        if($this->Participacion)
        {
            $columna[$con] = "numero_telefonico='".$this->NumeroTelefonico."'";
            $con++;
        }
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->recargar($columna, $this->Tabla);
    }
    
    public function insertar()
    {
        $valores = array("'$this->IdUsuario'","$this->NumeroTelefonico");
        $columnas = array("id_usuario","numero_telefonico");
        $this->cargar($columnas, $valores, $this->Tabla);
    }
    
    public function obtenerIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function obtenerNumeroTelefonico()
    {
        return $this->NumeroTelefonico;
    }
    
    public function establecerIdUsuario($idusuario)
    {
        $this->IdUsuario = $idusuario;
    }
    
    public function establecerNumeroTelefonico($numeroTelefonico)
    {
        $this->NumeroTelefonico = $numeroTelefonico;
    }
}
