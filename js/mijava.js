$(function(){
	
	$('#ingresar').on('click',function(){
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
						if (valor == a) 
							{
								$('#mensaje').addClass('error').html('El usuario ingresado no existe').show(300).delay(3000).hide(300);
								return false;
							}
							else if (valor== 'contra')
								{
									$('#mensaje').addClass('error').html('La Contraseña es Incorrecta').show(300).delay(3000).hide(300);
									return false;
								}
							else if (valor == 'Admin') 
								{
									//$('#mensaje').addClass('error').html('redireccion').show(300).delay(3000).hide(300);
									document.location.href = 'Administrador/index.php';
									return false;
								}
					}
			});
			return false;

		}
		else
		{
			$('#mensaje').addClass('error').html('Complete todos los campos').show(300).delay(3000).hide(300);
		}
	});
	
});