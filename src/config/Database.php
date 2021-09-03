<?php

    class Database {

        private $host = "db";
        private $username = "root";
        private $password = "example";
        private $db_name = "helium";
        private $conn;

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_983dae9b34546a0", 'b643084ced9bb6', 'eedc389c');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // $this->conn = new PDO('mysql:host=' .$this->host. ';dbname= ' .$this->db_name, 
                // $this->username, 'example');
                // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                echo "Connection error " .$e->getMessage();
            }

            return $this->conn;
        }
    }