<?php

require_once "Crud.php";

class UserCrud {
    private $crud; //property storing instance of generic crud class

    function __construct(Crud $crud) { //use dependency injection
        $this->crud = $crud;
    }

    function createUser($username, $password) { //use dependency injection, etc.
        $table = "username";
        $sql = "INSERT INTO $table (username, password_hashed) VALUES (?, ?)";
        $params = [$username, $password];
        return $this->crud->createRow($sql, $params);
    }

    function readUserByUsername($username) {
        $table = "username";
        $sql = "SELECT * FROM $table WHERE username = ?";
        $params = [$username];
        return $this->crud->readOneRow($sql, $params);
    }

    //I do not think the above method is necessary, 
    //I think the below method handles all necessary 
    //operations related to retrieving userdata

    function retrieveUserData($column, $username) {
        $table = "username";
        $sql = "SELECT $column FROM $table WHERE username = ?";
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
        $table = "username";
        $sql = "SELECT id From $table WHERE username = ?";
        $params = [$username];
        $userId = $this->crud->readOneRow($sql, $params);
    }

    function updateUser($userId, $newUsername) {
        $table = "username";
        $sql = "UPDATE $table SET username = ? WHERE id = ?";
        $params = [$newUsername, $userId];
        return $this->crud->updateRow($sql, $params);
    }

    public function deleteUser($userId) {
        $table = "username";
        $sql = "DELETE FROM $table WHERE id = ?";
        $params = [$userId];
        return $this->crud->deleteRow($sql, $params);
    }

}

// Create an instance of the Crud class (assuming it's implemented elsewhere)
$crud = new Crud(/* Pass any necessary parameters */);

	// Create an instance of the UserCrud class
	$userCrud = new UserCrud($crud);
	
	// Call the retrieveUserData() method with the specified parameters
	$column = "password_hashed";
	$username = "100";
	$userData = $userCrud->retrieveUserData($column, $username);
	
	// Output the result
	var_dump($userData);


//I think the datalayer functions should be converted and written in here



?>