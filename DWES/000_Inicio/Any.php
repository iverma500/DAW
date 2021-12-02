<html>
<head></head>
<body>
<?php
    $valor= $_REQUEST['any'];

    if ($valor % 10 == 0 && $valor > 0) {
        for ($i = $valor; $i <= ($valor + 9); $i++) {
            echo "<a href='https://www.google.com/search?q=$i'>Buscar sobre el año $i</a> <br>";
        }
    }else{
        echo "<p>Error en los datos</p>";
    }
?>
</body>
</html>