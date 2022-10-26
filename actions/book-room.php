<?php 

    include '../_config/dbconn.php';

    $branch = isset($_POST['branch']) ? $_POST['branch'] : '';

    $room_number = isset($_POST['room_number']) ? $_POST['room_number'] : '';

    $seater = isset($_POST['seater']) ? $_POST['seater'] : '';

    $total_duration = isset($_POST['total_duration']) ? $_POST['total_duration'] : '';

    $food_status = isset($_POST['food_status']) ? $_POST['food_status'] : '';

    $fees = isset($_POST['fees']) ? $_POST['fees'] : '';

    $ad_amount = isset($_POST['ad_amount']) ? $_POST['ad_amount'] : '';

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';

    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';

    $available_seat = isset($_POST['available_seat']) ? $_POST['available_seat'] : '';

    $number_seat = isset($_POST['number_seat']) ? $_POST['number_seat'] : '';

    $guardian_name = isset($_POST['guardian_name']) ? $_POST['guardian_name'] : '';

    $relation = isset($_POST['relation']) ? $_POST['relation'] : '';

    $relation_contact_no = isset($_POST['relation_contact_no']) ? $_POST['relation_contact_no'] : '';

    $curr_address = isset($_POST['curr_address']) ? $_POST['curr_address'] : '';

    $curr_city = isset($_POST['curr_city']) ? $_POST['curr_city'] : '';

    $curr_state = isset($_POST['curr_state']) ? $_POST['curr_state'] : '';

    $curr_pincode = isset($_POST['curr_pincode']) ? $_POST['curr_pincode'] : '';

    $permanent_address = isset($_POST['permanent_address']) ? $_POST['permanent_address'] : '';

    $permanent_city = isset($_POST['permanent_city']) ? $_POST['permanent_city'] : '';

    $permanent_state = isset($_POST['permanent_state']) ? $_POST['permanent_state'] : '';

    $permanent_pincode = isset($_POST['permanent_pincode']) ? $_POST['permanent_pincode'] : '';

    $insert = "INSERT INTO  book_room (`branch`,`room_num`,`seater`,`total_duration`,`food_status`,`fees_per_month`,`advance_fees`,`first_name`,`last_name`,`email`,`gender`,`contact_no`,`num_seat`,`guardian_name`,`guardian_relation`,`guardian_number`,`current_address`,`current_city`,`current_state`,`current_pincode`,`permanent_address`,`permanent_city`,`permanent_state`,`permanent_pincode`) VALUES('$branch','$room_number','$seater','$total_duration','$food_status','$fees','$ad_amount','$first_name','$last_name','$email','$gender','$contact_no','$number_seat','$guardian_name','$relation','$relation_contact_no','$curr_address','$curr_city','$curr_state','$curr_pincode','$permanent_address','$permanent_city','$permanent_state','$permanent_pincode')";

    $result = mysqli_query($conn,$insert);

    if($result) {
        $setavailseat = $available_seat - $number_seat;

        $upd = "UPDATE room_details SET `avail_seat` = '$setavailseat' WHERE branch = '$branch' AND room_num = '$room_number'";

        if (mysqli_query($conn, $upd)) {
            echo json_encode(array("statusCode"=>200,"message"=>'Your room has been booked.'));
        } 
        else {
            echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
        }
    }
?>