<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

// Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
// Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
// (y $existe tomará true).
$existe = isset($_REQUEST["id"]);

// Se recogen los datos del formulario de la request, excepto id.
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$estrella =  $_REQUEST["estrella"];
$categoriaId = $_REQUEST["categoriaId"];

if (!$existe) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO Persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)";
    $parametros = [$nombre,$apellidos,$telefono,$estrella,$categoriaId];
} else { // Quieren actualizar, así que es un UPDATE.
    // Se recoge TAMBIÉN el id.
    $id = (int)$_REQUEST["id"];

    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE Persona SET nombre=?,apellidos=?,telefono=?,estrella=?,categoriaId=? WHERE id=?";
    $parametros = [$nombre,$apellidos,$telefono,$estrella,$categoriaId,$id];
}

$sentencia = $conexion->prepare($sql);

//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() > 0);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);



// INTERFAZ:
// $existe
// $correcto
// $datosNoModificados
?>



<html>

<head>
    <meta charset='UTF-8'>
    <link href="estilos.css" rel="stylesheet" type="text/css" media="screen" />
</head>



<body>

<?php
// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datosNoModificados) { ?>
    <?php if (!$existe) { ?>
        <h1 class='correcto'>Inserción completada</h1>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$apellidos?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$telefono?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$estrella?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$categoriaId?>.</p>
    <?php } else { ?>
        <h1 class='correcto'>Actualización completada</h1>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$apellidos?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$telefono?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$estrella?>.</p>
        <p class='correcto'>Se ha insertado correctamente la nueva entrada de <?=$categoriaId?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada, pero se ha quedado Vd. a gusto pulsando el botón de actualizar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if (!$existe) { ?>
        <h1 class='error'>Error en la creación.</h1>
        <p class='error'>No se ha podido crear la nueva categoría.</p>
    <?php } else { ?>
        <h1 class='error'>Error en la actualización.</h1>
        <p class='error'>No se han podido actualizar los datos de la categoría.</p>
    <?php } ?>

    <?php
}
?>

<a href='Listado.php'>Volver al listado</a>

</body>

</html>