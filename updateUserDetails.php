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
        if($_POST['user_code']){

            // Variables For Data Update -> Get Data From Front End
            $user_code = $_POST['user_code'];
            $full_name = $_POST['full_name'];
            $mobile_number = (int)$_POST['mobile_number'];
            $faculty = $_POST['faculty'];
            $email = $_POST['email'];
            

            // Create Sql Statement
            $sql = "UPDATE user_details SET  full_name ='{$full_name}', mobile_number = '{$mobile_number}', faculty = '{$faculty}', email ='{$email}'  WHERE user_code = '{$user_code}'";
            
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
