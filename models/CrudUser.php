<?php

require_once "Crud.php";

class UserCrud {
    private $crud; //property storing instance of generic crud class
    private $table;

    public function __construct(Crud $crud, $table = "users") { //use dependency injection
        $this->crud = $crud;
        $this->table = $table;
    }

    public function createUser($username, $password) { //use dependency injection, etc.
        $sql = "INSERT INTO $this->table (username, password_hashed) VALUES (?, ?)";
        $params = [$username, $password];
        return $this->crud->createRow($sql, $params);
    }

    public function readUserByUsername($username) {
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $params = [$username];
        return $this->crud->readOneRow($sql, $params);
    }

    public function retrieveUserData($column, $username) {
        $sql = "SELECT $column FROM $this->table WHERE username = ?";
        $params = [$username];
        $data = $this->crud->readOneRow($sql, $params);
        //this fetches an object. how to make it usable? like so:
        if ($data && isset($data->$column)) {
            return $data->$column;
        } else {
            return null;
        }
    }

    public function getUserId($username) {
        $sql = "SELECT id FROM $this->table WHERE username = ?";
        $params = [$username];
        $userId = $this->crud->readOneRow($sql, $params);
    }

    public function updateUser($userId, $newUsername) {
        $sql = "UPDATE $this->table SET username = ? WHERE id = ?";
        $params = [$newUsername, $userId];
        return $this->crud->updateRow($sql, $params);
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $params = [$userId];
        return $this->crud->deleteRow($sql, $params);
    }
}

?>