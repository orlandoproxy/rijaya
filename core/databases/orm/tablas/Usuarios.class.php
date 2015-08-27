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

class Usuarios extends ColeccionSql
{
    private $IdUsuario;
    private $Usuario;
    private $Password;
    private $Activador;
    private $NumSuc;

    public function __construct($ColBusqueda = FALSE, $ValorBusqueda = FALSE, $Columna = array("*"), $Limite = 1)
    {
        parent::__construct();
        $this->Tabla = "usuarios";
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
        $Usuario = $this->extraer(PDO::FETCH_ASSOC);
        $this->IdUsuario = $this->iterarColumna($Usuario, "id_usuario");
        $this->Usuario = $this->iterarColumna($Usuario, "usuario");
        $this->Password = $this->iterarColumna($Usuario, "password");
        $this->Activador = $this->iterarColumna($Usuario, "activador");
        $this->NumSuc = $this->iterarColumna($Usuario, "numsuc");
    }

    public function actualizar($colBusqueda, $valorBusqueda)
    {
            if($this->IdUsuario)
            {
                $columna[] = "id_usuario='$this->IdUsuario'";
            }
            if($this->Usuario)
            {
                $columna[] = "usuario='$this->Usuario'";
            }
            if($this->Password)
            {
                $columna[] = "password='$this->Password'";
            }
            if($this->Activador)
            {
                $columna[] = "activador='$this->Activador'";
            }
            if($this->NumSuc)
            {
                $columna[] = "numsuc='$this->NumSuc'";
            }
            $this->mientras($colBusqueda, $valorBusqueda);
            $this->recargar($columna, $this->Tabla);
    }

    public function insertar()
    {
        $valores = array("'$this->Codigo'","'$this->Mac'");
        $columnas = array("usuario", "password", "activador", "numsuc");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function obtenerIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function obtenerUsuario()
    {
        return $this->Usuario;
    }

    public function establecerUsuario($usuario)
    {
        $this->Usuario = $usuario;
    }

    public function obtenerPassword()
    {
        return $this->Password;
    }

    public function establecerPassword($password)
    {
        $this->Password = $password;
    }

    public function obtenerActivador()
    {
        return $this->Password;
    }

    public function establecerActivador($password)
    {
        $this->Password = $password;
    }

    public function obtenerNumSuc()
    {
        return $this->NumSuc;
    }

    public function establecerNumSuc($numsuc)
    {
        $this->NumSuc = $numsuc;
    }
}
