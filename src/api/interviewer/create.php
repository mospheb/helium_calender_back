<?php
    //Headers
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Authorization, Content-Type,
    // Access-Control-Allow-Method');

    include_once('../../config/Database.php');
    include_once('../../models/Interviewer.php');

    $database = new Database();
    $db = $database->connect();

    $interviewer = new Interviewer($db);

    //get all submitted data
    $data = json_decode(file_get_contents("php://input"));

    $interviewer->name = $data->name;
    $interviewer->email = $data->email;
    $interviewer->password = $data->password;
    $interviewer->completed_interview = $data->completed_interview;

    if($interviewer->create()){
        echo json_encode(
            array(
                'message' => 'Interviewer registered',
                'status' => 'success'
            )
        );
    }
    else {
        echo json_encode(
            array(
                'message' => 'Interviewer not registered',
                'status' => 'error'
            )
        );
    }