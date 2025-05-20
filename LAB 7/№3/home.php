<?php
// Загружаем данные
$posts = json_decode(file_get_contents('posts.json'), true);
$users = json_decode(file_get_contents('users.json'), true);

// Функция для получения пользователя по ID
function getUserById($users, $id) {
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Главная</title>
  <link rel="stylesheet" href="static/styles/menu_style.css" />
  <link rel="stylesheet" href="static/styles/home_style.css" />
</head>
<body>
  <div class="menu">
    <div class="home">
      <a href="home.php"><img src="static/images/home.png" alt="домой" class="menu_img" /></a>
      <div class="menu_dot">
        <img src="static/images/Dot.png" alt="точка" />
      </div>
    </div>
    <div class="profile">
      <a href="profile.php"><img src="static/images/profile.png" alt="профиль" class="menu_img" /></a>
    </div>
    <div class="login">
      <a href="login.html"><img src="static/images/plus.png" alt="войти" class="menu_img" /></a>
    </div>
  </div>

  <div class="news">
    <?php foreach ($posts as $post): 
        $user = getUserById($users, $post['user_id']);
        include 'post_template.php';
    endforeach; ?>
  </div>
</body>
</html>