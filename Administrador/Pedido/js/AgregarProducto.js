var contador=1;
function AgregarProducto()
{
	contador=contador+1;
	var NuevoProducto = document.createElement("tr");
	NuevoProducto.id="idtr"+(contador);
	NuevoProducto.innerHTML=
	"<td width='40'>"
	+"<input type='text' class='form-control' name='cantidad_"+contador+"' required>"
	+"</td>"
	+"<td width='130'>"
	+"<select class='form-control' id='tipo_"+contador+"'>"
	+"<option >Linea</option>"
	+"<option >Especial</option>"
	+"<option >Prototipo</option>"
	+"</select>"
	+"</td>"
	+"<td width='180'>"
	+"<input type='text' class='form-control' id='clave_"+contador+"' onkeyup='loadXMLDoc("+contador+")' required>"
	+"</td>"
	+"<td>"
	+"<select class='form-control' name='Nombre_"+contador+"' id='nombre_"+contador+"'></select>"
	+"</td>"
	+"<td>"
	+"<select class='form-control' name='Color_"+contador+"' id='color_"+contador+"'>"
	+"<option value=1>ALUMINIO �</option><option value=2>AZUL RAL-5002</option><option value=3>BLANCO OSTION</option><option value=4>CREMA</option><option value=5>AMARILLO TRAFICO�</option><option value=6>GRIS TROPICAL</option><option value=7>NEGRO SEMIMATE</option><option value=8>GRIS CALIDO�</option><option value=9>GRIS RIJAYA</option><option value=10>GRIS MARTILLADO�</option><option value=11>AZUL INDIGO</option><option value=12>ROJO�</option><option value=13>NARANJA�</option><option value=14>BLANCO NATURAL</option><option value=15>POLVO ASA 70 GRAY 12715�</option><option value=16>EN POLVO B12 WHITE 22479</option>"
	+"</select>"
	+"</td>"
	+"<td>"
	+"<input type='text' class='form-control' name='Descripcion_"+contador+"' id='descripcion_"+contador+"' required>"
	+"</td>"
	+"<td>"
	+"<a class='btn btn-warning' href='JavaScript:Quitar("+contador+");'>Eliminar</a>"
	+"</td>";
	var contenedor=document.getElementById("contenedor");
	contenedor.appendChild(NuevoProducto);
	
	//alert(load);	
}

function Quitar(idtr)
{
	var eliminar = document.getElementById("idtr"+idtr);
	var contenedor = document.getElementById("contenedor");
	contenedor.removeChild(eliminar);
}
//busqueda
function loadPedido()
{
var xmlhttp;

var n=document.getElementById('Pedido').value;

if(n==''){
document.getElementById("cont").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("cont").innerHTML=xmlhttp.responseText;

}
}
xmlhttp.open("POST","ProcesoPedido.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+n);
}