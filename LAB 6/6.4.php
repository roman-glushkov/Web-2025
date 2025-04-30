<!DOCTYPE html>
<html>
<head>
    <title>Определение знака зодиака</title>
</head>
<body>
    <form method="post">
        <input type="text" name="date">
        <input type="submit" value="Определить">
    </form>
    <?php
    if (!empty($_POST["date"])) {
        $input = $_POST["date"];
        if (preg_match('/^(\d{1,2})([^\w\d])(\d{1,2})\2(\d{2,4})$/', $input, $matches)) {
            $first = (int)$matches[1];
            $second = (int)$matches[3];
            $year = (int)$matches[4];
            if ($second <= 12) {
                $d = $first;
                $m = $second;
            } elseif ($first <= 12 && $second > 12) {
                $d = $second;
                $m = $first;
            } else {
                echo "<p>Ошибка: введите корректную дату (день или месяц не может быть больше 12 одновременно)</p>";
                exit;
            }
            if ($year < 100) {
                if ($year <= 30) {
                    $y = 2000 + $year;
                } else {
                    $y = 1900 + $year;
                }
            } else {
                $y = $year;
            }
            if (checkdate($m, $d, $y)) {
                $sign = match(true) {
                    ($m == 1 && $d >= 20) || ($m == 2 && $d <= 18) => 'Водолей',
                    ($m == 2 && $d >= 19) || ($m == 3 && $d <= 20) => 'Рыбы',
                    ($m == 3 && $d >= 21) || ($m == 4 && $d <= 19) => 'Овен',
                    ($m == 4 && $d >= 20) || ($m == 5 && $d <= 20) => 'Телец',
                    ($m == 5 && $d >= 21) || ($m == 6 && $d <= 20) => 'Близнецы',
                    ($m == 6 && $d >= 21) || ($m == 7 && $d <= 22) => 'Рак',
                    ($m == 7 && $d >= 23) || ($m == 8 && $d <= 22) => 'Лев',
                    ($m == 8 && $d >= 23) || ($m == 9 && $d <= 22) => 'Дева',
                    ($m == 9 && $d >= 23) || ($m == 10 && $d <= 22) => 'Весы',
                    ($m == 10 && $d >= 23) || ($m == 11 && $d <= 21) => 'Скорпион',
                    ($m == 11 && $d >= 22) || ($m == 12 && $d <= 21) => 'Стрелец',
                    ($m == 12 && $d >= 22) || ($m == 1 && $d <= 19) => 'Козерог',
                    default => 'Неизвестно'
                };
                echo "<p>Дата: $d.$m.$y</p>";
                echo "<p>Ваш знак: <b>$sign</b></p>";
            } else {
                echo "<p>Некорректная дата!</p>";
            }
        } else {
            echo "<p>Используйте формат ДД[Ch]ММ[Ch]ГГГГ или ДД[Ch]ММ[Ch]ГГ, где [Ch] - любой символ кроме букв и цифр</p>";
        }
    }
    ?>
</body>
</html>