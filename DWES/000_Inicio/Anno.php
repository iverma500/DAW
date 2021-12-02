<html>
<head></head>
<body>
<?php
    $valor= $_REQUEST['any'];

    if ($valor % 10 == 0 && $valor > 0) {
        for ($i = $valor; $i <= ($valor + 9); $i++) {
            echo "<a href=https://www.google.com/search?q=$i>Buscar sobre el año $i</a> <br>";
            echo "<a href=https://www.google.com/search?q=$i&rlz=1C1TIGY_enES898ES898&sxsrf=AOaemvKvqPOxXdlj-MkaEm0KvXvhqS34ng:1633457379878&source=lnms&tbm=isch>Buscar sobre el año (Imagenes) $i</a> <br>";
            echo "<a href=https://www.google.com/maps?q=$i>Buscar sobre el año (Maps) $i</a> <br>";
            echo "<a href=https://es.wikipedia.org/wiki/$i>Buscar sobre el año (Wikipedia) $i</a> <br>";
            echo "<br><br>";
        }
    }else{
        echo "<p>Error en los datos</p>";
    }
?>
</body>
</html>