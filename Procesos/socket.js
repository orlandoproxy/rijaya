var mysocket = new WebSocket("ws://echo.websocket.org");

function escribir(texto)
{
  valor = document.getElementById("caja").value;
  document.getElementById("caja").value = valor + texto + "\n";
}

mysocket.onopen = function (evt){
   escribir("Websocket abierto");
};
 
mysocket.onmessage = function (evt){
  escribir("RECIBIDO: " + evt.data);	
};
 
mysocket.onclose = function (evt){
  escribir("Websocket cerrado");
};
 
mysocket.onerror = function (evt) {
  escribir("ERROR: " + evt.data);
  }

  function escribir(texto){
  valor = document.getElementById("caja").value;
  document.getElementById("caja").value = valor + texto + "\n";
}
function enviar(texto) {
  mysocket.send(texto);
  escribir("ENVIADO: " + texto);
}
function desconectar(){		
  mysocket.close();
}
