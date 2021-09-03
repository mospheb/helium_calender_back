<?php
    //Headers
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Authorization, Content-Type,
    // Access-Control-Allow-Method');

    include_once('../../config/Database.php');
    include_once('../../models/Interview.php');

    $database = new Database();
    $db = $database->connect();

    $interview = new Interview($db);

    //get all submitted data
    $data = json_decode(file_get_contents("php://input"));

    $interview->candidate_name = $data->candidate_name;
    $interview->candidate_email = $data->candidate_email;
    $interview->interviewer_email = $data->interviewer_email;
    $interview->int_month = $data->int_month;
    $interview->int_day = $data->int_day;
    $interview->int_time = $data->int_time;
    $interview->status = $data->status;
    $interview->ddate = $data->ddate;

    if($interview->create()){
        echo json_encode(
            array(
                'message' => 'Interview Scheduled',
                'status' => 'success'
            )
        );
    }
    else {
        echo json_encode(
            array(
                'message' => 'Interview not scheduled',
                'status' => 'error'
            )
        );
    }