<html>
<head>
    <meta charset='UTF-8'>

    <style>

        #red {
            color: red;
        }

        #green {
            color: green;
        }

        #blue {
            color: blue;
        }

        #yellow {
            color: yellow;
        }
    </style>
</head>
<body>
    <?php
    $color = htmlspecialchars($_GET['colorElec']);

    switch ($color){
        case 'red':
        case 'green':
        case 'blue':
        case 'yellow':
            echo "<a id='$color'>Este parrafo cambia a color: $color</a> <br>";
            break;
    }
    ?>

</body>
</html>
