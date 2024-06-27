<?php

class UserController {
    private $model;

    public function __construct($model) { $this->model = $model; } 
    public function getAllUsers() { $users = $this->model->getAllUsers(); return $users; }
    public function getUser($id) { $user = $this->model->getUserById($id); return $user; }
    public function createUser($data) { $user = $this->model->createUser($data); return $user; }
    public function updateUser($id, $data) { $user = $this->model->updateUser($id, $data); return $user; }
    public function deleteUser($id) { $user = $this->model->deleteUser($id); return $user; }
}