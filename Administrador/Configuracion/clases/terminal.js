function Activar(id)
{
  var clave=id;
  var url='clases/Terminales.php';
  $.ajax({
    type:'POST',
    url:url,
    data: 'catego=1&id='+clave,
    success:function(valor)
    {
      location.reload();
    }
  });
}
function Desactivar(id)
{
  var clave =id;
  var url='clases/Terminales.php';
  $.ajax({
    type:'POST',
    url:url,
    data:'catego=2&id='+clave,
    success: function(valor)
    {
      location.reload();
    }
  });
}
function Suspender(id)
{
  var clave =id;
  var url='clases/Terminales.php';
  $.ajax({
    type:'POST',
    url:url,
    data:'catego=3&id='+clave,
    success: function(valor)
    {
      location.reload();
    }
  });
}
function Guardar()
{

  var url='clases/Terminales.php';
  var Nombre =$('#nombre').val();
  var Clave = $('#clave').val();
  $.ajax({
    type:'POST',
    url:url,
    data:'catego=4&nombre='+Nombre+'&clave='+Clave,
    success: function()
    {
      location.reload();
    }
  });
}
