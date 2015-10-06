$(document).ready(function(){
   $("#lista").change(function () {
           $("#lista option:selected").each(function () {
            elegido=$(this).val();
            $.post("clases/proceso.php", { elegido: elegido }, function(data){
            $("#contenido").html(data);
            });
        });
   })
});
function Ensamble(id)
{

  var id=id;
  var url = 'clases/operaciones.php';
  $.ajax({
    type: 'POST',
    url: url,
    data:'id='+id,
    success: function(data)
    {
      var conte = document.getElementById("tiempos");
      conte.innerHTML="";

      var contenido = document.createElement("div");
      contenido.id="1";
      contenido.innerHTML=data;
      var contenedor = document.getElementById("tiempos");
      contenedor.appendChild(contenido);
      //alert(data);
    }
  });
}




function Tiempos(maquinado,estatus)
{
      //fecha
    var fecha = new Date();
    var anio=fecha.getFullYear();
    var mes = fecha.getMonth()+1;
    var dia = fecha.getDate();
    var Hora = fecha.getHours();
    var minuto= fecha.getMinutes();
    var segundo = fecha.getSeconds();
    var fechaactual=anio+'-'+mes+'-'+dia+' '+Hora+':'+minuto+':'+segundo;
    //alert(fechaactual);

      //variables
      var idmaquinado=maquinado;
      //alert(idmaquinado);
      var estatus=estatus;
      var lista = new Array();
      //recorremos el Array4
      $('input[name="rol[]"]:checked').each(function() {
      	//$(this).val() es el valor del checkbox correspondiente
      	lista.push($(this).val());
      });

    //alert(lista.length);
    if (lista.length>0)
    {
      $.ajax({
        type: 'POST',
        url: 'clases/tiempos.php',
        data: 'idmaquinado='+idmaquinado+'&estatus='+estatus+'&operadores='+lista+'&fecha='+fechaactual,
      success: function(datos)
      {

      }

      });
      document.getElementById("Inicio").disabled = true;
      document.getElementById("Pausa").disabled = false;
      document.getElementById("Finalizar").disabled = false;

    }
    else
    {
      alert("Selecciona a un Operador");
    }
}

//////////////////////------------------------------
function Pausa(id)
{
  var idmaquinado=id;
  //fecha
  var fecha = new Date();
  var anio=fecha.getFullYear();
  var mes = fecha.getMonth()+1;
  var dia = fecha.getDate();
  var Hora = fecha.getHours();
  var minuto= fecha.getMinutes();
  var segundo = fecha.getSeconds();
  var fechaactual=anio+'-'+mes+'-'+dia+' '+Hora+':'+minuto+':'+segundo;
  $.ajax({
    type: 'POST',
    url: 'clases/tiempos.php',
    data: 'idmaquinado='+idmaquinado+'&estatus=2&operadores='+lista+'&fecha='+fechaactual,
  success: function(datos)
  {
  }
  });

}
///////////////////////////////////////////////**************************
function Finalizar(id)
{
  var idmaquinado=id;
  //fecha
  var fecha = new Date();
  var anio=fecha.getFullYear();
  var mes = fecha.getMonth()+1;
  var dia = fecha.getDate();
  var Hora = fecha.getHours();
  var minuto= fecha.getMinutes();
  var segundo = fecha.getSeconds();
  var fechaactual=anio+'-'+mes+'-'+dia+' '+Hora+':'+minuto+':'+segundo;
  $.ajax({
    type: 'POST',
    url: 'clases/tiempos.php',
    data: 'idmaquinado='+idmaquinado+'&estatus=3&operadores='+lista+'&fecha='+fechaactual,
  success: function(datos)
  {
  }
  });
}
