<?php


// Creación de una cookie
if (isset($acumulado)){
    $diferencia = $_REQUEST["diferencia"];
    setcookie('acumulado',0,time()+3600*24*31);
    setcookie('diferencia',$diferencia,time()+3600*24*31);
}
?>

<?php
if (isset($_REQUEST["reset"])) { // Si NO hay formulario enviado (1ª vez), o piden resetear.
    $acumulado = 0;
    $diferencia = 1;
} else { // Sí hay formulario enviado (2ª ó siguientes veces) y no piden resetear.
    $acumulado = (int) $_COOKIE["acumulado"];
    $diferencia = (int) $_REQUEST["diferencia"];
    setcookie('diferencia',$diferencia,time()+3600*24*31);

    if (isset($_REQUEST["resta"])) {
        $acumulado = $acumulado - $diferencia;
        setcookie('acumulado',$acumulado,time()+3600*24*31);

    } else if (isset($_REQUEST["suma"])) {
        $acumulado = $acumulado + $diferencia;
        setcookie('acumulado',$acumulado,time()+3600*24*31);
    } else {
        // ERROR
    }
}
?>



<html>

<h1><?=$acumulado?></h1>

<form method='get'>

    <input type='submit' value=' - ' name='resta'>
    <input type='number' name='diferencia' value='<?=$diferencia?>'>
    <input type='submit' value=' + ' name='suma'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

    <br /><br />

    <a href='<?= $_SERVER["PHP_SELF"] ?>'>Otra manera de resetear</a>
    <br/><span>(Esta parece la mejor)</span>

</form>

</html>
