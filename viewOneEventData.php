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
        
        if($_POST['event_code']) {

            $event_code = $_POST['event_code'];

            // Create Sql Statement
            $sql = "SELECT * FROM event_details WHERE event_code = '{$event_code}'";
            
           // Run Query
           $result = $mysql->query($sql);

           if($result->num_rows > 0){
               while($row = $result->fetch_assoc()){
                   // Get Data
                   $response[] = $row;
                }
            }
            else{
                $response["MESSAGE"] = "NO DATA";
                $response["STATUS"] = 204;
            }
        }
        else{
            $response["MESSAGE"] = "INVALID REQUEST";
            $response["STATUS"] = 400;
        }
    }

    echo json_encode($response);

?>