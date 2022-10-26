<?php 

    include '../_config/dbconn.php';

    $select = "SELECT id,first_name,last_name,email,contact_no,gender FROM users WHERE is_active ='Y'";

    $result = mysqli_query($conn,$select);
    if($result) {
        if($result->num_rows > 0){ 
    
            $EtyArray = array();
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $EtyArray[] = $row;
            }
            
            echo json_encode(array("statusCode"=>200,"data"=>$EtyArray));   
        } 
    }else {
        echo json_encode(array("statusCode"=>500,"message"=>"Something went wrong. Internal server error."));
    }

?>