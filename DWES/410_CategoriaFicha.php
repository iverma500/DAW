<?php
declare(strict_types=1);

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "agenda";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        syso("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit("Error al conectar");
    }

    return $conexion;
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

if (isset($_REQUEST["id"])){
    $id = $_REQUEST["id"];

} else {
    $id = null;
}

$con= obtenerPdoConexionBD();
$sql = "SELECT nombre FROM Categoria WHERE id = $id;";
$query = $con -> prepare($sql);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0) {
    // Usaremos el ciclo para mostrar resultados
    foreach($results as $result) {
        $nombre = $result -> nombre;
    }
}
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<form>
    <input type='hidden' name='id' value='<?= $id ?>'>
    <b>NOMBRE</b>
    <input type='text' name='nombre' value='<?= $nombre ?>'>
    <br><br>
    <input type='submit' name='Enviar'>


</form>
</body>
</html>
