<html>
<style>
  td {width:20px;
      height:20px;
    }
</style>
<head></head>
<body>
    <table align="center" border='1'>
        <?php
        $filas = 6;
        $columnas = 12;
        $array = array();

        for ($i = 0; $i < $filas;$i++){
            for ($j = 0; $j < $columnas;$j++){
             //   $numero = rand(-50,50); Llenar toda la tabla
                $array[$i][$j] = null;
            }
        }

        $array[0][7] = rand(-50,50);
        $array[3][1] = rand(-50,50);
        $array[4][8] = rand(-50,50);
        $array[1][5] = rand(-50,50);
        $array[4][11] = rand(-50,50);

        foreach ($array as $arrayNumeros){
            echo "<tr>";
            foreach ($arrayNumeros as $contenido){
                if (isset($contenido)){
                    if ($contenido > 0){
                        echo "<td style='background-color: green'>$contenido</td>";
                    } else if ($contenido < 0){
                        echo "<td style='background-color: red'>$contenido</td>";
                    } else if ($contenido == 0){
                        echo "<td style='color: white;background-color:black'>$contenido</td>";
                    }
                } else{
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>