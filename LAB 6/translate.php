<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Переводчик</title>
</head>
<body>
    <form method="post">
        <label for="number">Введите цифру:</label>
        <input type="number" name="number" min="1" max="9">
    </form>
    <?php
    if (!empty($_POST["number"])) {
        $number = $_POST["number"];
        if ($number == 1) {
            echo "<p>Один</p>";
        } elseif ($number == 2) {
            echo "<p>Два</p>";
        } elseif ($number == 3) {
            echo "<p>Три</p>";
        } elseif ($number == 4) {
            echo "<p>Четыре</p>";
        } elseif ($number == 5) {
            echo "<p>Пять</p>";
        } elseif ($number == 6) {
            echo "<p>Шесть</p>";
        } elseif ($number == 7) {
            echo "<p>Семь</p>";
        } elseif ($number == 8) {
            echo "<p>Восемь</p>";
        } elseif ($number == 9) {
            echo "<p>Девять</p>";
        }
        
    }
    ?>
</body>
</html>