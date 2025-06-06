<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
$uploadDir = __DIR__ . '/../static/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    $uploadedFiles = [];
    $errors = [];
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $originalName = basename($_FILES['images']['name'][$key]);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $newFilename = uniqid() . '.' . $extension;
                $targetPath = $uploadDir . $newFilename;
                
                if (move_uploaded_file($tmpName, $targetPath)) {
                    $uploadedFiles[] = 'static/uploads/' . $newFilename;
                } else {
                    $errors[] = "Ошибка загрузки файла: $originalName";
                }
            }
        }
    }
    
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }
    $postsFile = __DIR__ . '/../posts.json';
    $posts = [];
    
    if (file_exists($postsFile)) {
        $posts = json_decode(file_get_contents($postsFile), true);
    }
    $newPost = [
        'id' => count($posts) + 1,
        'user_id' => 1, 
        'images' => $uploadedFiles,
        'text' => $caption,
        'likes' => 0,
        'timestamp' => time()
    ];
    array_unshift($posts, $newPost);
    if (file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Ошибка записи в файл']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не разрешен']);
}