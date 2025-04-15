<img src="<?= $user['avatar'] ?>" alt="Иван" class="avatar" />
<div class="description">
  <p class="name"><?= $user['name'] ?></p>
  <p class="text"><?= $user['description'] ?></p>
  <div class="posts">
    <img src="static/images/post.png" alt="пост" class="posts_img" />
    <p class="posts_p"><?= $user['posts_count'] ?> постов</p>
  </div>
</div>
<div class="photos">
  <?php foreach ($user['gallery'] as $photo): ?>
    <img src="<?= $photo ?>" alt="photo" class="photos_img" />
  <?php endforeach; ?>
</div>