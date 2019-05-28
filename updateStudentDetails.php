<?php

    // Header Details
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Control-Type, Accept");

    // Connection Variables
    define("SERVER","localhost");
    define("USER","root");
    define("PASSWORD","");
    define("DB","sport_event");

    // Create Connection
    $mysql = new mysqli(SERVER,USER,PASSWORD,DB);
    // Response Array
    $response = array();

    if($mysql->connect_error){
        $response["MESSAGE"] = "ERROR IN SERVER";
        $response["STATUS"] = 500;
    }
    else{
        if($_POST['index_no']){

            // Variables For Data Update -> Get Data From Front End
            $fullname = $_POST['fullname'];
            $age = (int)$_POST['age'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $tel_no = (int)$_POST['tel_no'];
            $participant_event = $_POST['participant_event'];
            $address = $_POST['address'];

            // Create Sql Statement
            $sql = "UPDATE student_details SET fullname = '{$fullname}', age = '{$age}', email = '{$email}', tel_no = '{$tel_no}', participant_event = '{$participant_event}', address = '{$address}' WHERE index_no = '{$index_no}'";
            
            // Run Insert Query
            if($mysql->query($sql)){
                $response["MESSAGE"] = "UPDATE SUCCESS";
                $response["STATUS"] = 200;
            }
            else{
                $response["MESSAGE"] = "UPDATE ERROR";
                $response["STATUS"] = 404;
            }
        }
        else{
            $response["MESSAGE"] = "INVALID REQUEST";
            $response["STATUS"] = 400;
        }
    }

    echo json_encode($response);

?>
