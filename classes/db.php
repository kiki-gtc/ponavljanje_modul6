<?php

//Za uključivanje prikaza grešaka na web stranici
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

class Database {

    private $connection;
    private $dbhost = DB_HOST;
    private $database = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    public function __construct() {

        

        try {

            
            $result = new PDO("mysql:host=$this->dbhost;dbname=$this->database", $this->user, $this->pass);

            
            $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection = $result;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function get_all() {

        $data = [];
        
        try {
            $statement = $this->connection->prepare("SELECT * FROM tablica");

            $statement->execute();

            if($statement->rowCount()) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            } 

            return $data;

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert($params) {

        try {

            $data = $params['auti'];

            $statement = $this->connection->prepare("INSERT INTO tablica (auti) VALUES (:auti)");

            $statement->bindParam(':auti', $data);

            $statement->execute();

            header('Location: index.php');
            exit();

        } catch(PDOException $e) {
            return $e->getMessage();
        }
 
    }

    public function edit($id) {

        $data  = [];

        $statement = $this->connection->prepare("SELECT * FROM tablica WHERE id = :id");

        $statement->bindParam(':id', $id);
        
        $statement->execute();

        if($statement->rowCount()) {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function update($params) {

        try {

            $statement = $this->connection->prepare("UPDATE tablica SET auti = :auti WHERE id = :id");

            $statement->bindParam(':id', $params['id']);
            $statement->bindParam(':auti', $params['auti']);

            $statement->execute();

            header('Location: index.php');
            exit();

        } catch(PDOException $e) {
            return $e->getMessage();
        }
 
    }

    public function delete($id) {
        
        $statement = $this->connection->prepare("DELETE FROM tablica WHERE id = :id");

        $statement->bindParam(':id', $id);
    
        $statement->execute();
    
        header('Location: index.php');
        exit();
    }
}

?>