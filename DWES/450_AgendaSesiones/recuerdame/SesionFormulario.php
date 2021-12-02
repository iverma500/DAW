<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    entrarSiSesionIniciada();
?>


<html>
<head>
    <meta charset='UTF-8'>
</head>
<body>

<?php if (isset($_REQUEST["error"])) { ?>
    <h1 style="color: red">Fallo de autenticación, intentelo de nuevo</h1>
<?php } ?>

<?php if (isset($_REQUEST["sesionCerrada"])) { ?>
    <p style="color: blue">Se ha cerrado correctamente la sesión</p>
<?php } ?>

<form action="SesionComprobar.php" method="post">
    <label for='identificador'>Usuario</label><br>
    <input type="text" name="identificador"><br><br>

    <label for='contrasenna'>Contraseña</label><br>
    <input type="password" name="contrasenna"><br><br>

    <label for='recordar'>Recordar</label><br>
    <input type="checkbox" id="recordar" name="recordar"><br><br>

    <input type="submit" name="enviar">
</form>

</body>
</html>