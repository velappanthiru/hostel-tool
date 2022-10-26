<?php 
    include '../_config/dbconn.php';

    $branch = isset($_GET['branch']) ? $_GET['branch'] : '' ;

    $getRoom = "SELECT room_num FROM room_details WHERE branch='$branch' AND avail_seat > 0";

    $roomResult = mysqli_query($conn,$getRoom);

    $roomDetails = array();
  
    if(mysqli_num_rows($roomResult) > 0) {
        while ($row = $roomResult->fetch_assoc()) {
            # code...
            $roomDetails[] = $row;
        }
    }

    if(count($roomDetails) > 0) {
        echo json_encode(array("statusCode"=>200,"data"=>$roomDetails));   
    }else {
        echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
    }
?>