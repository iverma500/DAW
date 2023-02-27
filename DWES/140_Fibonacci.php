<?php
$n1 = 0;
$n2 = 1;
$suma = 0;

if (isset($_REQUEST['numero']) && isset($_REQUEST['numero2'])){
    $n1=(int)$_REQUEST["numero"];
    $n2=(int)$_REQUEST["numero2"];
}

if (isset($_REQUEST['enviar'])){
    $suma = $n1 + $n2;
    $n1 = $n2;
    $n2 = $suma;

} else if (isset($_REQUEST['borrar'])){
    $n1 = 0;
    $n2 = 1;
    $suma = 0;
}

echo "<h1>$suma</h1>";
?>

<html>
<head></head>
<body>
<form method='get'>
    <input type='hidden' name='numero' readonly value='<?echo $n1?>'>
    <input type='hidden' name='numero2' readonly value='<?echo $n2?>'>

    <input type='submit' name='enviar' value='Obtener valor'>
    <br><br>
    <input type='submit' name='borrar' value='borrar'>
</form>
</body>
</html>
