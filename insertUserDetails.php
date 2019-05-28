<?php
include "Crud.php";
$crud= new Crud();
//Get Data From Fornt End
$data = json_decode(file_get_contents("php://input"));
//Define Error Msg
$err_msg = "No Data";
//Insert Data
if($data != null){
    $query="INSERT INTO user_details(username,password,user_type,user_code,full_name,mobile_number,faculty,email) 
    VALUES ('$data->username','$data->password','$data->user_type','$data->user_code','$data->full_name',
    '$data->mobile_number','$data->faculty','$data->email')";
    $data=$crud->execute($query);

    if($data){
        echo json_encode($data);
    }
    else{
        echo json_encode(array('msg' => 'error in inserting'));
    }
}
else{
    echo json_encode($err_msg);
}
?>