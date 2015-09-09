function Finalizar(id)
{
  var indicador=id;
  var url='clases/Finalizar.php';
  $.ajax({
    type:'POST',
    url:url,
    data:'id='+indicador,
    success: function(valor)
    {
      if (valor == 1)
      {
        alert("Problemas al Finalizar");
        location.reload();
      }
      else {
        alert("Exito ");
        location.reload();
      }
    }
  });
}
