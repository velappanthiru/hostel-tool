<?php 

    include '../_config/dbconn.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    if(!empty($id)) {
        $getDetails = "SELECT id,first_name,last_name,email,contact_no,gender,is_active FROM users WHERE id = '$id'";

        $result = mysqli_query($conn,$getDetails);

        if (mysqli_num_rows($result) > 0) {
            $row = $result -> fetch_assoc();
            echo json_encode(array("statusCode"=>200,"message"=>"details","data" => $row ));
        }else {
            echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong. Internal server error."));
        }
    }

?>