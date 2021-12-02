const 
	$btnEnviar = document.querySelector("#btnEnviar"),
	texto = document.querySelector("#mensaje"),
	$mensajeRecibido = document.querySelector("#mensajeRecibido");
	
$btnEnviar.addEventListener("click", () => {
	const mensaje = texto.value;
	
	if (!mensaje){ 
		return alert("Escribe un mensaje");
	}
	if (window.opener) {
		window.opener.establecerMensaje(mensaje);
	}
});

window.establecerMensaje = function (mensaje) {
	$mensajeRecibido.textContent = mensaje;
}