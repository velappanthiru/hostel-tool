<!-- =============================
============== Start : Side bar =========== -->
    <div class="sidebar-menu">
        <div class="user-box">
            <div class="user-img d-flex flex-column align-items-center">
                <img src="<?= PUBLIC_IMAGES ?>/user-1.jpg" class="img-fluid" width="55px" alt="user img">
            </div>
            <div class="user-details text-center mt-3">
                <h6 class="text-white user-name mb-1"><?php echo $userrow['first_name'] ?></h6>
                <p class="user-position">Admin Head</p>
            </div>
        </div>
        <ul class="sidebar-nav p-0">
            <?php 
                if($rowRoles['name'] == 'super admin' || $rowRoles['name'] == 'admin') {
            ?>
                <li class="px-3 py-2"> 
                    <a href="<?= SELF_URL ?>/admin/dashboard.php" class="dashboard-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/dashboard.svg" class="img-fluid" alt="">
                        <span class="ms-2">Dashboard</span>
                    </a>
                </li>
                <li class="border-line"> 
                    
                </li>
                <li class="px-3 py-2"> 
                    Features
                </li>
                <li class="p-3"> 
                    <a href="<?= SELF_URL ?>/admin/customer-details.php" class="custumer-details-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/details.svg" class="img-fluid" alt="">
                        <span class="ms-2">Customers Details</span>
                    </a>
                </li>
                <!-- <li class="p-3"> 
                    <a href="<?= SELF_URL ?>/admin/hostel-members.php" class="hostel-members-nav-link">
                        <i class="fa-solid fa-users"></i>
                        <span class="ms-2">Hostel Members</span>
                    </a>
                </li> -->
                <li class="p-3"> 
                    <a href="<?= SELF_URL ?>/admin/room-manage.php" class="manage-room-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/bed.svg" class="img-fluid" alt="">
                        <span class="ms-2">Manage Room</span>
                    </a>
                </li>
                <li class="p-3"> 
                    <a href="" class="log-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/login.svg" class="img-fluid" alt="">
                        <span class="ms-2">Log Activies</span>
                    </a>
                </li>
            <?php 
                }  elseif($rowRoles['name'] == 'general'){
            ?>
                <li class="px-3 py-2"> 
                    <a href="<?= SELF_URL ?>/user/dashboard.php" class="userdashboard-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/dashboard.svg" class="img-fluid" alt="">
                        <span class="ms-2">Dashboard</span>
                    </a>
                </li>
                <li class="border-line"> 
                    
                </li>
                <li class="p-3"> 
                    <a href="<?= SELF_URL ?>/user/book-room.php" class="book-room-nav-link">
                        <img src="<?= PUBLIC_IMAGES ?>/icons/room.svg" class="img-fluid" alt="">
                        <span class="ms-2">Book Room</span>
                    </a>
                </li>
               
            <?php 
                }
            ?>
        </ul>
    </div>
<!-- =============================
============== End : Side bar =========== -->