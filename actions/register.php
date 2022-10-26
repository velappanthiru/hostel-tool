<?php include '../_config/dbconn.php' ?>

<?php 


    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';

    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $contant_no = isset($_POST['contant_no']) ? $_POST['contant_no'] : '';

    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';


    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($gender) && !empty($contant_no) && !empty($password) && !empty($cpassword)) {

        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $reg_date = date("Y-m-d");

        $checkemail = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkemail); 
        if(mysqli_num_rows($result) > 0) {
            echo json_encode(array("statusCode"=>403,"message"=>"Email is already exits"));
        }
        else {
            $userInsert = "INSERT INTO `users` (`first_name`,`last_name`,`email`,`gender`,`contact_no`,`password`,`reg_date`)
            VALUES ('$first_name','$last_name','$email','$gender','$contant_no','$hashPassword','$reg_date')";


            if (mysqli_query($conn, $userInsert)) {
                echo json_encode(array("statusCode"=>200,"message"=>'New user added.'));
            } 
            else {
                echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
            }
        }
        // ======== Close Connection
        mysqli_close($conn);
    }

    

?>