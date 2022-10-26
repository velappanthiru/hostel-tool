<?php 

    include '../_config/dbconn.php';

    $select = "SELECT * FROM active_account WHERE is_active = 'N'";

    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0) {

        $emailrow = array();
        $idrow = array();

        while ($ID = $result->fetch_assoc()) {
            $emailrow[] = $ID['email'];
        }

        for ($i=0; $i < count($emailrow); $i++) { 

            $checkEmail = "SELECT id,email FROM users WHERE email = '$emailrow[$i]'";

            $emailResult = mysqli_query($conn,$checkEmail);
    
            if(mysqli_num_rows($emailResult) > 0) {
                
                // output data of each row
                while($row = $emailResult->fetch_assoc()) {
                    $idrow[] = $row['id'];
                }
                
            }
        }

       
        if(count($idrow) > 0) {
            echo json_encode(array("statusCode"=>200,"details"=>$idrow));   
        }else {
            echo json_encode(array("statusCode"=>404,"message"=>"No notification available."));
        }
    }else {
        echo json_encode(array("statusCode"=>404,"message"=>"No notification available."));
    }


    // $select = "SELECT active_account.user_id,active_account.email,users.first_name,users.last_name FROM active_account FULL OUTER JOIN users ON active_account.user_id = users.id WHERE active_account.is_active ='N'";

    // $result = mysqli_query($conn,$select);
    // echo("Error description: " . $result -> error);
    //     exit();
    // if(mysqli_num_rows($result) > 0) {
    //     $idrow= array();
    //     while($row = $result->fetch_assoc()) {
    //         $idrow[] = $row['id'];
    //     }

    //     echo json_encode($idrow);
    // }else {

    // }

?>