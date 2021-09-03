<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Candidate.php');

    $database = new Database();
    $db = $database->connect();

    $candidate = new Candidate($db);


    if (!isset($_GET["id"])){
        echo json_encode(
            array('message' => 'Invalid Request')
        );
    }
    else {
        $candidate->id = $_GET["id"];
         //get candidate
        $candidate->read_single();

        $arr = array(
            'id' => $candidate->id,
            'name' => $candidate->name,
            'email' => $candidate->email,
            'password' => $candidate->password,
            'interviewed' => $candidate->interviewed,
            'count' => 1
        );

        if(!isset($candidate->name)){
            echo json_encode(
                array(
                    'message' => 'No candidate found',
                    'count' => 0
                )
            );
        }
        else {
            print_r(json_encode($arr));
        }
        
    }
    

   