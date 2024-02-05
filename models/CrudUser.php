<?php

class UserCrud {
    private $crud;

    function __construct(Crud $crud) { //use dependency injection
        $this->crud = $crud;
    }

    function createUser(UserModel $user) { //use dependency injection, etc.
        
    }

    function readUserByEmail($email) {
        //I dont use emails yet.
    }

    function updateUser(UserModel $user) {

    }

}


//I think the datalayer functions should be converted and written in here:

function add_user_database_pdo($connection, $user, $hashedPassword) {
    //Insert user data into database
    $insertQuery = "INSERT INTO username (username, password_hashed) VALUES (?, ?)";
    $stmt = $connection->prepare($insertQuery);
    
    if (!$stmt) {
        // Handle the case where prepare() fails
        echo "Error: " . $connection->error; // Output the error message
        return false;
    }
    
    //Bind parameters and execute query
    $stmt->bind_param("ss", $user, $hashedPassword);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        return true; //user insertion succesful
    } else {
        return false; //failed
    }
    }

function retrieve_userdata($connection, $user) {

        // Prevent mysql injections
        $user = mysqli_real_escape_string($connection, $user);
        
        //Gets username from the 'username' table instead of ID
        $query = "SELECT password_hashed FROM username WHERE username = '$user'";
        $result = mysqli_query($connection, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            //Username exists, return array with password_hashed for verification
            $userData = mysqli_fetch_assoc($result);
            return $userData;
        } else {
            //Username does not exist, nothing to return
            return null;
        }	
}

function get_username_id($connection, $user) {
	
    //Sanitize user input 
$user = mysqli_real_escape_string($connection, $user);

	//Gets username ID from the 'username' table
    $query = "SELECT id FROM username WHERE username = '$user'";
    $result = mysqli_query($connection, $query);
	if (!$result) {
        die("Database query failed.");  //improve error handling here
    } 

    if ($row = mysqli_fetch_assoc($result)) {
        $userId = $row['id'];
    } else {
        //username not found
        $userId = null;
    }
    // Free result set resleaset the memory used
    mysqli_free_result($result);
    
    return $userId;
}



?>