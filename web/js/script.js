$(function()
{
    var user = "";
    var password = "";
    if(document.getElementById("codigo")!== null)
    {
        document.getElementById("codigo").focus();   
    }
    $("#access").click(function()
    {
        user = $("#user").val();
        password = $("#password").val();
        $.post("web/handshake/validacion.php", {user:user, password:password},function(data)
        {
            $("#mensaje").css("display","inline");
            $("#loginuser").css("height","350px");
            $("#mensaje div").html(" <span>"+data.mensaje+"</span>");
        },"json");
    });
});
