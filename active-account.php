<?php 

    include './_config/dbconn.php';

    if(isset($_SESSION['is_authenticated'])) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $user_id = $_SESSION['user_id'];
    
        $userDetails = "SELECT role_id,first_name,last_name,email,contact_no,gender FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn,$userDetails);
    
        if($result) {
            $userrow = mysqli_fetch_array($result);   
        }
        
        $role_id = $userrow['role_id'];
    
        $roles = "SELECT * FROM `roles` WHERE id='$role_id'";
    
        $rowResult = mysqli_query($conn,$roles);
        
    
        if($rowResult) {
            $rowRoles = mysqli_fetch_array($rowResult);
        }
    
    
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if($_SESSION['is_authenticated'] == TRUE && $rowRoles['name'] == 'super admin' || $rowRoles['name'] == 'admin') {
            header("Location: ./admin/dashboard.php");
            exit();
        } elseif ($_SESSION['is_authenticated'] == TRUE && $rowRoles['name'] == 'general') {
            header("Location: ./user-dashboard.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="./public/images/logo-sm.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./public/images/logo-sm.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./public/images/logo-sm.png" />
    <title>Tool | Internal</title>
    <!-- Bootstrap 5 Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Google Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Css Style Link -->
    <link rel="stylesheet" href="./public/css/style.min.css">
</head>
<body>
    <main>
        <section class="login-section d-flex justify-content-center align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 left-side bg-white d-none d-lg-flex">
                        <div class="bg-img-inner">
                            <div class="row m-0 justify-content-center">
                                <div class="col-lg-12 col-lg-xl">
                                    <div class="text-start">
                                        <h1>
                                            Welcome To Logdy
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores est assumenda aspernatur cum amet sapiente et. Labore tempore maiores, ex cum ducimus reiciendis distinctio, explicabo omnis, ratione iusto beatae voluptatum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 right-side d-flex justify-content-center align-items-center">
                        <div class="form-section w-100">
                            <div class="login-title text-center">
                                <h2 class="text-white text-uppercase">logdy</h2>
                                <h5 class="text-white">If you want to reactive your active. Please submit your email</h5>
                            </div>
                            <form class="mt-5">
                                <div class="mb-4 form-group position-relative">
                                    <input type="email" class="form-control email emailvalidation" data-required-field='Email' name='email' id="email" placeholder="Email Address">
                                    <i class="far fa-envelope position-absolute"></i>
                                    <small class="text-danger err-mge"></small>
                                </div>
                                
                                
                                <button type="submit" class="btn btn-orange w-100 rounded-0" id="reactive-btn">Submit</button>
                                <p class="mt-3 text-white mb-0">You already have account? <a href="./index.php" class="text-decoration-none">Please Login</a></p>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Bootstrap 5 Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Jquery Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="./assets/js/login.js"></script>

</body>
</html>