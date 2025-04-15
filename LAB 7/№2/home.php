<?php
// Загружаем посты из JSON
$posts = json_decode(file_get_contents('posts.json'), true);
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
    <?php foreach ($posts as $post): ?>
      <div class="header">
        <a href="profile.php">
          <img src="<?= $post['user_avatar'] ?>" alt="аватар" class="avatar" />
        </a>
        <a href="profile.php" class="link">
          <p class="header_p"><?= $post['user_name'] ?></p>
        </a>
        <a href="profile.php">
          <img src="static/images/pensil.png" alt="карандаш" class="pensil" />
        </a>
      </div>
      <img src="<?= $post['image'] ?>" alt="пост" class="new_photo" />
      <div class="heart">
        <a href="#"><img src="static/images/heart.png" alt="сердце" /></a>
        <p class="heart_p"><?= $post['likes'] ?></p>
      </div>
      <div class="info">
        <p><?= $post['text'] ?></p>
        <a href="#"><p class="more">ещё</p></a>
        <p class="time"><?= date('d.m.Y H:i', $post['timestamp']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>