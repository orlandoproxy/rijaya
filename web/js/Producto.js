var valor=1;
function AgregarProducto()
{
	valor = valor+1;
	var nuevoproducto = document.createElement("tr");
	nuevoproducto.id= "idtr_"+(valor);
	nuevoproducto.innerHTML=
	"<td>"
	+"<input type='text' class='form-control' name='nomproducto"+valor+"' placeholder='Nombre Producto'>"
	+"</td>"
	+"<td>"
	+"<input type='text' class='form-control' name='precioproducto_"+valor+"' placeholder='###.##'>"
	+"</td>"
	+"<td>"
	+"<input type='text' class='form-control' name='cantidadproducto_"+valor+"' placeholder='Cantidad'>"
	+"</td>"
	+"<td>"
	+"<input type='file' class='form-control' name='file_"+valor+"' >"
	+"</td>"
	+"<td>"
	+"<a class='btn btn-success' href='JavaScript:GuardarProducto("+valor+");'  >Guardar</a>"
	+"</td>"
	+"<td>"
	+"<a class='btn btn-warning' href='JavaScript:EliminarProducto("+valor+");'  >Eliminar</a>"
	+"</td>";

	var contenedor = document.getElementById("cuerpo");
	contenedor.appendChild(nuevoproducto);

}
function GuardarProducto()
{

}

function EliminarProducto(id)
{
	var eliminar = document.getElementById("idtr_"+id);
	var contenedor = document.getElementById("cuerpo");
	contenedor.removeChild(eliminar);

}