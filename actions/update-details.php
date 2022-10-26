<?php

    include '../_config/dbconn.php';
    
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';

    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $contant_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';

    if(!empty($id)) {
        $update = "UPDATE users SET first_name = '$first_name',last_name = '$last_name',email = '$email',gender = '$gender',contact_no = '$contant_no' WHERE id = '$id'";

        if (mysqli_query($conn, $update)) {
            echo json_encode(array("statusCode"=>200,"message"=>'User details updated.'));
        } 
        else {
            echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong. Internal server error."));
        }
    }
?>