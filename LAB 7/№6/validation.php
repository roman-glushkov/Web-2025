\<?php
// validation.php

/**
 * Валидация данных пользователей
 * @param array $users Массив пользователей
 * @return array Массив с ошибками валидации
 */
function validateUsers(array $users): array {
    $errors = [];
    
    foreach ($users as $index => $user) {
        // Проверка ID
        if (!isset($user['id'])) {
            $errors[] = "Пользователь #$index: отсутствует ID";
            continue;
        }

        // Проверка имени
        if (!isset($user['name']) || strlen($user['name']) < 2 || strlen($user['name']) > 50) {
            $errors[] = "Пользователь #{$user['id']}: имя должно быть от 2 до 50 символов";
        }

        // Проверка аватара
        if (!isset($user['avatar']) || !filter_var($user['avatar'], FILTER_VALIDATE_URL)) {
            $errors[] = "Пользователь #{$user['id']}: неверный формат аватара (должен быть URL)";
        }

        // Проверка описания
        if (!isset($user['description']) || strlen($user['description']) > 200) {
            $errors[] = "Пользователь #{$user['id']}: описание должно быть не более 200 символов";
        }
    }

    return $errors;
}

/**
 * Валидация данных постов
 * @param array $posts Массив постов
 * @return array Массив с ошибками валидации
 */
function validatePosts(array $posts): array {
    $errors = [];
    
    foreach ($posts as $post) {
        // Проверка ID
        if (!isset($post['id'])) {
            $errors[] = "Пост #$index: отсутствует ID";
            continue;
        }

        // Проверка user_id
        if (!isset($post['user_id']) || !is_numeric($post['user_id'])) {
            $errors[] = "Пост #{$post['id']}: неверный user_id";
        }

        // Проверка изображения
        if (!isset($post['image']) || !filter_var($post['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Пост #{$post['id']}: неверный формат изображения (должен быть URL)";
        }

        // Проверка текста
        if (!isset($post['text']) || strlen($post['text']) > 500) {
            $errors[] = "Пост #{$post['id']}: текст должен быть не более 500 символов";
        }

        // Проверка лайков
        if (!isset($post['likes']) || !is_numeric($post['likes']) || $post['likes'] < 0) {
            $errors[] = "Пост #{$post['id']}: количество лайков должно быть неотрицательным числом";
        }

        // Проверка timestamp
        if (!isset($post['timestamp']) || !is_numeric($post['timestamp']) || $post['timestamp'] > time() || $post['timestamp'] < 0) {
            $errors[] = "Пост #{$post['id']}: неверная временная метка";
        }
    }

    return $errors;
}

/**
 * Проверка всех данных
 * @return array Массив с ошибками валидации
 */
function validateAllData(): array {
    $errors = [];
    
    // Загружаем данные
    $users = json_decode(file_get_contents('users.json'), true);
    $posts = json_decode(file_get_contents('posts.json'), true);

    // Проверяем, что данные загрузились
    if ($users === null) {
        $errors[] = "Ошибка загрузки users.json";
    }
    if ($posts === null) {
        $errors[] = "Ошибка загрузки posts.json";
    }

    // Если данные загрузились, валидируем их
    if ($users !== null) {
        $userErrors = validateUsers($users);
        $errors = array_merge($errors, $userErrors);
    }
    
    if ($posts !== null) {
        $postErrors = validatePosts($posts);
        $errors = array_merge($errors, $postErrors);
    }

    return $errors;
}
?>