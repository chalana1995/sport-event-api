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
        if($_POST['result_code']){

            // Variables For Data Update -> Get Data From Front End
            $result_code = $_POST['result_code'];
            $event_name = $_POST['event_name'];
            $team_a = $_POST['team_a'];
            $team_b = $_POST['team_b'];
            $result = $_POST['result'];
            

            // Create Sql Statement
            $sql = "UPDATE add_result SET event_name ='{$event_name}', team_a = '{$team_a}' , team_b = '{$team_b}' , result = '{$result}' WHERE result_code = '{$result_code}'";
            
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
