$(document).ready(function()
{
	      $("#Tipo").change(function () {
           $("#Tipo option:selected").each(function () {
            elegido=$(this).val();
            $.post("seleccion.php", { elegido: elegido }, function(data){
            
            });            
        });
   })

});