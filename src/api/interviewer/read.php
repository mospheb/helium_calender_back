<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Interviewer.php');

    $database = new Database();
    $db = $database->connect();

    $interviewer = new Interviewer($db);

    $result = $interviewer->read();
    //get row count
    $num = $result->rowCount();

    if ($num > 0){
        $interview_array = array();
        $interview_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $item = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'completed_interview' => $completed_interview
            );
            
            array_push($interview_array['data'], $item);
        }
        
        $interview_array += array("count" => $num);
        echo json_encode($interview_array);
    }
    else {
        echo json_encode(
            array(
                'message' => 'No Interviewer available',
                'count' => 0
            )
        );
    }