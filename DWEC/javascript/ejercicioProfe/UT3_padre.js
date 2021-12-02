const $btnAbrir = document.querySelector("#btnAbrir"),
	$mensaje = document.querySelector("#mensaje"),
	$btnEnviarMensaje = document.querySelector("#btnEnviarMensaje"),
	$mensajeRecibido = document.querySelector("#mensajeRecibido");

let ventana;
$btnAbrir.addEventListener("click", () => {
	ventana = window.open("otra_ventana.html");
});

$btnEnviarMensaje.addEventListener("click", () => {
	let mensaje = $mensaje.value;
	if (!mensaje) {
		return;
	}
	if (ventana) {
		ventana.establecerMensaje(mensaje);
	}
});

// Llamada desde la hija
function establecerMensaje(mensaje) {
	$mensajeRecibido.textContent = mensaje;
}