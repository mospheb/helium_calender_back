<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Candidate.php');

    $database = new Database();
    $db = $database->connect();

    $candidate = new Candidate($db);

    //get all submitted data
    $data = json_decode(file_get_contents("php://input"));

    $candidate->email = $data->email;
    $candidate->password = $data->password;

    $result = $candidate->login();
    
    //get row count
    $num = $result->rowCount();

    if ($num > 0){
        $arr = array();
        $arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $item = array(
                'name' => $name,
                'email' => $email,
                'category' => 'Candidate'
            );
            array_push($arr['data'], $item);
        }
        
        $arr += array("status" => 'success');
        echo json_encode($arr);
    }
    else {
        echo json_encode(
            array("status" => 'error')
        );
    }

