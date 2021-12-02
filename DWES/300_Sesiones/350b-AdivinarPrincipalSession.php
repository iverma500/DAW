<?php
//guardar en cookie session con vida máxima de 1 hora.
session_set_cookie_params(3600);
ini_set("session.gc_maxlifetime",3600);
session_start();

if (isset($_REQUEST["oculto"])) { // Primera vez con el formulario
    $oculto = (int) $_REQUEST["oculto"];
    $intento = null;
    $numIntentos = 0;
} else if (!isset($_SESSION["oculto"])) { // Querían continuar, pero no hay session; no se puede
    header("Location: 350a-AdivinarInicio-Session.php");
    exit;
} else if (isset($_REQUEST["intento"])) { // Segunda y siguientes veces con "$intento"
    $oculto = (int) $_SESSION["oculto"];
    $intento = (int) $_REQUEST["intento"];
    $numIntentos = (int) $_SESSION["numIntentos"] + 1;

    // Esto del logaritmo no es importante. Es solo una manera de que
    // no salga 1.000.000 de asteriscos si hacen un intento de "1000000".
    $numAsteriscos = 1 + log(abs($intento - $oculto), 1.5);
    $stringCercania = "";
    for ($i=1; $i <= $numAsteriscos; $i++) {
        $stringCercania = $stringCercania . "*";
    }
} else { // Querian continuar (sin intento) y es posible porque hay session
    $oculto = (int) $_SESSION["oculto"];
    $intento = null;
    $numIntentos = (int) $_SESSION["numIntentos"];
}

$_SESSION['oculto'] = $oculto;
$_SESSION['numIntentos'] = $numIntentos;

?>



<html>

<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8" />
</head>

<body>

<h1>ADIVINAR EL NÚMERO CON COOKIES</h1>

<?php
if ($intento == null) {
    // No informamos de nada, el juego acaba de empezar.
} else if($intento < $oculto) {
    echo "<p>El número que buscas es mayor ($stringCercania).</p>";
} else if($intento > $oculto) {
    echo "<p>El número que buscas es menor ($stringCercania).</p>";
} else {
    echo "<p>Has adivinado el número. Era $oculto.</p>";
}

if ($intento != $oculto) {
    ?>

    <h3>Jugador 2: Adivina el número. Llevas <?= $numIntentos ?> intento(s).</h3>

    <form method = "post">
        <input type = "number" name = "intento">
        <input type = "submit" value = "Intentar">
    </form>

<?php } ?>

</body>

</html>