<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Interview.php');

    $database = new Database();
    $db = $database->connect();

    $interview = new Interview($db);

    if (!isset($_GET["month"]) || !isset($_GET["email"])){
        echo json_encode(
            array('message' => 'Invalid Request')
        );
    }
    else {
        $interview->int_month = $_GET["month"];
        $interview->candidate_email = $_GET["email"];

        //get candidate
        $result = $interview->read_candidate_two();

        //get row count
        $num = $result->rowCount();

        if ($num > 0){
            $interview_array = array();
            $interview_array['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $item = array(
                    'id' => $id,
                    'candidate_name' => $candidate_name,
                    'candidate_email' => $candidate_email,
                    'interviewer_email' => $interviewer_email,
                    'int_month' => $int_month,
                    'int_day' => $int_day,
                    'int_time' => $int_time,
                    'status' => $status,
                    'ddate' => $ddate
                );
            
                array_push($interview_array['data'], $item);
            }
           
            $interview_array += array("count" => $num);
            echo json_encode($interview_array);
        }
        else {
            echo json_encode(
                array(
                    'message' => 'No Interview Scheduled',
                    'count' => 0
                )
            );
        }

    }
    
