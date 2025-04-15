<?php
// 1. Получаем ID из URL
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// 2. Загружаем данные пользователей
$users = json_decode(file_get_contents('users.json'), true);

// 3. Валидация ID
if ($user_id === null || $user_id <= 0) {
    header('Location: home.php'); // Редирект при некорректном ID
    exit;
}

// 4. Поиск пользователя
$user = null;
foreach ($users as $u) {
    if ($u['id'] === $user_id) {
        $user = $u;
        break;
    }
}

// 5. Если пользователь не найден — редирект
if (!$user) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Профиль <?= htmlspecialchars($user['name']) ?></title>
    <link rel="stylesheet" href="static/styles/menu_style.css" />
    <link rel="stylesheet" href="static/styles/profile_style.css" />
</head>
<body>
    <!-- Меню -->
    <div class="menu">
        <!-- ... (оставляем без изменений) ... -->
    </div>

    <!-- Шаблон профиля -->
    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="<?= htmlspecialchars($user['name']) ?>" class="avatar" />
    <div class="description">
        <p class="name"><?= htmlspecialchars($user['name']) ?></p>
        <p class="text"><?= htmlspecialchars($user['description']) ?></p>
        <div class="posts">
            <img src="static/images/post.png" alt="пост" class="posts_img" />
            <p class="posts_p"><?= $user['posts_count'] ?> постов</p>
        </div>
    </div>

    <!-- Галерея -->
    <div class="photos">
        <?php foreach ($user['gallery'] as $photo): ?>
            <img src="<?= htmlspecialchars($photo) ?>" alt="Фото" class="photos_img" />
        <?php endforeach; ?>
    </div>
</body>
</html>