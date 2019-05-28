<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type , Accept");
// Main Variable
// Response Array
$response = array();
// Image Url
// Development -> http://localhost/sport-event-api/images/
// Production -> 
$image_url = "http://localhost/sport-event-api/images/";
$default_image_url = "http://localhost/sport-event-api/images/default_image.png";
// Check Image Is Set 
if(isset($_FILES['image_file'])){
    if(is_uploaded_file($_FILES['image_file']['tmp_name'])){
        // Get Upload Directry
        if(isset($_POST['upload_dir'])){
            // Image Upload Variables
            // Main Directry
            $main_dir = "./images/";
            // Upload Valid
            $uploadOk = 0;
            // Upload Directry
            $upload_dir = $_POST['upload_dir'];
            // Upload File
            $upload_file = $main_dir . $upload_dir . "/" . basename($_FILES["image_file"]["name"]);
            // Upload Directry Path
            $upload_dir_path = $main_dir . $upload_dir . "/";
            // Upload File Type
            $uploadFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image_file"]["tmp_name"]);
            if($check !== false) {
                $response["MIME"] = $check["mime"];
                $uploadOk = 1;
            } else {
                $response["CODE"] = 4;
                $response["TOPIC"] = "Not Image Error";
                $response["MSG"] = "Image Is Not An Image. Please Check It Again";
                $uploadOk = 0;
            }
            // Check if upload path is exists
            if(!file_exists($upload_dir_path)){
                $response["CODE"] = 4;
                $response["TOPIC"] = "Folder Path Exits Error";
                $response["MSG"] = "Folder Name : " . $upload_dir . " .Dose Not Exits In Server. Please Check In Again OR Contact Your Developer";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($upload_file)) {
                $response["CODE"] = 4;
                $response["TOPIC"] = "Image Already Exits Error";
                $response["MSG"] = "Sorry Image File Is Already Exists. Please Check It Again OR Try Image With Another Name".$upload_file;
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image_file"]["size"] > 500000) {
                $response["CODE"] = 4;
                $response["TOPIC"] = "Image Size Error";
                $response["MSG"] = "Sorry Image File Is Too Large. Please Try Upload Smaller Image Again";
                $uploadOk = 0;
            }
            // Check file formats
            if($uploadFileType != "jpg" && $uploadFileType != "png" && $uploadFileType != "jpeg") {
                $response["CODE"] = 4;
                $response["TOPIC"] = "Image Format Error";
                $response["MSG"] = "Sorry Only JPG, JPEG, PNG & GIF Images Are Allowed. Please Try Upload Image With JPG, JPEG, PNG Again";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk != 0) {
                // If everything is ok, try to upload file
                if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $upload_file)) {
                    $name = basename( $_FILES["image_file"]["name"]);
                    $response["CODE"] = 2;
                    $response["TOPIC"] = "Upload Success";
                    $response["MSG"] = $name." - Image Is Upload Successfully.";
                    $image_url = $image_url . $upload_dir . "/" . $name;
                    $response["IMAGE_URL"] = $image_url;
                } else {
                    $response["CODE"] = 4;
                    $response["TOPIC"] = "Upload Error";
                    $response["MSG"] = "Image Upload Error.";
                }
            } 
        }
    }
    else{
        $response["CODE"] = 3;
        $response["TOPIC"] = "Upload Error";
        $response["MSG"] = "Image Is Not Upload Correctly. Please Check It Again";
        $response["IMAGE_URL"] = $default_image_url;
    }
}
else{
    $response["CODE"] = 3;
    $response["TOPIC"] = "Upload Error";
    $response["MSG"] = "Image Is Not Set Correctly. Please Check It Again";
    $response["IMAGE_URL"] = $default_image_url;
}
// Return Final Response To Front End
echo json_encode($response);
?>