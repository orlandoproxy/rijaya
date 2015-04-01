$(function(){
	$('#insertar').on('click',function(){
		var clave = $('#Clave').val();
		var nombre = $('#Nombre').val();
		var tipo = $('select#Tipo').val();
		var estatus = $('select#Estatus').val();
		var descripcion = $('#Descripcion').val();
		var categoria = $('select#Categoria').val();
		var medida1 = $('#Medida1').val();
		var medida2 = $('#Medida2').val();
		var medida3 = $('#Medida3').val();
		var url = '../InsertarProducto/ProcesoInsertar.php';
		var total = clave.length * nombre.length * descripcion.length * tipo.length * estatus.length * categoria.length;
		if (total>0) {
			$.ajax({
				type: 'POST',
				url: url,
				data: 'clave='+clave+'&nombre='+nombre+'&tipo='+tipo+'&descripcion='+descripcion+'&categoria='+categoria+"&estatus="+estatus+'&categoria='+categoria+'&medida1='+medida1+'&medida2='+medida2+'&medida3='+medida3,
				success: function(produ){
					if(produ == 1){
						
					}
					else if (produ == 2)
					{
						$('#mensaje').addClass('alert-info').html('El producto existe dentro del sistema').show(300).delay(3000).hide(300);
						return false;

					}
					else if (produ == 3) 
					{
						document.location.href = 'Continua.php';
					}
					return false;
				}

			});
			return false;

		}else{
			$('#mensaje').addClass('alert-info').html('Complete todos los campos').show(300).delay(3000).hide(300);
		}

	});

});