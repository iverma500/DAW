<?php
$colores = array(
    "red" => "rojo",
    "green" => "verde",
    "blue" => "azul",
    "yellow" => "amarillo");
?>
<html>
<head></head>
<body>
<form action="Color.php" method="get">

    <select name="colorElec">
        <?php foreach ($colores as $clave => $valor) {?>
        <option value="<?php echo $clave?>"><?php echo $valor; ?> </option>
        <?php
        }//cierro el foreach
        ?>
    </select>

    <p><input type="submit" /></p>
</form>
</body>
</html>