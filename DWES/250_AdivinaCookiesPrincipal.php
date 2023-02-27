<?php

if (!isset($_REQUEST["intento"])) { // Primera vez. Solo viene oculto.
    $intento = null;
    $oculto = (int) $_REQUEST["oculto"];
    $numIntentos = 0;
} else { // Resto de veces. Vienen todos los datos.
    $intento = (int) $_REQUEST["intento"];
    $oculto = (int) $_COOKIE["oculto"];
    $numIntentos = (int) $_COOKIE["numIntentos"] + 1;

    // Esto del logaritmo no es importante. Es solo una manera de que
    // no salga 1.000.000 de asteriscos si hacen un intento de "1000000".
    $numAsteriscos = 1 + log(abs($intento - $oculto), 1.5);
    $stringCercania = "";
    for ($i=1; $i <= $numAsteriscos; $i++) {
        $stringCercania = $stringCercania . "*";
    }
}

    setcookie('oculto',$oculto,time() + 1*60*60);
    setcookie('numIntentos',$numIntentos,time() + 1*60*60);

// INTERFAZ:
// $oculto
// $intento
// $numAsteriscos
// $stringCercania
?>



<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>ADIVINA EL NÚMERO</h1>


<?php

if ($intento == null) {
    // No informamos de nada, el juego acaba de empezar.
} elseif ($intento < $oculto) {
    echo "<p>El número que buscas es mayor ($stringCercania)</p>";
} elseif ($intento > $oculto) {
    echo "<p>El número que buscas es menor ($stringCercania)</p>";
} else {
    echo "<p>¡Has adivinado el número! Era, efectivamente, $oculto. Has gastado $numIntentos intentos.</p>";
}



if ($intento != $oculto) { // Presentamos el formulario:
    ?>

    <form method="post">
        <p>Jugador 2: Adivina el número (llevas <?= $numIntentos ?> intentos).</p>
        <input type="number" name="intento">
        <input type="submit" value="Intentar">
    </form>

    <?php
}
?>

</body>

</html>