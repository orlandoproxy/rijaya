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

class Empleados extends ColeccionSql
{
    private $IdEmpleado;
    private $Nombre;
    private $Apellido;
    private $Direccion;
    private $Cargo;
    private $Codigo;
    private $IdSucursal;

    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
        $this->Tabla = "empleados";
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
        $Empleado = $this->extraer(PDO::FETCH_ASSOC);
        $this->IdEmpleado = $this->iterarColumna($Empleado, "id_empleado");
        $this->Nombre = $this->iterarColumna($Empleado, "nombre");
        $this->Apellido = $this->iterarColumna($Empleado, "apellido");
        $this->Direccion = $this->iterarColumna($Empleado, "direccion");
        $this->Cargo = $this->iterarColumna($Empleado, "cargo");
        $this->Codigo = $this->iterarColumna($Empleado, "codigo");
        $this->IdSucursal = $this->iterarColumna($Empleado, "id_sucursal");
    }

    public function actualizar($colBusqueda, $valorBusqueda)
    {
            if($this->IdEmpleado)
            {
                $columna[] = "id_empleado='$this->IdEmpleado'";
            }
            if($this->Nombre)
            {
                $columna[] = "nombre='$this->Nombre'";
            }
            if($this->Apellido)
            {
                $columna[] = "apellido='$this->Apellido'";
            }
            if($this->Direccion)
            {
                $columna[] = "direccion='$this->Direccion'";
            }
            if($this->Cargo)
            {
                $columna[] = "cargo='$this->Cargo'";
            }
            if($this->Codigo)
            {
                $columna[] = "codigo='$this->Codigo'";
            }
            if($this->IdSucursal)
            {
                $columna[] = "id_sucursal='$this->IdSucursal'";
            }
            $this->mientras($colBusqueda, $valorBusqueda);
            $this->recargar($columna, $this->Tabla);
    }

    public function insertar()
    {
        $valores = array("'$this->Codigo'","'$this->Mac'");
        $columnas = array("nombre", "apellido", "direccion", "cargo", "codigo", "id_sucursal");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function obtenerIdEmpleado()
    {
        return $this->IdEmpleado;
    }

    public function obtenerNombre()
    {
        return $this->Nombre;
    }

    public function establecerNombre($nombre)
    {
        $this->Nombre = $nombre;
    }

    public function obtenerApellido()
    {
        return $this->Apellido;
    }

    public function establecerApellido($apellido)
    {
        $this->Apellido = $apellido;
    }

    public function obtenerDireccion()
    {
        return $this->Direccion;
    }

    public function establecerDireccion($direccion)
    {
        $this->Direccion = $direccion;
    }

    public function obtenerCargo()
    {
        return $this->Cargo;
    }

    public function establecerCargo($cargo)
    {
        $this->Cargo = $cargo;
    }

    public function obtenerCodigo()
    {
        return $this->Codigo;
    }

    public function establecerCodigo($cargo)
    {
        $this->Cargo = $cargo;
    }

    public function obtenerIdSucursal()
    {
        return $this->Cargo;
    }

    public function establecerIdSucursal($idsucursal)
    {
        $this->IdSucursal = $idsucursal;
    }
}
