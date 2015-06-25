function Lector(key)
{
	var url = 'clases/RegistrarTerminal.php';
    var lectura = $('#codigo').val();
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
								$('#mensaje').addClass('error').html('Clave no valida').show(300).delay(3000).hide(300);
								return false;
							}
							else if (valor== 2)
								{
									alert("la terminal esta desactivada, porfavor comuniquese con su jefe de prouccion");
								}
							else if (valor == 3) 
								{
									
									document.location.href = '../Operadores/index.php';
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