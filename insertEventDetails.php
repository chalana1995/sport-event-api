<?php
include "Crud.php";
$crud= new Crud();
//Get Data From Fornt End
$data = json_decode(file_get_contents("php://input"));
//Define Error Msg
$err_msg = "No Data";
//Insert Data
if($data != null){

    // Query
    $query="INSERT INTO event_details(img_url,event_code,event_name,event_venue,event_date,descrption) 
    VALUES ('$data->img_url','$data->event_code','$data->event_name','$data->event_venue','$data->event_date',
    '$data->descrption')";

    $data = $crud->execute($query);

    echo json_encode($data);
}
else{
    echo json_encode($err_msg);
}
?>
    
    
    