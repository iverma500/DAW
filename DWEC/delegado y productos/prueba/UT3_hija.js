// Este script es incluido en la ventana que abre la principal
const $btnEnviar = document.querySelector("#btnEnviar"),
	$mensaje = document.querySelector("#mensaje"),
	$mensajeRecibido = document.querySelector("#mensajeRecibido");
	$btnEnviar.addEventListener("click", () => {
	const mensaje = $mensaje.value;
	if (!mensaje) return alert("Escribe un mensaje");
	if (window.opener) {
		window.opener.establecerMensaje(mensaje);
	}
});


// Definición de función desde la que nos llama el padre
window.establecerMensaje = function (mensaje) {
	$mensajeRecibido.textContent = mensaje;
}