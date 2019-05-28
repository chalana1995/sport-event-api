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
    // SQL Statement
    $sql = "SELECT * FROM add_result";
    // Connect To DB
    if($mysql->connect_error){
        $response["MESSAGE"] = "ERROR IN SERVER";
        $response["STATUS"] = 500;
    }
    else{
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

    echo json_encode($response);

?>