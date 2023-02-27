<html>
<head></head>
<body>
<form action="110b_calculadora_resultado.php" method="get">

    <input type="number" name="operando1" required>
    <br><br>
    <select name="operacion">
        <option value="sum">Sumar</option>
        <option value="res">Restar</option>
        <option value="mul">Multiplicar</option>
        <option value="div">Dividir</option>
    </select>
    <br><br>
    <input type="number" name="operando2" required>

    <p><input type="submit"/></p>
</form>
</body>
</html>