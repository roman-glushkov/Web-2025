<?php
// Загружаем данные из JSON
$users = json_decode(file_get_contents('users.json'), true);
$posts = json_decode(file_get_contents('posts.json'), true);
$user = $users[0];

// Получаем количество постов пользователя
$userPostsCount = 0;
$userGallery = [];
foreach ($posts as $post) {
    if ($post['user_id'] == $user['id']) {
        $userPostsCount++;
        $userGallery[] = $post['image'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Профиль</title>
  <link rel="stylesheet" href="static/styles/menu_style.css" />
  <link rel="stylesheet" href="static/styles/profile_style.css" />
</head>
<body>
  <div class="menu">
    <div class="home">
      <a href="home.php"><img src="static/images/home.png" alt="домой" class="menu_img" /></a>
    </div>
    <div class="profile">
      <a href="profile.php"><img src="static/images/profile.png" alt="профиль" class="menu_img" /></a>
      <div class="menu_dot">
        <img src="static/images/Dot.png" alt="точка" />
      </div>
    </div>
    <div class="login">
      <a href="login.html"><img src="static/images/plus.png" alt="войти" class="menu_img" /></a>
    </div>
  </div>

  <img src="<?= $user['avatar'] ?>" class="avatar" />
  <div class="description">
    <p class="name"><?= $user['name'] ?></p>
    <p class="text"><?= $user['description'] ?></p>
    <div class="posts">
      <img src="static/images/post.png" alt="пост" class="posts_img" />
      <p class="posts_p"><?= $userPostsCount ?> постов</p>
    </div>
  </div>
  <div class="photos">
    <?php foreach ($userGallery as $photo): ?>
      <img src="<?= $photo ?>" alt="photo" class="photos_img" />
    <?php endforeach; ?>
  </div>
  
</body>
</html>