<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Счастливые билеты</title>
</head>
<body>
    <form method="post">
        <label for="start">Начальный номер билета:</label>
        <input type="text" name="start" pattern="\d{6}">
        <br>
        <label for="end">Конечный номер билета:</label>
        <input type="text" name="end" pattern="\d{6}">
        <br>
        <button type="submit">Показать счастливые билеты</button>
    </form>

    <?php
if (!empty($_POST["start"]) && !empty($_POST["end"])) {
    $start = intval($_POST["start"]);
    $end = intval($_POST["end"]);
    
    for ($i = $start; $i <= $end; $i++) {
        $ticket = str_pad($i, 6, "0", STR_PAD_LEFT); // Делаем строку длиной 6 символов
        
        $first_half = $ticket[0] + $ticket[1] + $ticket[2];
        $second_half = $ticket[3] + $ticket[4] + $ticket[5];
        
        if ($first_half == $second_half) {
            echo "$ticket<br>";
        }
    }
}
?>
</body>
</html>