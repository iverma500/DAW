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
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<table border='1'>
    <tr>
        <th>Tabla</th>
        <th>base de datos y PHP</th>
    </tr>
    <tr>
        <?php
        $con= obtenerPdoConexionBD();
        $sql = "SELECT * FROM Categoria ORDER BY nombre;";
        $query = $con -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0) {

        // Usaremos el ciclo para mostrar resultados
            foreach($results as $result) {
                echo "<tr>";
                echo "<td><a href=410_CategoriaFicha.php?id=".$result -> id."&nombre=".$result -> nombre.">".$result -> nombre."</a></td>
                </tr>";
            }
        }
        //OTRA FORMA
        //$con=mysqli_connect('localhost','root','root','agenda') or die ('Error en la conexion');
        //$sql="SELECT * FROM Categoria ORDER BY nombre;";
        //$resultado=mysqli_query($con,$sql) or die ('Error en el query database');
        /*while($fila = $resultado->fetch_assoc())
        {
            echo ("<td>".$fila["id"]."</td>");
            echo ("<td>".$fila["nombre"]."</td> ");
        }
        */
        ?>
    </tr>
</table>

</body>
</html>