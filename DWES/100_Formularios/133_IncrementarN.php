<?php
$numero=0;
$sumar =1;
if (isset($_REQUEST["numero"]) && isset($_REQUEST["sumar"])) {
    $numero=(int)$_REQUEST["numero"];
    $sumar=(int)$_REQUEST["sumar"];
}

if (isset($_REQUEST['enviar'])) {
    $numero+=$sumar;
} elseif (isset($_REQUEST['borrar'])) {
    $numero=0;
    $sumar =1;
}
?>
<html>
<head></head>
<body>
<form method='get'>
    <input type='number' name='numero' value=<?echo $numero?>>
    <input type='submit' name='enviar'> <br>
    <input type='number' name='sumar' value=<?echo $sumar?>>
    <input type='submit' name='borrar' value='borrar'>
</form>
</body>
</html>
