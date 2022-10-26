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
        <section class="register-section d-flex justify-content-center align-items-center">
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
                                <h5 class="text-white">Sign Up Into Your Account</h5>
                            </div>
                            <form class="mt-5">
                                <div class="row m-0">
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">First Name</label>
                                            <input type="text" class="form-control first_name validation" data-required-field="First Name" data-type="text" id="first_name" name="first_name">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Last Name</label>
                                            <input type="text" class="form-control last_name validation" data-required-field="Last Name" data-type="text" id="last_name" name="last_name">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Email</label>
                                            <input type="text" class="form-control email validation" data-required-field="Email" data-type="email" id="email" name="email">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Gender</label>
                                            <select name="gender" id="gender" class="form-select gender validation" data-required-field="Gender" data-type="select">
                                                <option value="">Choose</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Contant No</label>
                                            <input type="text" class="form-control contant_no validation" data-required-field="Contant No" data-type="phone" id="contant_no" name="contant_no">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Password</label>
                                            <input type="password" class="form-control password validation" data-required-field="Password" data-type="password" id="password" name="password">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label text-white">Confirm Password</label>
                                            <input type="password" class="form-control cpassword validation" data-required-field="Confirm Password" data-type="cpassword" id="cpassword" name="cpassword">
                                            <small class="text-danger err-mge"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <button type="submit" class="btn btn-orange w-100 rounded-0" id="register">Register</button>
                                    </div>
                                    <p class="mt-3 text-white mb-0">Already a member? <a href="./index.php" class="text-decoration-none text-white">Login</a></p>
                                </div>
                                
                            </form>
                            <ul class="secial-link ps-0 text-center">
                                <li>
                                    <a href="#" class="text-decoration-none facebook-clr">
                                        <i class="fab fa-facebook-f facebook-i"></i>
                                        <span>Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-decoration-none twitter-clr">
                                        <i class="fa-brands fa-twitter twitter-i"></i>
                                        <span>Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-decoration-none google-clr">
                                        <i class="fa-brands fa-google google-i"></i>
                                        <span>Google</span>
                                    </a>
                                </li>
                            </ul>
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