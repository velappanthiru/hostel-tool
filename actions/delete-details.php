<?php 

    include '../_config/dbconn.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if(!empty($id)) {
        $delete = "UPDATE users SET is_active = 'N' WHERE id ='$id'";

        $result = mysqli_query($conn,$delete);

        if ($result) {
            echo json_encode(array("statusCode"=>200,"message"=>"User delete successfully."));
        }else {
            echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong. Internal server error."));
        }
    }

?>