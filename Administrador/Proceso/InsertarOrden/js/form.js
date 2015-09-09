function EliminarTabla(tipo,proceso,id)
{
var tipo = tipo;
var proceso=proceso;
var idtabla=id;
var idtable=tipo+'_'+proceso+'_'+idtabla;
var eliminar = document.getElementById(idtable);
var contenedor = document.getElementById("contenedor");
contenedor.removeChild(eliminar);
}

function EliminarFila(tipo,proceso,id,tr)
{
var tipo = tipo;
var proceso=proceso;
var idtabla=id;
var idtable = tipo+'_'+proceso+'_'+idtabla;
var i = tr.parentNode.parentNode.rowIndex;
document.getElementById(idtable).deleteRow(i);
}
