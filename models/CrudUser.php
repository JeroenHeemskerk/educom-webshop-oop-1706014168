<?php

require_once "Crud.php";

class UserCrud {
    private $crud; //property storing instance of generic crud class
    private $table;

    function __construct(Crud $crud, $table = "username") { //use dependency injection
        $this->crud = $crud;
        $this->table = $table;
    }

    function createUser($username, $password) { //use dependency injection, etc.
        $sql = "INSERT INTO $this->table (username, password_hashed) VALUES (?, ?)";
        $params = [$username, $password];
        return $this->crud->createRow($sql, $params);
    }

    function readUserByUsername($username) {
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $params = [$username];
        return $this->crud->readOneRow($sql, $params);
    }

    function retrieveUserData($column, $username) {
        $sql = "SELECT $column FROM $this->table WHERE username = ?";
        $params = [$username];
        $data = $this->crud->readOneRow($sql, $params);
        //this fetches an object. how to make it usable?
        if ($data && isset($data->$column)) {
            return $data->$column;
        } else {
            return null;
        }
    }

    function getUserId($username) {
        $sql = "SELECT id FROM $this->table WHERE username = ?";
        $params = [$username];
        $userId = $this->crud->readOneRow($sql, $params);
    }

    function updateUser($userId, $newUsername) {
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

//Create an instance of the Crud class (assuming it's implemented elsewhere)
$crud = new Crud();

	//Create an instance of the UserCrud class
	$userCrud = new UserCrud($crud);
	
	//Calls the retrieveUserData() method with the specified parameters
	$column = "password_hashed";
	$username = "100";
	$userData = $userCrud->retrieveUserData($column, $username);


//I think the datalayer functions should be converted and written in here



?>