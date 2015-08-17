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

trait Consulta
{
    protected $Mientras;
    protected $Limite;
    protected $Consulta;
    protected $PHMientras;

    public function __construct()
    {
        $this->PHMientras = array();
    }

    public function consultar(array $Columnas, $Tabla)
    {
        $CadenaColumnas = $this->tratandoColumnas($Columnas);
        $queryString =  "SELECT ".$CadenaColumnas.
                        " FROM ".$Tabla
                        .$this->Mientras . " LIMIT "
                        .$this->Limite;
        $this->Consulta = $this->Conexion->prepare($queryString);
        $this->Consulta->execute($this->PHMientras);
    }

    public function extraer($Fetch)
    {
        return $this->Consulta->fetchAll($Fetch);
    }

    public function limite($Limite)
    {
        $this->Limite = $Limite;
    }
}
