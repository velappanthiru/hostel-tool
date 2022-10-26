<?php 

    include '../_config/dbconn.php';

    $room_num = isset($_POST['room_num']) ? $_POST['room_num'] : '' ;

    $seater = isset($_POST['seater']) ? $_POST['seater'] : '' ;

    $branch = isset($_POST['branch']) ? $_POST['branch'] : '' ;

    $fees = isset($_POST['fees']) ? $_POST['fees'] : '' ;

    if(!empty($room_num) && !empty($seater) && !empty($branch) && !empty($fees)) {
        $check_room = "SELECT * FROM room_details WHERE room_num = '$room_num' && branch = '$branch'";

        $check_result = mysqli_query($conn,$check_room);

        if(mysqli_num_rows($check_result) > 0) {
            echo json_encode(array("statusCode"=>403,"message"=>"This Room is already added"));
        } else {
            $reg_date = date("Y-m-d");
            $room_add = "INSERT INTO room_details (room_num,seater,avail_seat,branch,fees,lunch_date) VALUES ('$room_num','$seater','$seater','$branch','$fees','$reg_date')";

            if (mysqli_query($conn, $room_add)) {
                echo json_encode(array("statusCode"=>200,"message"=>'New Room added.'));
            } 
            else {
                echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong. Internal server error."));
            }
        }
    }

?>