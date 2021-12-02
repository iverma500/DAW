<?php
//guardar en cookie session con vida máxima de 1 hora.
session_set_cookie_params(3600);
ini_set("session.gc_maxlifetime",3600);
session_start();

if (!isset($_SESSION['acumulado'])){
    $_SESSION['acumulado'] = 0;
}

if (isset($_REQUEST['reset'])) {
    $acumulado = 0;
    $diferencia = 1;
} else {

    $acumulado = $_SESSION['acumulado'];

    if (!isset($_REQUEST['diferencia'])){
        $diferencia = 1;
    } else{
        $diferencia = (int) $_REQUEST['diferencia'];
    }

    if (isset($_REQUEST['resta'])) {
        $acumulado = $acumulado - $diferencia;
    } else if (isset($_REQUEST['suma'])) {
        $acumulado = $acumulado + $diferencia;
    } else {
        // ERROR
    }
}

$_SESSION['acumulado'] = $acumulado;
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