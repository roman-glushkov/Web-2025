<?php
require_once 'db_connect.php';

if (isset($_GET['id'])) {
    $postId = (int)$_GET['id'];
    $stmt = $pdo->prepare("
        SELECT posts.*, users.name, users.avatar 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE posts.id = ?
    ");
    $stmt->execute([$postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($post): ?>
        <div class="post">
            <div class="header">
                <a href="profile.php?id=<?= $post['user_id'] ?>">
                    <img src="<?= htmlspecialchars($post['avatar']) ?>" alt="аватар" class="avatar" />
                </a>
                <a href="profile.php?id=<?= $post['user_id'] ?>" class="link">
                    <p class="header_p"><?= htmlspecialchars($post['name']) ?></p>
                </a>
                <a href="profile.php?id=<?= $post['user_id'] ?>">
                    <img src="static/images/pensil.png" alt="карандаш" class="pensil" />
                </a>
            </div>
            <img src="<?= htmlspecialchars($post['images']) ?>" alt="пост" class="new_photo" />
            <div class="heart">
                <a href="#"><img src="static/images/heart.png" alt="сердце" /></a>
                <p class="heart_p"><?= (int)$post['likes'] ?></p>
            </div>
            <div class="info">
                <p><?= htmlspecialchars($post['text']) ?></p>
                <a href="#"><p class="more">ещё</p></a>
                <p class="time"><?= date('d.m.Y H:i', (int)$post['timestamp']) ?></p>
            </div>
        </div>
    <?php endif;
}
?>