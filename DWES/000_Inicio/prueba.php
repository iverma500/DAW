<?php
    //filas
    $n = 9;
    echo "<pre style='text-align: center'>";
    $num = 1;

    for ($i = 0; $i < $n; $i++)
    {
        for ($j = 0; $j <= $i; $j++ )
        {
            // mostrar numero
            echo $num." ";
        }
        //sumar numero en cada fila
        $num = $num + 1;
        // salto de linea cada fila
        echo "<br>";
    }
    echo "</pre>";

?>