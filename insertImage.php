<?php
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

     if(is_uploaded_file($_FILES['user_image']['tmp_name']) && $_POST["user_name"]){
         $temp_file = $_FILES["user_image"]["tmp_name"];
         $img_name = $_FILES["user_image"]["name"];
         $upload_dir = "./images/".$img_name;

         $sql = "INSERT INTO test(name,url) VALUES ('{$_POST['user_name']}','{$img_name}')";

         if(move_uploaded_file($temp_file,$upload_dir) && $mysql->query($sql)){
            $response["MESSAGE"] = "UPLOAD SUCCESS";
            $response["STATUS"] = 200; 
         }
         else{
            $response["MESSAGE"] = "UPLOAD ERROR";
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