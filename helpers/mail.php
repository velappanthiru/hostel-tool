<?php 

    include '../_config/dbconn.php';

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '' ;

    if(!empty($id)) {

        $select = "SELECT email,first_name,last_name,is_active FROM users WHERE id ='$id'";

        $selectResult = mysqli_query($conn,$select);

        if(mysqli_num_rows($selectResult) > 0){

            $up = "UPDATE active_account SET is_active = 'Y' WHERE user_id ='$id'";
            $result = mysqli_query($conn,$up);
            
            if($result) {
                $row = mysqli_fetch_array($selectResult);

                $is_active = $row['is_active'];
    
                $email = $row['email'];
    
                $first_name = $row['first_name'];
    
                $last_name = $row['last_name'];
    
                if($is_active == 'N') {
                    $update = "UPDATE users SET is_active = 'Y' WHERE id ='$id'";
    
                    if(mysqli_query($conn,$update)) {
                        try {
                            $mail = new PHPMailer(true);
                            //Server settings
                            // $mail->SMTPDebug = 4;                                    //Enable verbose debug output
                            $mail->isSMTP();    
                                                        
                            $mail->Host       = 'smtp.gmail.com';                        //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
                            $mail->Username   = '';                 //  SMTP username or email
                            $mail->Password   = '';                      // SMTP password or app password
                            $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
                            $mail->Port       = 587;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                            //Recipients
                            $mail->setFrom('tvelappan99@gmail.com', 'velappan');
                            $mail->addAddress('r377911@gmail.com');                       //Add a recipient
                        
                    
                            //Content
                            $mail->isHTML(true);                                          //Set email format to HTML
                            $mail->Subject = 'approved mail';
                            $mail->Body    = '<html><head>
                            <style>
                                @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
                        
                                body{
                                    background-color : #F2F4F6;
                                }
                                
                                .d-flex{
                                    min-width : 300px;
                                    max-width : 540px;
                                    width : 100%;
                                    margin : 0 auto;
                                }
                                .message-content{
                                    font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
                                }
                                #messagebody
                                {
                                    background : white;
                                    padding : 30px;
                                    line-height:24px;font-size:14px;
                                    border-top: 8px solid #3e64ff;
                                }
                                .footer{
                                    background-color : rgb(26, 32, 46);
                                    padding : 25px 0px;
                                    margin-bottom: 20px;
                                }
                                .footer p{
                                    color : #A8AAAF;
                                    text-align : center;
                                    font-size : 13px;
                                    margin : 0px;
                                }
                                .h-100{
                                    display: flex;
                                    height: 100%;
                                    align-items: center;
                                    justify-content: center;
                                }
                                .fs-20 {
                                    font-size: 20px;
                                }
                                .text-dark{
                                    color: #000;
                                    width: 130px;
                                }
                                .display-flex{
                                    display: flex;
                                }
                                .text-center{
                                    text-align: center;
                                }
                                h2{
                                    color: #3e64ff;
                                }
                            </style>
                            </head>
                            <body>
                                <div class="h-100">
                                    <div class="d-flex">
                                        <div class="message-content">
                                            <div class="text-center">
                                                <h2>Hi '.$first_name.'</h2>
                                            </div>
                                            <div id="messagebody">
                                                <p class="fs-20">Your request has been accepted</p>
                                                <p>Thank you for again active your account, Please login with your account.</p>
                                            </div>
                                            <div class="footer">
                                                <p>&copy; All rights reserved. by logdy</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </body>
                        </html>';
                            
                    
                            $mail->send();
                            echo json_encode(array("statusCode"=>200,"message"=>'User activated successfully...'));  
                        } 
                        catch (Exception $e) {
                            echo json_encode(array("statusCode"=>500,"message"=>'Something is wrong, Please try again later.')); 
                        }
                    }else {
                        echo json_encode(array("statusCode"=>500,"message"=>'Something is wrong, Please try again later.')); 
                    }
                }else {
                    echo json_encode(array("statusCode"=>500,"message"=>'Something is wrong, Please try again later.')); 
                }
            }            
        }
        
    }

   

?>