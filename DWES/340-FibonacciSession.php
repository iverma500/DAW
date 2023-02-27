<?php

//guardar en cookie session con vida máxima de 1 hora.
session_set_cookie_params(3600);
ini_set("session.gc_maxlifetime",3600);
session_start();

// Si viene mandato de obtener otro valor y vienen los parámetros, se recuperan.
// Si no, se les carga el valor por defecto.
if (!isset($_SESSION['penultimo']) || !isset($_SESSION['ultimo'])){
    $_SESSION['penultimo'] = 0;
    $_SESSION['ultimo'] = 1;
}

if (isset($_REQUEST['reiniciar'])) {
    $penultimo = 0;
    $ultimo = 1;

} else {
    $penultimo = $_SESSION['penultimo'];
    $ultimo = $_SESSION['ultimo'];
}
//ocurre un error pero se debe comprobar al pulsar el botón siguiente
// Se calcula el nuevo valor.
$actual = $penultimo + $ultimo;

$_SESSION['penultimo'] = $ultimo;
$_SESSION['ultimo'] = $actual;
?>

<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
</head>
<body>

<p>Valor actual de Fibonacci:</p>

<p style='font-size: xx-large'><?=$actual?></p>

<form method='get'>
    <input type='submit' name='siguiente' value='Obtener siguiente valor'>
    <input type='submit' name='reiniciar' value='Reiniciar'>
</form>

</body>
</html>