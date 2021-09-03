<?php

class Hr{

    private $conn;
    private $table = 'hr';

    //Properties 
    public $id; 
    public $name; 
    public $email;
    public $password;
    
    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function login(){

        $query = "SELECT * FROM hr WHERE email = ? AND password = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        
        //bind
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);

        $stmt->execute();
        return $stmt;

    }

    public function create(){

        $query = "INSERT INTO hr SET name = :name, email = :email, password = :password";
        $stmt = $this->conn->prepare($query);
        
        //clean
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //bind
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()){
            return true;
        }
        
        //printf("Error: %s. \n", $stmt->error);
        return false;
        
    }

}