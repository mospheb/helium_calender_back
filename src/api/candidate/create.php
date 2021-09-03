<?php
    //Headers
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Authorization, Content-Type,
    // Access-Control-Allow-Method');

    include_once('../../config/Database.php');
    include_once('../../models/Candidate.php');

    $database = new Database();
    $db = $database->connect();

    $candidate = new Candidate($db);

    //get all submitted data
    $data = json_decode(file_get_contents("php://input"));

    $candidate->name = $data->name;
    $candidate->email = $data->email;
    $candidate->password = $data->password;
    $candidate->interviewed = $data->interviewed;

    if($candidate->create()){
        echo json_encode(
            array(
                'message' => 'Candidate registered',
                'status' => 'success'
            )
        );
    } 
    else {
        echo json_encode(
            array(
                'message' => 'Candidate not registered',
                'status' => 'error'
            )
        );
    }