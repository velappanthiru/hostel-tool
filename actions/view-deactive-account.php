<?php 

    include '../_config/dbconn.php';

    $select = "SELECT * FROM active_account WHERE is_active = 'N'";

    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0) {

        
        $idrow = array();

        $details = array();

        while ($ID = $result->fetch_assoc()) {
            $idrow[] = $ID['user_id'];
        }

        
        for ($i=0; $i < count($idrow); $i++) { 
            $getdetails = "SELECT id,first_name,last_name,email,contact_no,is_active FROM users WHERE id='$idrow[$i]'";

            $getResult = mysqli_query($conn,$getdetails);

            if(mysqli_num_rows($getResult) > 0) {

                while ($row = $getResult->fetch_assoc()) {
                    $details[] = $row;
                }
            }
        }
    
        if(count($details) > 0) {
            echo json_encode(array("statusCode"=>200,"details"=>$details));   
        }else {
            echo json_encode(array("statusCode"=>404,"message"=>"No data available."));
        }
    }else {
        echo json_encode(array("statusCode"=>404,"message"=>"No data available."));
    }

?>