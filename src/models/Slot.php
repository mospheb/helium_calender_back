<?php

class Slot{

    private $conn;
    private $table = 'slot';

    //Properties 
    public $id; 
    public $name; 
    public $email;
    public $int_day;
    public $int_month;
    public $int_time;
    public $ddate;
    
    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        //prepare query
        $query = "SELECT * FROM slot";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_two(){

        $query = "SELECT * FROM slot WHERE int_month = ? AND int_day = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->int_day);

        $stmt->execute();

        return $stmt;

    }

    public function read_three(){

        $query = "SELECT * FROM slot WHERE int_month = ? AND int_day = ? AND int_time = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->int_day);
        $stmt->bindParam(3, $this->int_time);

        $stmt->execute();

        return $stmt;
    }

    public function read_four(){

        $query = "SELECT * FROM slot WHERE int_month = ? AND int_day = ? AND int_time = ? AND email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->int_day);
        $stmt->bindParam(3, $this->int_time);
        $stmt->bindParam(4, $this->email);

        $stmt->execute();

        return $stmt;
    }

    public function create(){

        $query = "INSERT INTO slot 
            SET 
                name = :name, 
                email = :email, 
                int_day = :int_day, 
                int_month = :int_month, 
                int_time = :int_time, 
                ddate = :ddate";
                
        $stmt = $this->conn->prepare($query);
        
        //clean
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->int_day = htmlspecialchars(strip_tags($this->int_day));
        $this->int_month = htmlspecialchars(strip_tags($this->int_month));
        $this->int_time = htmlspecialchars(strip_tags($this->int_time));
        $this->ddate = htmlspecialchars(strip_tags($this->ddate));

        //bind
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':int_day', $this->int_day);
        $stmt->bindParam(':int_month', $this->int_month);
        $stmt->bindParam(':int_time', $this->int_time);
        $stmt->bindParam(':ddate', $this->ddate);

        if($stmt->execute()){
            return true;
        }
        
        //printf("Error: %s. \n", $stmt->error);
        return false;
        
    }
}