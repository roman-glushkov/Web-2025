<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Новый пост</title>
    <link rel="stylesheet" href="static/styles/menu_style.css" />
    <link rel="stylesheet" href="static/styles/create_style.css" />
  </head>
  <body class="page">
    <nav class="menu">
      <div class="menu__item menu__item--home">
        <a href="home.php" class="menu__link">
          <img src="static/images/home.png" alt="домой" class="menu__icon" />
        </a>
      </div>
      <div class="menu__item">
        <a href="profile.php" class="menu__link">
          <img src="static/images/profile.png" alt="профиль" class="menu__icon" />
        </a>
      </div>
      <div class="menu__item">
        <a href="create.php" class="menu__link">
          <img src="static/images/plus.png" alt="войти" class="menu__icon" />
        </a>
      </div>
    </nav>
    <div class="form">
      <input type="file" id="fileInput" accept="image/*" style="display: none;" multiple />
      <div class="form_blok" id="uploadArea">
        <div class="post__slider" id="imageSlider">
        </div>
        <div class="form_blok_empty" id="emptyState">
          <img src="static/images/picture.png" alt="пикча" class="form_blok_picture" />
          <button class="form_blok_button" id="uploadButton1">Добавить фото</button>
        </div>
      </div>
      <div class="form_adding">
        <img src="static/images/square.png" alt="plus" class="form_adding_plus" />
        <button class="form_adding_text" id="uploadButton2">Добавить фото</button>
      </div>
      <input type="text" class="form_input" id="captionInput" placeholder="Добавьте подпись..." />
      <button class="form_impart" id="shareButton" disabled>Поделиться</button>
    </div>
    <script src="static/scripts/create.js"></script>
  </body>
</html>