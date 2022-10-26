<?php 

   
    if (!defined('APP_ROOT')) {
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
            define('APP_ROOT', dirname(__DIR__));
        else
            define('APP_ROOT', $_SERVER['DOCUMENT_ROOT']);
    }

    if (!defined('SITE_URL')) {
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
            define('SITE_URL', 'http://localhost/hostel-tool');
        else
            define('SITE_URL', (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']);
    }
    define('SELF_URL', SITE_URL);
    
    
    defined("PUBLIC_CSS")
    or define("PUBLIC_CSS", SITE_URL . '/public/css');

    defined("PUBLIC_IMAGES")
    or define("PUBLIC_IMAGES", SITE_URL . '/public/images');

    defined("PUBLIC_JS")
    or define("PUBLIC_JS", SITE_URL . '/public/js');

    defined("PATH_JS")
    or define("PATH_JS", SITE_URL . '/assets/js');

    defined("APP_CONFIG")
    or define("APP_CONFIG", APP_ROOT . DIRECTORY_SEPARATOR . '_config');

    require_once(APP_CONFIG.'/dbconn.php');


    
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

    $path = $_SERVER['REQUEST_URI']; // this gives you /folder1/folder2/THIS_ONE/file.php
    $folders = explode('/', $path); // splits folders in array
    $what_we_need = $folders[2];

    echo ($rowRoles['name']== 'super admin' );
    

    if($_SESSION['is_authenticated'] !== TRUE) {
        header("Location: ".SELF_URL."/index.php");
        exit();
    } else{
        if($rowRoles['name'] == 'super admin' && $what_we_need == 'user') {
            header("Location: ".SELF_URL."/admin/dashboard.php");
        }elseif ($rowRoles['name'] == 'admin' && $what_we_need == 'user') {
            header("Location: ".SELF_URL."/admin/dashboard.php");
        }elseif($rowRoles['name'] == 'general' && $what_we_need == 'admin') {
            header("Location: ".SELF_URL."/user/dashboard.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= PUBLIC_IMAGES ?>/logo-sm.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= PUBLIC_IMAGES ?>/logo-sm.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= PUBLIC_IMAGES ?>/logo-sm.png" />
    <title>Tool | Internal</title>
    <!-- Bootstrap 5 Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Google Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- select2 css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Datatable plugin css -->
    <link rel="stylesheet" href="<?= PUBLIC_CSS ?>/plugin/datatables.min.css">
    <!-- Confirm box css -->
    <link rel="stylesheet" href="<?= PUBLIC_CSS ?>/plugin/jquery-confirm.min.css">
    <!-- Css Style Link -->
    <link rel="stylesheet" href="<?= PUBLIC_CSS ?>/style.min.css">
</head>
<body>
  
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid px-lg-0">
            <div class="logo p-lg-3 d-flex align-items-center">
                <a class="navbar-brand" href="#">
                    <img src="<?= PUBLIC_IMAGES ?>/logo-sm.png" width="25px" class="img-fluid" alt="logo"> <span class="text-white d-none d-lg-inline-block">Logdy</span>
                </a>
                <i class="fa-solid fa-bars menu-bar ms-2 d-lg-none text-search-text fs-25 bar" data-active-menu="close"></i>
            </div>
            
            <div class="ms-auto" id="navbarNavAltMarkup">
                <div class="navbar-nav d-flex flex-row align-items-center">
                    <a class="nav-link p-nav d-lg-none" href="#">
                        <div class="btn-group">             
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-magnifying-glass text-search-text"></i>
                            </button>
                            <ul class="dropdown-info-wrapper dropdown-menu dropdown-menu-end">
                                <li> 
                                    <form action="" class="p-3" method="post">
                                        <div class="form-group">
                                            <input type="text" name="mob_search" id="mob_search" class="form-control mob_search">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </a>
                    
                    <a class="nav-link p-nav d-none d-lg-block" href="#">
                        <div class="d-flex search-input">
                            <input type="search" name="search" id="search" class="form-control search" placeholder="Search...">
                            <button class="btn btn-search">
                                <i class="fa-solid fa-magnifying-glass text-search-text"></i>
                            </button>
                        </div>
                    </a>
                    <?php  if($rowRoles['name'] == 'super admin' || $rowRoles['name'] == 'admin') { ?>
                    <a class="nav-link p-nav" href="#">
                        
                        <div class="btn-group">   
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="position-relative">
                                    <i class="fa-regular fa-bell icon-gray"></i>
                                    <span class="notification-badge notification-count">9</span>
                                </div>
                            </button>
                            <ul class="dropdown-wrapper dropdown-menu dropdown-menu-end">
                                
                                <li class="header-notification">
                                    <div class="d-flex border-clr justify-content-between">
                                        <div class="icon">
                                            <i class="fa-regular fa-bell me-2"></i> Notification
                                        </div>
                                        <div class="count">
                                            <span class="label-danger notification-count">10</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification-content">
                                    <ul class="p-0">
                                      
                                        <!-- <li class="hover position-relative m-2">
                                            <div class="active-req p-3 d-flex justify-content-between align-items-center">
                                                <div class="text">
                                                    <p class="mb-0">New request to reactived #25 this account</p>
                                                </div>
                                                <div class="close-icon cp ms-2">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </div>
                                            <span class="vertical-line line-red"></span>
                                        </li> -->
                                    </ul>
                                </li>
                                
                                <li class="footer-notification">
                                    <div class="px-3 py-2 text-center">
                                        <p class="mb-0">Read more...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </a>
                    <?php } ?>
                    <a class="nav-link" href="#">
                        <div class="btn-group">
                                     
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile d-flex align-items-center">
                                    <div class="profile-img">
                                        <img src="<?= PUBLIC_IMAGES ?>/user-1.jpg" width="30px" class="img-fluid" alt="profile img">
                                    </div>
                                    <span class="ms-2 d-none d-md-block">User one</span>
                                    <i class="fa-solid fa-caret-down ms-2 d-none d-md-block"></i>
                                </div>
                            </button>
                            <ul class="dropdown-info-wrapper dropdown-menu dropdown-menu-end">
                                <li> 
                                    <button class="dropdown-item" type="button">
                                       Welcome!
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" type="button">
                                        <i class="fa-regular fa-user me-2"></i> My Account
                                    </button>
                                </li>
                                <li><button class="dropdown-item logout" type="button"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</button></li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
