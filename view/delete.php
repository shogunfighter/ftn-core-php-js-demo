<?php

require_once __DIR__ . '/../model/user.model.php';
require_once __DIR__ . '/../controller/user.controller.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['id'])) {
        echo 'ID is required';
        exit;
    }

    $id = $_POST['id'];
    $userController = new UserController(new UserModel());
    $deletionResult = $userController->deleteUser($id);

    echo $deletionResult ? 'User deleted successfully!' : 'Failed to delete user.';
}