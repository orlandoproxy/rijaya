<?php
class Filtrador
{
    protected function __construct(){}
    
    protected function filtrarVariable($valor)
    {
        $valor = str_ireplace("SELECT","",$valor);
	$valor = str_ireplace("COPY","",$valor);
	$valor = str_ireplace("DELETE","",$valor);
	$valor = str_ireplace("DROP","",$valor);
	$valor = str_ireplace("DUMP","",$valor);
	$valor = str_ireplace(" OR ","",$valor);
	$valor = str_ireplace("%","",$valor);
	$valor = str_ireplace("LIKE","",$valor);
	$valor = str_ireplace("--","",$valor);
	$valor = str_ireplace("^","",$valor);
	$valor = str_ireplace("[","",$valor);
	$valor = str_ireplace("]","",$valor);
	$valor = str_ireplace("!","",$valor);
	$valor = str_ireplace("¡","",$valor);
	$valor = str_ireplace("?","",$valor);
	$valor = str_ireplace("=","",$valor);
	$valor = str_ireplace("&","",$valor);
        $valor = str_ireplace("'","",$valor);
        $valor = str_ireplace("<","",$valor);
        $valor = str_ireplace(">","",$valor);
        $valor = str_ireplace("{","",$valor);
        $valor = str_ireplace("}","",$valor);
        $valor = str_ireplace("¿","",$valor);
        $valor = str_ireplace(":","",$valor);
        $valor = str_ireplace("*","",$valor);
        $valor = str_ireplace("UNION","",$valor);
        $valor = str_ireplace("SCRIPT","",$valor);
        $valor = addslashes($valor);
	return $valor;
    }
    protected function limitarCadena($cadena, $min, $max)
    {
        if(strlen($cadena)>=$min && strlen($cadena)<=$max)
        {
            return $cadena;
        }
        else
        {
            return " ";
        }
    }
}
?>

