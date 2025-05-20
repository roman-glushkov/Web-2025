<div class="profile-content">
  <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="<?= htmlspecialchars($user['name']) ?>" class="avatar" />
  <div class="description">
    <p class="name"><?= htmlspecialchars($user['name']) ?></p>
    <p class="text"><?= htmlspecialchars($user['description']) ?></p>
    <div class="posts">
      <img src="static/images/post.png" alt="пост" class="posts_img" />
      <p class="posts_p"><?= count(getUserPosts($posts, $user['id'])) ?> постов</p>
    </div>
  </div>
  <div class="photos">
    <?php foreach (getUserPosts($posts, $user['id']) as $post): ?>
      <img src="<?= htmlspecialchars($post['image']) ?>" alt="post" class="photos_img" />
    <?php endforeach; ?>
  </div>
</div>