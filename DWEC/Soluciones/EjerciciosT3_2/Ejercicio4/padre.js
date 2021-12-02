const 
	$btnAbrir = document.querySelector("#btnAbrir"),
	texto = document.querySelector("#mensaje"),
	$btnEnviarMensaje = document.querySelector("#btnEnviarMensaje"),
	$mensajeRecibido = document.querySelector("#mensajeRecibido");

let ventana;
$btnAbrir.addEventListener("click", () => {
	ventana = window.open("ej4hija.html");
});

$btnEnviarMensaje.addEventListener("click", () => {
	let mensaje = texto.value;
	if (!mensaje) {
		return alert("Escribe un mensaje");
	}
	if (ventana) {
		ventana.establecerMensaje(mensaje);
	}
});

function establecerMensaje(mensaje) {
	$mensajeRecibido.textContent = mensaje;
}