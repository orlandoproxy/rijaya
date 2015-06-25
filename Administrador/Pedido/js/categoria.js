$(document).ready(function(){
   $("#Categoria").change(function () {
           $("#Categoria option:selected").each(function () {
            elegido=$(this).val();
            $.post("clases/categoria.php", { elegido: elegido }, function(data)
            	{});            
        });
   })
});