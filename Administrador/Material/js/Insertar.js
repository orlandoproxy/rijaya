$(function(){
	$('#ingresar').on('click',function()
		{
			var clave = $('#Clave').val();
			var nombre = $('#Nombre').val();
			var catego = $('#Categoria').val();
			var url = '../InsertarMaterial/ProcesoInsertar.php';
			var total = clave.length * nombre.length;
			if(total>0)
			{
				$.ajax(
					{
						type: 'POST',
						url:url,
						data: 'clave='+clave+'&nombre='+nombre+'&catego='+catego,
						success: function(material)
						{
							if (material == 1) 
								{
									$('#alerta').addClass('alert alert-warning').html('la clave ya esta en uso, inserte una clave distinta').show(300).delay(3000).hide(300);
								}
							else if (material == 2)
							{
								$('#alerta').addClass('alert alert-warning').html('Error al insertar , intente mas tarde ').show(300).delay(3000).hide(300);
							}
							else if (material == 3)

							{
								$('#alerta').addClass('alert alert-warning').html('El material se agrego con exito ').show(300).delay(30000).hide(300);

								
								document.location.href = '../index.php';

							}
						}
					});
				return false;

			}
			else
			{
				$('#alerta').addClass('alert alert-danger').html('Complete todos los Campos').show(300).delay(3000).hide(300);
			}

		});
});