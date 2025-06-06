<?php
require_once 'db_connect.php';

$stmt = $pdo->query("
    SELECT posts.*, users.name, users.avatar 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.timestamp DESC
");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Главная</title>
  <link rel="stylesheet" href="static/styles/menu_style.css" />
  <link rel="stylesheet" href="static/styles/home_style.css" />
</head>
<body class="page">
  <nav class="menu">
    <div class="menu__item menu__item--home">
      <a href="home.php" class="menu__link">
        <img src="static/images/home.png" alt="домой" class="menu__icon" />
      </a>
      <div class="menu__indicator">
        <img src="static/images/Dot.png" alt="точка" />
      </div>
    </div>
    <div class="menu__item">
      <a href="profile.php" class="menu__link">
        <img src="static/images/profile.png" alt="профиль" class="menu__icon" />
      </a>
    </div>
    <div class="menu__item">
      <a href="login.html" class="menu__link">
        <img src="static/images/plus.png" alt="войти" class="menu__icon" />
      </a>
    </div>
  </nav>

  <main class="feed">
    <?php foreach ($posts as $post): 
        $images = !empty($post['images']) ? [$post['images']] : [];
    ?>
      <article class="post">
        <header class="post__header">
          <a href="profile.php?id=<?= $post['user_id'] ?>" class="post__avatar-link">
            <img src="<?= htmlspecialchars($post['avatar']) ?>" alt="аватар" class="post__avatar" />
          </a>
          <a href="profile.php?id=<?= $post['user_id'] ?>" class="post__author-link">
            <p class="post__author-name"><?= htmlspecialchars($post['name']) ?></p>
          </a>
          <a href="profile.php?id=<?= $post['user_id'] ?>" class="post__edit-link">
            <img src="static/images/pensil.png" alt="карандаш" class="post__edit-icon" />
          </a>
        </header>
        
        <div class="post__slider" id="slider-<?= $post['id'] ?>">
          <?php foreach ($images as $index => $image): ?>
            <div class="post__slide <?= $index === 0 ? 'active' : '' ?>">
              <img src="<?= htmlspecialchars($image) ?>" alt="пост" />
            </div>
          <?php endforeach; ?>
          
          <?php if (count($images) > 1): ?>
            <div class="post__slider-indicator">
              <span class="current-slide">1</span>/<span class="total-slides"><?= count($images) ?></span>
            </div>
            <button class="post__slider-button post__slider-button--prev"></button>
            <button class="post__slider-button post__slider-button--next"></button>
          <?php endif; ?>
        </div>
        
        <div class="post__actions">
          <button class="post__like">
            <img src="static/images/heart.png" alt="сердце" class="post__like-icon" />
            <span class="post__like-count"><?= (int)$post['likes'] ?></span>
          </button>
        </div>
        
        <div class="post__content">
          <p class="post__text collapsed"><?= htmlspecialchars($post['text']) ?></p>
          <a href="#" class="post__more-link" data-action="expand">
              <p class="post__more-text">ещё</p>
          </a>
          <time class="post__time"><?= date('d.m.Y H:i', (int)$post['timestamp']) ?></time>
        </div>
      </article>
    <?php endforeach; ?>
  </main>

  <div id="imageModal" class="modal">
    <div class="modal__content">
      <button class="modal__close"></button>
      <div class="modal__slider"></div>
      <div class="modal__slider-indicator">
        <span id="modalCurrentSlide">1</span>/<span id="modalTotalSlides">0</span>
      </div>
      <button class="modal__slider-button modal__slider-button--prev"></button>
      <button class="modal__slider-button modal__slider-button--next"></button>
    </div>
  </div>

  <script src="static/scripts/home.js"></script>
</body>
</html>