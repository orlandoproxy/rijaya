$(function()
{
    var user = "";
    var password = "";
    var codigo = "";
    if(document.getElementById("codigo")!== null)
    {
        document.getElementById("codigo").focus();   
    }
    $("#access").click(function()
    {
        user = filtrarVariable(limitarLogitud($("#user").val(), 5, 20));
        password = filtrarVariable(limitarLogitud($("#password").val(), 5, 20));
        if(user && password)
        {
            $.post("web/handshake/validacion.php", {user:user, password:password},function(data)
            {
                $("#mensaje").css("display","inline");
                $("#loginuser").css("height","350px");
                $("#mensaje div").html(" <span>"+data.mensaje+"</span>");
            },"json");
        }
    });
    $("#access2").click(function()
    {
        
        codigo = filtrarVariable(limitarLogitud($("#codigo").val(), 5, 20));
        if(codigo)
        {
            $.post("web/handshake/validacion.php", {codigo:codigo},function(data)
            {
                $("#mensaje").css("display","inline");
                $("#loginopera").css("height","271px");
                $("#mensaje div").html(" <span>"+data.mensaje+"</span>");
            },"json");
        }
    });
});
function limitarLogitud(dato, min, max)
{
    if(dato.length>=min && dato.length<=max)
    {
        return dato;
    }
    else
    {
        return FALSE;
    }
}

function filtrarVariable(dato)
{
    dato = dato.replace(/SELECT/gi,"");
    dato = dato.replace(/COPY/gi,"");
    dato = dato.replace(/SCRIPT/gi,"");
    dato = dato.replace(/DELETE/gi,"");
    dato = dato.replace(/DROP/gi,"");
    dato = dato.replace(/DUMP/gi,"");
    dato = dato.replace(/OR/gi,"");
    dato = dato.replace("%","");
    dato = dato.replace(/LIKE/gi,"");
    dato = dato.replace(/UNION/gi,"");
    dato = dato.replace("--","");
    dato = dato.replace("^","");
    dato = dato.replace("[","");
    dato = dato.replace("]","");
    dato = dato.replace("!","");
    dato = dato.replace("¡","");
    dato = dato.replace("?","");
    dato = dato.replace("=","");
    dato = dato.replace("&","");
    dato = dato.replace("//","");
    dato = dato.replace(">","");
    dato = dato.replace("<","");
    dato = dato.replace("{","");
    dato = dato.replace("}","");
    dato = dato.replace("*","");
    dato = dato.replace(":","");
    dato = dato.replace("'","");
    dato = dato.replace("¿","");
    return dato;
}