<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Факториал</title>
</head>
<body>
    <form method="post">
        <label>Введите число:</label>
        <input type="number" name="number" required>
    </form>

    <?php
    function factorial($n) {
        if ($n == 0 || $n == 1) {
            return 1;
        }
        return $n * factorial($n - 1);
    }
    
    if (!empty($_POST["number"])) {
        $number = intval($_POST["number"]);
        if ($number >= 0) {
            echo "<p>Факториал: " . factorial($number) . "</p>";
        } else {
            echo "<p>Ошибка: введите неотрицательное число.</p>";
        }
    }
    ?>
</body>
</html>