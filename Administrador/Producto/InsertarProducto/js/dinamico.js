var campo = 1;
function AgregarCampo()
{
	campo = campo+1;
	var NuevoCampo = document.createElement("tr");
	NuevoCampo.id = "idtr_"+(campo);
	NuevoCampo.innerHTML=
		"<td>"
			+"<input type='text' class='form-control'  name='Cantidad_"+campo+"' id='cantidad_"+campo+"' placeholder='Cantidad' required>"
		+"</td>"
		+"<td>"
			+"<input type='text' class='form-control' name='NombrePieza_"+campo+"' id='nombrepieza_'"+campo+" placeholder='Nombre Pieza' required >"
		+"</td>"
		+"<td>"
			+"<div class='form'>"
				+"<input type='text' class='form-control'  name='Medida1_"+campo+"' id='medida1_"+campo+"' placeholder='Medida1' required>"
				+"<input type='text' class='form-control'  name='Medida2_"+campo+"' id='medida2_"+campo+"' placeholder='Medida2' required>"
				+"<input type='text' class='form-control'  name='Medida3_"+campo+"' id='medida3_"+campo+"' placeholder='Medida3' required>"	
			+"</div>"					
		+"</td>"
		+"<td>"
			+"<input type='checkbox' class='checkbox-inline' name='Proceso"+campo+"[]' value=Corte id='corte_"+campo+"'>Corte, "
			+"<input type='checkbox' class='checkbox-inline' name='Proceso"+campo+"[]' value='Troquelado' id='Troquelado_"+campo+"'>Troquelado, "
			+"<input type='checkbox' class='checkbox-inline' name='Proceso"+campo+"[]' value='Gramilado' id='gramilado_"+campo+"'>Gramilado, "
			+"<input type='checkbox' class='checkbox-inline' name='Proceso"+campo+"[]' value='Doblado' id='dobaldo_"+campo+"'>Doblado, "
		+"</td>"
		+"<td>"
			+"<input type='text' class='form-control' name='Material_"+campo+"' id='material_"+campo+"' >"
		+"</td>"
		+"<td>"
			+"<a class='btn btn-warning' href='JavaScript:quitarCampo("+campo+");'>Eliminar</a>"
		+"</td>";


		var contenedor=document.getElementById("Contenido");
		contenedor.appendChild(NuevoCampo);
	}
	function quitarCampo(idtr)
	{
		var eliminar = document.getElementById("idtr_"+idtr);
		var contenedor= document.getElementById("Contenido");
		contenedor.removeChild(eliminar);
	}
	function Carga()
	{
		
	}