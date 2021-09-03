<?php

class Interview{

    private $conn;
    private $table = 'interview';

    //Properties 
    public $id; 
    public $candidate_name; 
    public $candidate_email;
    public $interviewer_email;
    public $int_day;
    public $int_month;
    public $int_time;
    public $status;
    public $ddate;
    
    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function read_single(){

        $query = "SELECT * FROM interview WHERE int_month = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->execute();

        return $stmt;

    }

    public function read_candidate_two(){

        $query = "SELECT * FROM interview WHERE int_month = ? AND candidate_email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->candidate_email);

        $stmt->execute();

        return $stmt;

    }

    public function read_interviewer_two(){

        $query = "SELECT * FROM interview WHERE int_month = ? AND interviewer_email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->interviewer_email);

        $stmt->execute();

        return $stmt;
    }

    public function read_three(){

        $query = "SELECT * FROM interview WHERE int_month = ? AND int_day = ? AND int_time = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->int_month);
        $stmt->bindParam(2, $this->int_day);
        $stmt->bindParam(3, $this->int_time);

        $stmt->execute();

        return $stmt;
    }

 
    public function create(){

        $query = "INSERT INTO interview 
            SET 
                candidate_name = :candidate_name, 
                candidate_email = :candidate_email, 
                interviewer_email = :interviewer_email, 
                int_day = :int_day, 
                int_month = :int_month, 
                int_time = :int_time, 
                status = :status, 
                ddate = :ddate";

        $stmt = $this->conn->prepare($query);
        
        //clean
        $this->candidate_name = htmlspecialchars(strip_tags($this->candidate_name));
        $this->candidate_email = htmlspecialchars(strip_tags($this->candidate_email));
        $this->interviewer_email = htmlspecialchars(strip_tags($this->interviewer_email));
        $this->int_day = htmlspecialchars(strip_tags($this->int_day));
        $this->int_month = htmlspecialchars(strip_tags($this->int_month));
        $this->int_time = htmlspecialchars(strip_tags($this->int_time));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->ddate = htmlspecialchars(strip_tags($this->ddate));

        //bind
        $stmt->bindParam(':candidate_name', $this->candidate_name);
        $stmt->bindParam(':candidate_email', $this->candidate_email);
        $stmt->bindParam(':interviewer_email', $this->interviewer_email);
        $stmt->bindParam(':int_day', $this->int_day);
        $stmt->bindParam(':int_month', $this->int_month);
        $stmt->bindParam(':int_time', $this->int_time);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':ddate', $this->ddate);

        if($stmt->execute()){
            return true;
        }
        
        //printf("Error: %s. \n", $stmt->error);
        return false;
        
    }
}