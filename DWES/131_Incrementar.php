<?php
    $numero=0;
    if (isset($_REQUEST["numero"])) {
        $numero=(int)$_REQUEST["numero"];
    }

    if (isset($_REQUEST['+1'])) {
        $numero++;
    } elseif (isset($_REQUEST['borrar'])) {
        $numero=0;
    }
?>
<html>
<head></head>
<body>
<form method='get'>
    <input type='number' name='numero' value=<?echo $numero?>>
    <input type='submit' name='+1' value='+1'> <br>
    <input type='submit' name='borrar' value='borrar'>
</form>
</body>
</html>