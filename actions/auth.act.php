

<?php 

    include '../_config/dbconn.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $password = isset($_POST['password']) ? $_POST['password'] : '';


    if(!empty($email) && !empty($password)){
        $sql = "select * from users where email = '$email'";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $get_password = $row['password'];
            $get_id = $row['role_id'];
            $hash = password_verify($password, $get_password);
            $is_active = $row['is_active'];

            if($is_active == 'Y') {
                if($hash) {

                    $_SESSION['user_id'] = $row['id'];
    
                    $_SESSION['is_authenticated'] = TRUE;
                    $_SESSION['last_activity'] = time();
    
                    $role = "SELECT * FROM roles WHERE id = '$get_id'";
    
                    $roleRes = mysqli_query($conn,$role);
    
                    if(mysqli_num_rows($roleRes) > 0) {
                        $roleRow = mysqli_fetch_array($roleRes);
                    }
    
                    echo json_encode(array("statusCode"=>200,"message"=>'Login Successfully',"role"=>$roleRow['name']));
                }else {
                    echo json_encode(array("statusCode"=>500,"message"=>"Invalid Credentials"));
                }
            }else {
                echo json_encode(array("statusCode"=>403,"message"=>"Account is not active, Please wait automactically redirect active account page."));
            }
            
        }else {
            echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong, Internal server error."));
        }
    }
?>