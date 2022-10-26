<?php 
    include '../_config/dbconn.php';

    $email = isset($_POST['email']) ? $_POST['email'] : '' ;


    if(!empty($email)) {

        $not_active = "SELECT * FROM users WHERE email = '$email'";

        $check = mysqli_query($conn,$not_active);

        if(mysqli_num_rows($check) > 0){

            $row = mysqli_fetch_array($check);

            $user_id = $row['id'];

            if($row['is_active'] == "N") {
                $checkEmail = "SELECT email FROM active_account WHERE email = '$email'";

                $checkResult = mysqli_query($conn,$checkEmail);
        
                if(mysqli_num_rows($checkResult) > 0) {
                    echo json_encode(array("statusCode"=>403,"message"=>'Already you send request.'));
                }
                else {
                    $req_date = date("Y-m-d");
                    $insert = "INSERT INTO active_account (user_id,email,request_date) VALUES ('$user_id','$email','$req_date')";
        
                    if(mysqli_query($conn,$insert)) {
                        echo json_encode(array("statusCode"=>200,"message"=>'Your request has been send, Our team will reply within 24hours.'));
                    }else {
                        echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
                    }
                }
            }else {
                echo json_encode(array("statusCode"=>500,"message"=>"Your account is already active, So please login"));
            }
           
        }else{
            echo json_encode(array("statusCode"=>500,"message"=>"You not register, Please register your account"));
        }
    }
?>