<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Interviewer.php');

    $database = new Database();
    $db = $database->connect();

    $interviewer = new Interviewer($db);

    if (!isset($_GET["id"])){
        echo json_encode(
            array('message' => 'Invalid Request')
        );
    }
    else {

        $interviewer->id = $_GET["id"];

        //get interviewer
        $interviewer->read_single();
        //get row count
        
        $arr = array(
            'id' => $interviewer->id,
            'name' => $interviewer->name,
            'email' => $interviewer->email,
            'password' => $interviewer->password,
            'completed_interview' => $interviewer->completed_interview,
            'count' => 1
        );

        if(!isset($interviewer->name)){
            echo json_encode(
                array(
                    'message' => 'No Interviewer available',
                    'count' => 0
                )
            );
        }
        else {
            print_r(json_encode($arr));
        }
    }