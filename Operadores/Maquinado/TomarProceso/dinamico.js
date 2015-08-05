
function Formulario()
{
	document.getElementById('formulario').innerHTML =
	"<label for='fechaini'>Fecha Inicio</label> "
	+"<input type='date' id='fechaini' class='form-control' readonly='readonly'>"
	+"<label for='hora'>Hora actual</label>"
	+"<input type='time' id='hora' class='form-control'>"
	+"<a class='btn btn-primary' href='JavaScript:Guardar();'>Guardar</a>";
	document.getElementById('fechaini').valueAsDate = new Date();
	var d = new Date();
	var tz = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	document.getElementById('hora').value=tz;
}
var valor;
var campo=0;
var lista =new Array();
function Ayudante()
{
	var nuevoayudante=document.createElement("tr");
	nuevoayudante.id="idayu_"+(campo);
	nuevoayudante.innerHTML=
	"<td>"
	+"<select class='form-control' id='pos_"+campo+"'></select>"
	+"</td>";
	var contenedor=document.getElementById("ayudante");
	contenedor.appendChild(nuevoayudante);
	var load="pos_"+(campo);
	$("#"+load).load("ayudantes.php");
    campo=campo+1;

}
function Guardar()
{
	var url = 'TomaProceso.php';
	lista.length=0;
	var fecha = $('#fechaini').val();
	var hora= $('#hora').val();
	for (var i = 0; i < campo; i++) 
	{
		valor=$('#pos_'+i).val();
		lista.push(valor);

	};
	$.ajax(
	{
		type: 'POST',
		url: url,
		data:'fecha='+fecha+" "+hora+"&ayudantes="+lista,
		success: function(data)
		{
		}
	});
	document.location.reload();
}
function Merma()
{
	var proceso=$('#proceso').val();
	var lista=$('#maquinado').val();
	var cantidad = $('#cantidadm').val();
	var url='historial.php';
	if(cantidad<=0)
	{
		alert("escriba un numero mayor a cero");
	}
	else
	{
		if (cantidad % 1==0) 
			{
				$.ajax(
					{
						type: 'POST',
						url: url,
						data:'cantidad='+cantidad+'&tipo=1'+'&proceso='+proceso+'&lista='+lista,
						success: function(data)
						{

						}
					});
			}
			else
			{
				alert("no es entero");
			}
	}
	document.location.reload();
}
function EliminarMerma(id)
{
	var idm = id;
	var url='historial.php';
	$.ajax(
		{
			type: 'POST',
			url: url,
			data:'idmerma='+idm+'&tipo=2',
			success: function(data)
			{
				document.location.reload();
			}
		});
}
function ActualizarProceso(datas)
{
	var d = new Date();
	var tz = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	var id=datas;
	var caja=$('#cantidad_'+id).val();
	var url='historial.php';
	$.ajax(
		{
			type:'POST',
			url: url,
			data:'tipo=3&idpro='+id+'&cantidad='+caja+'&fecha='+tz,
			success: function(datos)
			{
				document.location.reload();
			}
		});
	
}