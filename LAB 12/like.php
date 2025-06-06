<?php
$current_user_id = 1;

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'] ?? null;

if (!$post_id) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$posts = json_decode(file_get_contents('posts.json'), true);
$updated = false;

foreach ($posts as &$post) {
    if ($post['id'] == $post_id) {
        if (in_array($current_user_id, $post['likes'])) {
            $post['likes'] = array_diff($post['likes'], [$current_user_id]);
        } else {
            $post['likes'][] = $current_user_id;
        }
        $updated = true;
        break;
    }
}

if ($updated && file_put_contents('posts.json', json_encode($posts, JSON_PRETTY_PRINT))) {
    echo json_encode([
        'success' => true,
        'likes' => $post['likes'],
        'count' => count($post['likes']),
        'is_liked' => in_array($current_user_id, $post['likes'])
    ]);
} else {
    echo json_encode(['error' => 'Update failed']);
}