<div class="post">
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
</div>