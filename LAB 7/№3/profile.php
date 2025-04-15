<?php
$users = json_decode(file_get_contents('users.json'), true);
$user = $users[0];
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
        <a href="home.html"
          ><img src="static/images/home.png" alt="домой" class="menu_img"
        /></a>
      </div>
      <div class="profile">
        <a href="profile.html"
          ><img src="static/images/profile.png" alt="профиль" class="menu_img"
        /></a>
        <div class="menu_dot">
          <img src="static/images/Dot.png" alt="точка" />
        </div>
      </div>
      <div class="login">
        <a href="login.html"
          ><img src="static/images/plus.png" alt="войти" class="menu_img"
        /></a>
      </div>
    </div>
  <?php include 'profile_template.php'; ?>
</body>
</html>