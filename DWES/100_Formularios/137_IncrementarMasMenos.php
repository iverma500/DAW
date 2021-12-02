<?php
$numero=0;
$sumar =1;
$restar = 1;
if (isset($_REQUEST["numero"]) && isset($_REQUEST["sumar"]) && isset($_REQUEST["restar"])) {
    $numero=(int)$_REQUEST["numero"];
    $sumar=(int)$_REQUEST["sumar"];
    $restar=(int)$_REQUEST["restar"];
}

if (isset($_REQUEST['enviarSuma'])) {
    $numero+=$sumar;
}elseif (isset($_REQUEST['enviarResta'])) {
    $numero-=$restar;
}elseif (isset($_REQUEST['borrar'])) {
    $numero=0;
    $sumar =1;
    $restar=1;
}
echo "<h1 style='color: red'>$numero</h1>";
?>
<html>
<head></head>
<body>
<form method='get'>
    <input type='hidden' name='numero' readonly value='<?echo $numero?>'>
    <br>
    <input type='number' name='sumar' value=<?echo $sumar?>>
    <input type='submit' name='enviarSuma' value='Sumar'>
    <br>
    <input type='number' name='restar' value=<?echo $restar?>>
    <input type='submit' name='enviarResta' value='Restar'>
    <br>
    <input type='submit' name='borrar' value='borrar'>
</form>
</body>
</html>
