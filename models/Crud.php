<?php 

class Crud {

    //setting properties with default values
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "shops";

    protected $pdo;

    public function __construct() {
        $this->connect();
    }

    //Use PDO object to access database
    protected function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $this->pdo = new PDO($dsn, $this->user, $this->pwd);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetches associative array
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function runSelectQuery($data, $table) {
        try {
            $query = "SELECT $data FROM $table";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(); //Fetching all rows
        } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
           return false;
        }
    }

    public function createRow($sql, $params) {
        //Prepare statement
        try {
        $stmt = $this->pdo->prepare($sql);

        //Execute statement with parameters
        $stmt->execute($params);

        //Retrieve ID last inserted row
        $rowId = $this->pdo->lastInsertId();
        
        return $rowId;

        } catch(PDOException $e) {
            //Handle errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function readOneRow($sql, $params) {


    }

    public function readMultipleRows($sql, $params) {

    }

    public function updateRow($sql, $params) {

    }

    public function deleteRow($sql, $params) {

    }
}

$crud = new Crud();

$data = 'username, password_hashed';
$table = 'username';

$result = $crud->runSelectQuery($data, $table);

if ($result !== false) {
    var_dump($result);
} else {
    echo "an error occurred while executing query";
}

$sql = "INSERT INTO username (username, password_hashed) VALUES (?, ?)";
$params = ["testingCRUD", "CRUD"];

$rowId = $crud->createRow($sql, $params);

if($rowId !== false) {
    echo "Row inserted succesfully. RowId: $rowId";
} else {
    echo "unsuccessful";
}


?>