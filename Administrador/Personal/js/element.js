$(document).ready(function(){
   $("#Tipo").change(function () {
           $("#Tipo option:selected").each(function () {
            elegido=$(this).val();
            $.post("clases/proceso.php", { elegido: elegido }, function(data){
            $("#cuerpo").html(data);

            });
        });
   })
});
