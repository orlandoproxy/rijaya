$(function(){
	$('#Guardar').on('click',function() 
			{
				var pedido = $('#Pedido').val();
				var fecha = $('#Fecha').val();
				var estatus = $('#Estatus').val();
				var corte = $('#Corte').val();
				var prensado = $('#Prensado').val();
				var doblado = $('#Doblado').val();
				var soldadura = $('#Soldadura').val();
				var lavado = $('#Lavado').val();
				var pintura = $('#Pintura').val();
				var terminado = $('#Terminado').val();
				var referencia = $('#Referencia').val();
				var url = 'ProcesoInsertar.php';
				var total = pedido.length * fecha.length * estatus.length * corte.length * prensado.length * doblado.length * soldadura.length * lavado.length * pintura.length * terminado.length * referencia.length;
				if (total>0) 
					{
						$.ajax({
							type:'POST',
							url:url,
							data: 'pedido='+pedido+'&fecha='+fecha+'&estatus='+estatus+'&corte='+corte+'&prensado='+prensado+'&doblado='+doblado+'&soldadura='+soldadura+'&lavado='+lavado+'&pintura='+pintura+'&terminado='+terminado+'&referencia='+referencia,
							success: function(orden)
							{
								if (orden == 1) 
								{
									$('#mensaje').addClass('alert-info').html('Ya existe un Pedido con estos datos').show(300).delay(3000).hide(300);
								}
								else if (orden == 2)
								{
									$('#mensaje').addClass('alert-info').html('Error al insertar , intente mas tarde').show(300).delay(3000).hide(300);
									return false;
								}
								else if (orden == 3)
								{
									document.location.href ='../Seleccionar/index.php';
								}
								return false;
							}
						});
						return false;
					}
					else
					{
						$('#mensaje').addClass('alert-info').html('Complete todos los campos').show(300).delay(3000).hide(300);
					}
			});

});	