<?php
$user = current(array_filter($users, fn($u) => $u['id'] == 1));
?>

<div class="profile-content">
  <img src="<?= $user['avatar'] ?>" alt="Иван" class="avatar" />
  <div class="description">
    <p class="name"><?= $user['name'] ?></p>
    <p class="text"><?= $user['description'] ?></p>
    <div class="posts">
      <img src="static/images/post.png" alt="пост" class="posts_img" />
      <p class="posts_p"><?= count(array_filter($posts, fn($p) => $p['user_id'] == 1)) ?> постов</p>
    </div>
  </div>
  <div class="photos">
    <?php foreach (array_filter($posts, fn($p) => $p['user_id'] == 1) as $post): ?>
      <img src="<?= $post['image'] ?>" alt="photo" class="photos_img" />
    <?php endforeach; ?>
  </div>
</div>