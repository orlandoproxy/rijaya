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

require_once 'Interfaz.class.php';

final class ConexionBD extends Interfaz
{
    private static $Instancia;
    private static $Anfitrion;
    private static $Clave;
    private static $Usuario;
    private static $BaseDeDatos;
    private static $GestorDeBaseDeDatos;
    private static $Puerto;

    private function __construct()
    {
        self::$Instancia = null;
        self::$Anfitrion = "127.0.0.1";
        self::$Usuario = "root";
        self::$Clave = "6a6f7063";
        self::$BaseDeDatos = "pdv";
        self::$GestorDeBaseDeDatos = "mysql";
        self::$Puerto = "10060";
    }

   public static function obtenerInstancia()
    {
        if(!self::$Instancia instanceof self)
        {
            self::$Instancia = new self;
        }
        return self::$Instancia;
    }

    protected function conexionSql()
    {
        $Cadena = $this->fabricarCadena();
        try
        {
            $Conexion = new PDO
            (
                $Cadena,
                self::$Usuario,
                self::$Clave,
                array
                (
                    PDO::ATTR_PERSISTENT => true
                )
            );
            $Conexion->setAttribute
            (
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            return $Conexion;
        }
        catch (PDOException $E)
        {
            echo "No se pudo conectar: " . $E->getMessage();

        }
    }

    private function fabricarCadena()
    {
        switch (self::$GestorDeBaseDeDatos)
        {
            case "sqlite":
                $Cadena = self::$GestordeBaseDeDatos.":".self::$BaseDeDatos;
                break;

            case "mysql":
                $Cadena = self::$GestorDeBaseDeDatos.":host=".self::$Anfitrion.
                          ";dbname=".self::$BaseDeDatos;
                break;

            case "dblib":
                $Cadena = self::$GestorDeBaseDeDatos.
                          ":host=".self::$Anfitrion.":".self::$Puerto.
                          ";dbname=".self::$BaseDeDatos;
                break;

            case "pgsql":
                $Cadena = self::$GestorDeBaseDeDatos.
                          ":host=".self::$Anfitrion.
                          ";port=".self::$Puerto.
                          ";dbname=".self::$BaseDeDatos.
                          ";user=".self::$Usuario.
                          ";password=".self::$Clave;
                break;

            case "":
                $Cadena = self::$GestorDeBaseDeDatos.
                          ";dbname=".self::$Anfitrion."/".self::$BaseDeDatos;
                break;

            default:
                return false;
        }

        return $Cadena;
    }

    public function __clone()
    {
        trigger_error("No puedes crear otro objeto", E_USER_ERROR);
    }
    public function __wakeup()
    {
        trigger_error("No puedes crear otro objeto", E_USER_ERROR);
    }

}
