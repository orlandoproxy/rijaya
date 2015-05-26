$(function()
{
    var user = "";
    var password = "";
    $("#access").click(function()
    {
        user = $("#user").val();
        password = $("#password").val();
        $.post("web/handshake/validacion.php", {user:user, password:password},function(data)
        {
            alert(data.mensaje);
        },"json");
    });
});