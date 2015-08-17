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
    private $Nombre;

    public function __construct($ColBusqueda = false, $ValorBusqueda = false)
    {
        parent::__construct();
        $this->Tabla = "usuarios";
        if($ColBusqueda && $ValorBusqueda)
        {
            $this->establecer($ColBusqueda, $ValorBusqueda);
        }
    }

    public function establecer($ColBusqueda, $ValorBusqueda)
    {
        $Columnas = array("*");
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->limite("1");
        $this->consultar($Columnas, $this->Tabla);
        $Usuarios = $this->extraer(PDO::FETCH_ASSOC);
        $this->IdUsuario = $this->iterarColumna($Usuarios, "id_usuario");
        $this->Usuario = $this->iterarColumna($Usuarios, "usuarios");
        $this->Password = $this->iterarColumna($Usuarios, "password");
        $this->Nombre = $this->iterarColumna($Usuarios, "nombre");
    }

    public function actualizar($ColBusqueda, $ValorBusqueda)
    {
        if($this->IdUsuario)
        {
            $columna[] = "id_usuario='".$this->IdUsuario."'";
        }
        if($this->Usuario)
        {
            $columna[] = "usuario='".$this->Usuario."'";
        }
        if($this->Password)
        {
            $columna[] = "password='".$this->Password."'";
        }
        if($this->Nombre)
        {
            $columna[] = "nombre='".$this->Nombre."'";
        }
        $this->mientras($ColBusqueda, $ValorBusqueda);
        $this->recargar($columna, $this->Tabla);
    }

    public function insertar()
    {
        $valores = array("'$this->Usuario'","'$this->Password'","'$this->Nombre'");
        $columnas = array("usuario","password","nombre");
        $this->cargar($columnas, $valores, $this->Tabla);
    }

    public function establecerIdUsuario($idusuario)
    {
        $this->IdUsuario = $idusuario;
    }

    public function mostrarUsuario()
    {
            return $this->Usuario;
    }

    public function establecerUsuario($usuario)
    {
        $this->Usuario = $usuario;
    }

    public function mostrarPassword()
    {
            return $this->Password;
    }

    public function establecerPassword($password)
    {
        $this->Password = $password;
    }

    public function mostrarNombre()
    {
            return $this->Nombre;
    }

    public function establecerNombre($nombre)
    {
        $this->Nombre = $nombre;
    }
}
