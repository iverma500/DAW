<html>
<head>
    <meta charset='UTF-8'>
</head>
<body>
    <?php
    $operando1 = $_REQUEST['operando1'];
    $operando2 = $_REQUEST['operando2'];
    $operacion = $_REQUEST['operacion'];
    $resultado = 0;
    $errorDivCero = false;

    if ($operando2 == 0){
        $errorDivCero = true;
    }

    if ($operacion == "sum"){

        $resultado = $operando1 + $operando2;
        echo "<h3>La suma de $operando1 y $operando2 es igual a $resultado</h3>";

    } else if ($operacion == "res"){

        $resultado = $operando1 - $operando2;
        echo "<h3>La resta de $operando1 y $operando2 es igual a $resultado</h3>";

    } else if ($operacion == "mul"){

        $resultado = $operando1 * $operando2;
        echo "<h3>La multiplicación de $operando1 y $operando2 es igual a $resultado</h3>";

    } else if ($operacion == "div"){

        if ($errorDivCero){

            echo "<h2 style='color: red'>No es posible dividir entre cero</h2>";

        }else{

            $resultado = $operando1 / $operando2;
            echo "<h3>La división de $operando1 y $operando2 es igual a $resultado</h3>";
        }

    }
    ?>
</body>
</html>