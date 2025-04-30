<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор Обратной Польской Записи</title>
</head>
<body>
    <div class="container">
        <h1>Калькулятор Обратной Польской Записи</h1>
        <form method="post">
            <input type="text" name="expression" required>
            <input type="submit" value="Вычислить">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['expression'])) {
            $expression = trim($_POST['expression']);
            
            try {
                $result = evaluateRPN($expression);
                echo '<div class="result"><strong>Результат:</strong> ' . htmlspecialchars($result) . '</div>';
            } catch (Exception $e) {
                echo '<div class="error"><strong>Ошибка:</strong> ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }
        function evaluateRPN($expression) {
            $stack = [];
            $tokens = explode(' ', $expression);
            
            foreach ($tokens as $token) {
                if (is_numeric($token)) {
                    array_push($stack, (int)$token);
                } elseif ($token === '') {
                    continue;
                } else {
                    if (count($stack) < 2) {
                        throw new Exception("Недостаточно операндов для оператора '$token'");
                    } 
                    $b = array_pop($stack);
                    $a = array_pop($stack);  
                    switch ($token) {
                        case '+':
                            array_push($stack, $a + $b);
                            break;
                        case '-':
                            array_push($stack, $a - $b);
                            break;
                        case '*':
                            array_push($stack, $a * $b);
                            break;
                        default:
                            throw new Exception("Неподдерживаемый оператор: '$token'");
                    }
                }
            } 
            if (count($stack) !== 1) {
                throw new Exception("Некорректное выражение: в стеке осталось " . count($stack) . " элементов");
            }
            return array_pop($stack);
        }
        ?>
    </div>
</body>
</html>