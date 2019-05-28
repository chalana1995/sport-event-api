<?php
// Access Origing -> Common For All 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type , Accept");
 define("SERVER","localhost");
 define("USER","root");
 define("PASSWORD","");
 define("DB","sport_event");

 $mysql = new mysqli(SERVER,USER,PASSWORD,DB);

 $response = array();

 if($mysql->connect_error){
    $response["MESSAGE"] = "ERROR IN SERVER";
    $response["STATUS"] = 500; 
 }
 else{

    if($_POST["username"] && $_POST["password"]){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT COUNT(id) AS userlog, user_type AS usertype, username AS username FROM user_details WHERE username = '{$username}' AND password = '{$password}'";
        $result = $mysql->query($sql);
        if($result == false){
            $response["MESSAGE"] = "QUERY ERROR";
            $response["STATUS"] = 422; 
         }
         else{
            while($row=$result->fetch_assoc()){
                if($row["userlog"] == 1){
                    $response["MESSAGE"] = "AUTHORIZED USER";
                    $response["USERTYPE"] = $row["usertype"];
                    $response["USERNAME"] = $row["username"];
                    $response["STATUS"] = 200;
                }
                else{
                    $response["MESSAGE"]="UNAUTHORIZED USER";
                    $response["STATUS"] = 401;
                }
            }
        }
    }
    else{
        $response["MESSAGE"] = "BAD REQUEST";
        $response["STATUS"] = 400;
    }
 }

 echo json_encode($response);

?>