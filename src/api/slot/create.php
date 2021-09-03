<?php
    //Headers
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Authorization, Content-Type,
    // Access-Control-Allow-Method');

    include_once('../../config/Database.php');
    include_once('../../models/Slot.php');

    $database = new Database();
    $db = $database->connect();

    $slot = new Slot($db);

    //get all submitted data
    $data = json_decode(file_get_contents("php://input"));

    $slot->name = $data->name;
    $slot->email = $data->email;
    $slot->int_month = $data->int_month;
    $slot->int_day = $data->int_day;
    $slot->int_time = $data->int_time;
    $slot->ddate = $data->ddate;

    if($slot->create()){
        echo json_encode(
            array(
                'message' => 'Slot created',
                'status' => 'success'
            )
        );
    }
    else {
        echo json_encode(
            array(
                'message' => 'Slot not created',
                'status' => 'error'
            )
        );
    }