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
  var tr=tr;
  var tipo = tipo;
  var proceso=proceso;
  var idtabla=id;
  var idtable=tipo+'_'+proceso+'_'+idtabla;
  var contenedor = document.getElementById(idtable);
  var fila = document.getElementById(tr);
  //contenedor.removeChild(fila);
  alert(idtable);
  alert(tr);
}
