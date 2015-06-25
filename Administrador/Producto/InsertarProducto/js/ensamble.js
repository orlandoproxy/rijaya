var campo=1;
var init=1;
function AgregarEnsamble()
{
	campo = campo+1;
	var nuevoensamble= document.createElement("tr");
	nuevoensamble.id="idensam_"+(campo);
	nuevoensamble.innerHTML=
	"<td>"
	+"<table>"
	+"<tr>"
	+"<td>"
	+"<input type='text' class='form-control' name='cantidad_"+campo+"' placeholder='Cantidad' >"
	+"</td>"
	+"<td>"
	+"<input type='text' class='form-control' name='nombreensamble_"+campo+"' placeholder='Nombre Subensamble' required>"
	+"</td>"
	+"<td>"
	+"<a class='btn btn-warning' href='javascript:EliminarEnsamble("+campo+")'>Borrar Subensamble</a>"
	+"</td>"
	+"</tr>"
	+"<tr>"
	+"<td>"
	+"<label class='form-control'>Procesos de Armado</label>"
	+"</td>"
	+"<td>"
	+"<input type='checkbox' class='checkbox-inline' name='proceso_"+campo+"[]' value='5'> Punteado"
	+"<input type='checkbox' class='checkbox-inline' name='proceso_"+campo+"[]' value='6'> Soldadura Mig"
	+"<input type='checkbox' class='checkbox-inline' name='proceso_"+campo+"[]' value='7'>Lavado Sacudido"
	+"<input type='checkbox' class='checkbox-inline' name='proceso_"+campo+"[]' value='8'>Pintura"
	+"<input type='checkbox' class='checkbox-inline' name='proceso_"+campo+"[]' value='9'>Terminado"
	+"</td>"
	+"<td>"
	+"<a class='btn btn-primary' href='javascript:AgegarPieza("+campo+")'>Agregar Piezas</a>"
	+"</td>"
	+"</tr>"
	+"</table>"
	+"</td>";

	var contenido=document.getElementById("contenedor");
	contenido.appendChild(nuevoensamble);

	var nuevoensamble2= document.createElement("table");
	nuevoensamble2.id="idsubpieza_"+(campo);
	nuevoensamble2.innerHTML=
	"";
	var contenido2=document.getElementById("contenedor");
	contenido2.appendChild(nuevoensamble2);
}
function EliminarEnsamble(ide)
{
	var eliminar = document.getElementById("idensam_"+ide);
	var contenedor = document.getElementById("contenedor");
	contenedor.removeChild(eliminar);
	var eliminar2 = document.getElementById("idsubpieza_"+ide);
	var contenedor2 = document.getElementById("contenedor");
	contenedor2.removeChild(eliminar2);
}

function AgegarPieza(ref)
{
	init = init+1;
	var refsub = ref;	
	var nuevapieza = document.createElement("tr");
	nuevapieza.id="idpieza_"+(ref)+"sub_"+(init);
	nuevapieza.innerHTML=
	"<td>"
	+"<label class='form-control'>Nombre Pieza</label>"
	+"</td>"
	+"<td>"
	+"<select name='ref_"+ref+"[]' class='form-control' id='ref_"+ref+"sub_"+init+"'>"
	+"</select>"
	+"</td>";
	var conte=document.getElementById("idsubpieza_"+ref);
	conte.appendChild(nuevapieza);
	var load= "ref_"+(ref)+"sub_"+(init);
	$("#"+load).load("MostrarPieza.php");
}