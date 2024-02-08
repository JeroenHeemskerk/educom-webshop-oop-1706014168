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
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_OBJ); //fetching as object

            return $row;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function readMultipleRows($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetches all rows as associative array

            return $rows;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    //following methods unused:

    public function updateRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            //how many rows affected:
            return $stmt->rowCount();

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->rowCount();

        } catch(PDOException $e) {
            echo "Error " . $e->getmessage();
            return false;
        }
    }

}

?>