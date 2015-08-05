
function loadXMLDoc(val)
{
var xmlhttp;
var valor=val;

var n=document.getElementById('clave_'+val).value;
var p=document.getElementById('tipo_'+val).value;
if(n==''){
document.getElementById("nombre_"+val).innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("nombre_"+val).innerHTML=xmlhttp.responseText;
}
}

xmlhttp.open("POST","autocompletar.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+n+','+p);

}

