<?php

require_once __DIR__ . '/../model/user.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (empty($_GET['id'])) {
        echo json_encode(['error' => 'ID is required']);
        exit;
    }

    $userId = $_GET['id'];
    $userModel = new UserModel();
    $user = $userModel->getUserById($userId);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}