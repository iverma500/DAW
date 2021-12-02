<html>
<head></head>
<body>
<form action="Ciudad.php" method="get">
    <p>Inrtoduce ciudad: </p><input type="text" name="ciudad" />
    <input type="submit" name="boton"/>
    
    <?php
    if (isset($_REQUEST['error'])) {
        echo "<h3 style='color: red'>Error en los datos introducidos</h3>";
    }
    ?>
</form>
</body>
</html>

