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

    // Check DB Error
    if($mysql->connect_error){
        $response["MESSAGE"] = "ERROR IN SERVER";
        $response["STATUS"] = 500;
    }
    else{
        if($_POST['event_code']) {

            // Variables For Data Update -> Get Data From Front End
            $event_code = $_POST['event_code'];
            

            // Create Sql Statement
            $sql = "DELETE FROM event_details WHERE event_code = '{$event_code}'";
            
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