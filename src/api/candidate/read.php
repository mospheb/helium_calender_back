<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Candidate.php');

    $database = new Database();
    $db = $database->connect();

    $candidate = new Candidate($db);

    $result = $candidate->read();
    //get row count
    $num = $result->rowCount();

    if ($num > 0){
        $candidate_array = array();
        $candidate_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $item = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'interviewed' => $interviewed
            );
            
            array_push($candidate_array['data'], $item);
        }
       
        $candidate_array += array("count" => $num);
        echo json_encode($candidate_array);
    }
    else {
        echo json_encode(
            array(
                'message' => 'No candidate found',
                'count' => 0
            )
        );
    }