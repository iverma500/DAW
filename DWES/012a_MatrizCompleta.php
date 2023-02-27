<?php

    $matriz = array (
        array( 2,  0,  5, -5,  2, 5),
        array( 0, 15, 13,  6,  1, 0),
        array(16,  5, -2,  7,  8, 2),
        array( 0, 17, 15,  6, -7, 3)
    );

?>



<html>

<head>
    <meta charset='UTF-8'>

    <style>
        table, tr, td{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        .negativo {
            color: red;
        }

        .cero {
            color: black;
        }

        .positivo {
            color: green;
        }
    </style>
</head>

<table>

<?php
    for ($fil=0; $fil<count($matriz); $fil++) {
        echo "<tr>";
        for ($col=0; $col < count($matriz[$fil]); $col++) {
            if      ($matriz[$fil][$col]  < 0) $clase = "negativo";
            else if ($matriz[$fil][$col] == 0) $clase =     "cero";
            else                               $clase = "positivo";

            echo "<td class='$clase'>" . $matriz[$fil][$col] ."</td>";
        }
        echo "</tr>";
    }
?>

</table>

</html>