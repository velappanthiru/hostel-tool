<?php 

    include '../_config/dbconn.php';

    $room_details = "SELECT * FROM room_details";

    $result = mysqli_query($conn,$room_details);

    if(mysqli_num_rows($result) > 0) {
        $details = array();
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        echo json_encode(array("statusCode"=>200,"data"=>$details));   
    }else {
        echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
    }

?>