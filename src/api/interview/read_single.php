<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Interview.php');

    $database = new Database();
    $db = $database->connect();

    $interview = new Interview($db);

    if (!isset($_GET["int_month"])){
        echo json_encode(
            array('message' => 'Invalid Request')
        );
    }
    else {

        $interview->int_month = $_GET["int_month"];

        $interview->read_single();

        $arr = array(
            'id' => $interview->id,
            'candidate_name' => $interview->candidate_name,
            'candidate_email' => $interview->candidate_email,
            'interviewer_email' => $interview->interviewer_email,
            'int_month' => $interview->int_month,
            'int_day' => $interview->int_day,
            'int_time' => $interview->int_time,
            'status' => $interview->status,
            'ddate' => $interview->ddate,
            'count' => 1

        );

        if(!isset($interview->candidate_name)){
            echo json_encode(
                array(
                    'message' => 'No Interview Scheduled',
                    'count' => 0
                )
            );
        }
        else {
            print_r(json_encode($arr));
        }

    }