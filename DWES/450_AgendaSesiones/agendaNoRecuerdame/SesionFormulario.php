<?php
    require_once "_Varios.php";

    if (haySesionRam()){
        redireccionar("PersonaListado.php");

    }
?>
<html>
<head>
    <meta charset="utf-8">
</head>

<body>
    <form method="get" action="SesionComprobar.php">
        <div style='text-align: center'>
            <?php
            if(isset($_GET["code"])){
                echo "<h2 style='color: red'><b>¡Error los datos introducidos no son correctos!</b></h2>";
            }
            ?>
            <h1>Iniciar sesión</h1><br><br>
            <input type="text" name="txtusuario" placeholder="Ingresar usuario" required /><br>
            <input type="password" name="txtpassword" placeholder="Ingresar password" required /><br><br>
            <input type='checkbox' name='recuerdame' value='recuerdame'><label>Recuérdame</label>
            <br><br> <!-- hacer 2 cookies -->
            <input type="submit" name="btningresar" value="Ingresar"/>
        </div>
    </form>
</body>

</html>