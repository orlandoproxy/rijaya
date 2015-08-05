function AgregarManual()
{
		var usu = $('#usuario').val();
		var pass = $('#pass').val();
		var url = './clases/ProcesoAutentificacion.php';
		var total = usu.length * pass.length;
		if (total>0){
			$.ajax({
				type: 'POST',
					url: url,
					data: 'usu='+usu+'&pass='+pass,
					success: function(valor)
					{
						if (valor == 1) 
							{
								$('#mensaje').addClass('error').html('El usuario ingresado no existe o fue dado de baja en el sistema').show(300).delay(3000).hide(300);
								return false;
							}
							else if (valor== 2)
								{
									$('#mensaje').addClass('error').html('La Contraseña es Incorrecta').show(300).delay(3000).hide(300);
									return false;
								}
							else if (valor == 3) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Administrador/index.php';
									return false;
								}
							else if (valor == 4) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'JefeProduc/index.php';
									return false;
								}
							else if (valor == 5) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Contador/index.php';
									return false;
								}
							else if (valor == 6) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Vendedor/index.php';
									return false;
								}
							else if (valor == 7) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Operadores/index.php';
									return false;
								}
								$('#lector').val("");
					}
			});
			return false;

		}
		else
		{
			$('#mensaje').addClass('error').html('Complete todos los campos').show(300).delay(3000).hide(300);
		}
		$('#lector').val("");
}

function Lector(key)
{
	var url = './clases/ProcesoAutentificacion.php';
    var lectura = $('#lector').val();
    var unicode
    if (key.charCode)
    {unicode=key.charCode;}
    else
    {unicode=key.keyCode;}
    //alert(unicode); // Para saber que codigo de tecla presiono , descomentar
    
    if (unicode == 13)
    {
        //alert(lectura);
        if (lectura.length>0) 
        {
        	$.ajax(
        		{
        			type: 'POST',
        			url: url,
        			data: 'escaneo='+lectura,
        			success: function(valor)
					{
						if (valor == 1) 
							{
								$('#mensaje').addClass('error').html('El usuario ingresado no existe').show(300).delay(3000).hide(300);
								return false;
							}
							else if (valor== 2)
								{
									$('#mensaje').addClass('error').html('La Contraseña es Incorrecta').show(300).delay(3000).hide(300);
									return false;
								}
							else if (valor == 3) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Administrador/index.php';
									return false;
								}
							else if (valor == 4) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'JefeProduc/index.php';
									return false;
								}
							else if (valor == 5) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Contador/index.php';
									return false;
								}
							else if (valor == 6) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Vendedor/index.php';
									return false;
								}
							else if (valor == 7) 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Operadores/index.php';
									return false;
								}
							else if (valor == 0) 
								{
									$('#mensaje').addClass('error').html('Codigo Incorecto').show(300).delay(3000).hide(300);
									return false;
								}
					}
        		});
        	return false;
        }
        else
        {
        	$('#mensaje').addClass('error').html('Escane un codigo valido').show(300).delay(3000).hide(300);
        }

    }
}

function Automatico()
{
	document.getElementById('tipo').innerHTML = 
	"<input type='text' id='lector' class='form-control' onkeypress='Lector(event);' placeholder='Escane su codigo' required='' autofocus=''>";
}
function Manual()
{
	document.getElementById('tipo').innerHTML = 
	"<input type='text' id='usuario' class='form-control' placeholder='Usuario' required='' autofocus=''>"
	+" <input type='password' id='pass' class='form-control' placeholder='Contraseña' required=''>"
	+" <a class='btn btn-lg btn-primary btn-block'  id='ingresar' href='JavaScript:AgregarManual();'>Ingresar </a>";
}
	
