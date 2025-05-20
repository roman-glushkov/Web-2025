<?php
// Загружаем данные
$users = json_decode(file_get_contents('users.json'), true);
$posts = json_decode(file_get_contents('posts.json'), true);

// Получаем и валидируем ID
$userId = $_GET['id'] ?? null;

// Редирект в случаях:
// 1. Параметр не передан
// 2. Параметр некорректный
if ($userId === null || !is_numeric($userId)) {
    header("Location: home.php");
    exit();
}

$userId = (int)$userId;
$user = current(array_filter($users, fn($u) => $u['id'] === $userId));

// 3. Пользователь не существует
if (empty($user)) {
    header("Location: home.php");
    exit();
}

// Функция для получения постов пользователя
function getUserPosts($posts, $userId) {
    return array_filter($posts, fn($p) => $p['user_id'] === $userId);
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
  <div class="menu">
    <div class="home">
      <a href="home.php"><img src="static/images/home.png" alt="домой" class="menu_img" /></a>
    </div>
    <div class="profile">
      <a href="profile.php?id=<?= $userId ?>"><img src="static/images/profile.png" alt="профиль" class="menu_img" /></a>
      <div class="menu_dot">
        <img src="static/images/Dot.png" alt="точка" />
      </div>
    </div>
    <div class="login">
      <a href="login.html"><img src="static/images/plus.png" alt="войти" class="menu_img" /></a>
    </div>
  </div>

  <div class="profile-content">
    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="<?= htmlspecialchars($user['name']) ?>" class="avatar" />
    <div class="description">
      <p class="name"><?= htmlspecialchars($user['name']) ?></p>
      <p class="text"><?= htmlspecialchars($user['description']) ?></p>
      <div class="posts">
        <img src="static/images/post.png" alt="пост" class="posts_img" />
        <p class="posts_p"><?= count(getUserPosts($posts, $userId)) ?> постов</p>
      </div>
    </div>
    <div class="photos">
      <?php foreach (getUserPosts($posts, $userId) as $post): ?>
        <img src="<?= htmlspecialchars($post['image']) ?>" alt="post" class="photos_img" />
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>