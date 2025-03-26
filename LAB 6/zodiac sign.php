<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Знак зодиака</title>
</head>
<body>
    <form method="post">
        <label for="date">Введите дату: </label>
        <input type="text" name="date" pattern="\d{2}.\d{2}.\d{4}">
    </form>

    <?php
    if (!empty($_POST["date"])) {
        $dateParts = explode(".", $_POST["date"]);
        $day = intval($dateParts[0]);
        $month = intval($dateParts[1]);
        $zodiac = "";

        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
            $zodiac = "Водолей";
        } elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
            $zodiac = "Рыбы";
        } elseif (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
            $zodiac = "Овен";
        } elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
            $zodiac = "Телец";
        } elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
            $zodiac = "Близнецы";
        } elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
            $zodiac = "Рак";
        } elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
            $zodiac = "Лев";
        } elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
            $zodiac = "Дева";
        } elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
            $zodiac = "Весы";
        } elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
            $zodiac = "Скорпион";
        } elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
            $zodiac = "Стрелец";
        } elseif (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
            $zodiac = "Козерог";
        }

        echo "<p>Ваш знак зодиака: <b>$zodiac</b></p>";
    }
    ?>
</body>
</html>