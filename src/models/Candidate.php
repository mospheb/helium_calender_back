<?php

class Candidate{

    private $conn;
    private $table = 'candidate';

    //Properties 
    public $id; 
    public $name; 
    public $email;
    public $password;
    public $interviewed;
    
    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        //prepare query
        $query = "SELECT * FROM candidate ORDER BY name DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function login(){

        $query = "SELECT * FROM candidate WHERE email = ? AND password = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        
        //bind
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);

        $stmt->execute();
        return $stmt;

    }

    public function read_single(){

        $query = "SELECT * FROM candidate WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;

    }

    public function create(){

        $query = "INSERT INTO candidate SET name = :name, email = :email, password = :password, interviewed = :interviewed";
        $stmt = $this->conn->prepare($query);
        
        //clean
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->interviewed = htmlspecialchars(strip_tags($this->interviewed));

        //bind
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':interviewed', $this->interviewed);

        if($stmt->execute()){
            return true;
        }
        
        //printf("Error: %s. \n", $stmt->error);
        return false;
        
    }
}