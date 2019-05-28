<?php
include "Crud.php";
$crud= new Crud();
//Get Data From Fornt End
$data = json_decode(file_get_contents("php://input"));
//Define Error Msg
$err_msg = "No Data";
//Insert Data
if($data != null){
    $query="INSERT INTO comment_area(name, comment) 
    VALUES ('$data->name','$data->comment')";
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