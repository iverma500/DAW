<?php
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}
?>
<html>
<head></head>
<body>
<?php
    $ciudad = $_REQUEST['ciudad'];
    $error = false;
    if (!isset($ciudad) || trim($ciudad) == "" || is_numeric($ciudad)){
        $error = true;
        redireccionar("121_CiudadFavorita.php?error=$error");
    } else{
        echo "<a>Tu ciudad favorita es $ciudad </a> <br>";
        echo "<a href='https://www.google.com/search?q=$ciudad'>Buscar sobre $ciudad</a> <br>";
        echo "<a href='121_CiudadFavorita.php'>Volver a la página anterior</a>";
    }
?>
</body>
</html>
