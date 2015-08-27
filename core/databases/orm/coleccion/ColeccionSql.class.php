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
require_once 'Consulta.class.php';
require_once 'Actualizacion.class.php';
require_once 'Insercion.class.php';
require_once __DIR__.'/../../Proxy.class.php';

class ColeccionSql
{
    use Consulta;
    use Actualizacion;
    use Insercion;

    private $Conexion;

    public function __construct()
    {
        $Proxy = new Proxy();
        $this->Conexion = $Proxy->conexionSql();
    }

    public function iterarColumna($arreglo, $columna)
    {
        if(count($arreglo)>1)
        {
            for($i=0; $i<count($arreglo); $i++)
            {
                if(isset($arreglo[$i][$columna]))
                {
                    $resultado[$i]=$arreglo[$i][$columna];
                }
                else
                {
                    $resultado[$i]=NULL;
                }
            }
        }
        else
        {
            if(isset($arreglo[0][$columna]))
            {
                $resultado=$arreglo[0][$columna];
            }
            else
            {
                $resultado=NULL;
            }
        }
        return $resultado;
    }

    private function tratandoColumnas(array $Columnas)
    {
        if(is_array($Columnas))
        {
            $Columna = null;
            foreach($Columnas as $Celda)
            {
                $Columna .= " ,".$Celda;
            }

            $Columna = substr($Columna, 2);
            return $Columna;
        }
}

    public function mientras($ColBusqueda, $ValorBusqueda)
    {
        if(!($ColBusqueda || $ValorBusqueda))
        {
            $this->Mientras = "";
            return;
        }

        $tmpMientras = "$ColBusqueda = :$ColBusqueda";
        $this->PHMientras = array(":$ColBusqueda" => "$ValorBusqueda");
        $this->Mientras = " WHERE " . $tmpMientras;
    }
}
