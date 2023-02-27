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

if (isset($_REQUEST["nombre"])){
    $nombre = $_REQUEST["nombre"];
} else {
    $nombre = null;
}
try {
    $con = obtenerPdoConexionBD();
    $sql = "INSERT INTO Categoria (nombre) VALUES(?);";
    $query = $con->prepare($sql);
    $query->execute([$nombre]);
    echo "Creación exitosa";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<h1>Categoría creada: <?= $nombre ?></h1>
<a href='410_CategoriaListado.php'>Volver a la página principal</a>
</body>
</html>