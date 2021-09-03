<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/Database.php');
    include_once('../../models/Slot.php');

    $database = new Database();
    $db = $database->connect();

    $slot = new Slot($db);

    if (!isset($_GET["month"]) || !isset($_GET["day"])){
        echo json_encode(
            array('message' => 'Invalid Request')
        );
    }
    else {
        $slot->int_month = $_GET["month"];
        $slot->int_day = $_GET["day"];

        //get candidate
        $result = $slot->read_two();

        //get row count
        $num = $result->rowCount();

        if ($num > 0){
            $slot_array = array();
            $slot_array['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'int_month' => $int_month,
                    'int_day' => $int_day,
                    'int_time' => $int_time,
                    'ddate' => $ddate
                );
                
                array_push($slot_array['data'], $item);
            }

            $slot_array += array("count" => $num);
            echo json_encode($slot_array);
        }
        else {
            echo json_encode(
                array(
                    'message' => 'No Slot found',
                    'count' => 0
                )
            );
        }

    }
