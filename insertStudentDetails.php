<?php
include "Crud.php";
$crud= new Crud();
//Get Data From Fornt End
$data = json_decode(file_get_contents("php://input"));
//Define Error Msg
$err_msg = "No Data";
//Insert Data
if($data != null){
    $query="INSERT INTO student_details(fullname,age,gender,index_no,email,tel_no,participant_event,address) 
    VALUES ('$data->fullname','$data->age','$data->gender','$data->index_no','$data->email',
    '$data->tel_no','$data->participant_event','$data->address')";
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