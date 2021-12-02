<?php
if(isset($_POST['number'])) {
    $number = $_POST['number'];
    $intentos = $_POST['intentos'] + 1;

} else {
    $intentos = 0;
    $number = 0;
}
?>

<html lang="es">
<head><title>Adivina</title></head>
<body>
    <h1>Adivina</h1>
    <p>Intenta adivinar un número</p>

    <form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" name="adivinar-numero">
        <label>Ingresa un número:</label><br/>
        <input type="number" id="adivina" name="adivina" />
        <input name="enviar" type="submit" value="Prueba suerte!" />
        <br><br>
        <label>Ingresa un número a adivinar</label>
        <input name="number" type="password" value="<?= $number ?>" />
        <input name="intentos" type="hidden" value="<?= $intentos ?>" />
    </form>

    <form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" name="nuevo-numero">
        <input name="borrar" type="submit" value="Nuevo Juego" />
    </form>

    <?php
    if(isset($_POST["adivina"])){

        $adivina  = $_POST['adivina'];
        $number  = $_POST['number'];
        $intentos = $_POST['intentos'];

        if ($adivina < $number){
            echo "Intenta con un número más alto.";
        }elseif($adivina > $number){
            echo "Intenta con un número más bajo.";
        }elseif($adivina == $number){
            echo "<p>Excelente!! Lo adivinaste!!</p>";
            echo "<p>Número de intentos final: $intentos</p>";
        }
    }
    ?>
</body>
</html>
