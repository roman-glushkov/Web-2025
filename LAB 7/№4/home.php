<?php
$posts = json_decode(file_get_contents('posts.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Страница</title>
    <link rel="stylesheet" href="static/styles/menu_style.css" />
    <link rel="stylesheet" href="static/styles/home_style.css" />
</head>
<body>
    <div class="menu">
      <div class="home">
        <a href="home.html"
          ><img src="static/images/home.png" alt="домой" class="menu_img"
        /></a>
        <div class="menu_dot">
          <img src="static/images/Dot.png" alt="точка" />
        </div>
      </div>
      <div class="profile">
        <a href="profile.html"
          ><img src="static/images/profile.png" alt="профиль" class="menu_img"
        /></a>
      </div>
      <div class="login">
        <a href="login.html"
          ><img src="static/images/plus.png" alt="войти" class="menu_img"
        /></a>
      </div>
    </div>
  <div class="news">
    <?php foreach ($posts as $post): ?>
      <?php include 'home_template.php'; ?>
    <?php endforeach; ?>
  </div>
</body>
</html>