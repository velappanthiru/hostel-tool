<?php include '../_template/header.tpl.php' ?>
<?php include '../includes/sidebar.php'; ?>
<?php 
    include '../_config/dbconn.php';

    $getBranch = "SELECT DISTINCT branch FROM room_details";

    $result = mysqli_query($conn,$getBranch);

    $details = array();

    if(mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
    }
?>

    <!-- =============================
    ============== Start : Contact page =========== -->
    <main class="main-contant-page">
        <div class="mt-4">
            <form action="" method="post" id="booking-room">
                <div class="row m-0">
                    <div class="col-lg-6 p-max-lg-0">
                        <div class="p-lg-3 p-2 bg-white br-5 box-shadow">
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Branch <sup class="text-danger">*</sup></label>
                                <select name="branch" id="branch" data-required-field="Branch" data-type='select2' class="empty form-select validation select2 branch">
                                    <option value="">Select Branch</option>
                                    <?php if(count($details) > 0) { 
                                        foreach ($details as $key => $value) {
                                            # code...
                                            echo '<option value="'.$value['branch'].'">'.$value['branch'].'</option>';
                                        }
                                    }?>
                                </select>
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Room Number (Select the branch first) <sup class="text-danger">*</sup></label>
                                <select name="room_number" id="room_number" data-required-field="Room Number" data-type='select2' class="empty select2 validation form-select room_number">
                                    <option value="">Select Room no</option>
                                </select>
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Seater</label>
                                <input type="text" name="seater" disabled id="seater" data-required-field="Seater" class="empty form-control disabled_cls seater">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Total Duration</label>
                                <select name="total_duration" id="total_duration" data-required-field="Total Duration" data-type="select2" class="empty form-select validation select2 total_duration">
                                    <option value="">Choose...</option>
                                    <option value="1">One Month</option>
                                    <option value="2">Two Month</option>
                                    <option value="3">Three Month</option>
                                    <option value="4">Four Month</option>
                                    <option value="5">Five Month</option>
                                    <option value="6">Six Month</option>
                                    <option value="7">Seven Month</option>
                                    <option value="8">Eight Month</option>
                                    <option value="9">Nine Month</option>
                                    <option value="10">Ten Month</option>
                                    <option value="11">Eleven Month</option>
                                    <option value="12">Twelve Month</option>
                                </select>
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Food Status</label>
                                <select name="food_status" id="food_status" data-required-field="Food Status" data-type="select2" class="empty form-select select2 validation food_status">
                                    <option value="">Choose</option>
                                    <option value="with food">with food</option>
                                    <option value="without food">without food</option>
                                </select>
                                <small class="text-danger err-mge"></small>
                            </div>
                          
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Fees Per Month</label>
                                <input type="text" disabled name="fees" id="fees" data-required-field="Fees Per Month" class="form-control empty disabled_cls fees">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Advance Amount</label>
                                <input type="text" name="ad_amount" disabled id="ad_amount" data-required-field="Advance Amount" class="form-control empty disabled_cls ad_amount">
                                <small class="text-danger err-mge"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-max-lg-0 mt-4 mt-lg-0">
                        <div class="p-lg-3 p-2 bg-white br-5 box-shadow">
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" disabled name="first_name" value="<?php echo $userrow['first_name'] ?>" id="first_name" data-required-field="First Name" class="form-control disabled_cls first_name">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" disabled name="last_name" value="<?php echo $userrow['last_name'] ?>" id="last_name" data-required-field="Last Name" class="form-control disabled_cls last_name">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" disabled name="email" id="email" value="<?php echo $userrow['email'] ?>" data-required-field="Email" class="form-control disabled_cls email">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Gender</label>
                                <input type="text" disabled name="gender" id="gender" value="<?php echo $userrow['gender'] ?>" data-required-field="Gender" class="form-control disabled_cls gender">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Contact No</label>
                                <input type="text" disabled name="contact_no" id="contact_no" value="<?php echo $userrow['contact_no'] ?>" data-required-field="Contact No" class="form-control disabled_cls contact_no">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Available Seat</label>
                                <input type="text" disabled name="available_seat" id="available_seat" data-required-field="Available Seat" class="empty form-control disabled_cls available_seat">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Number of Seat</label>
                                <input type="text" name="number_seat" id="number_seat" data-required-field="Number of Seat" data-type="text" class="empty form-control validation number_seat">
                                <small class="text-danger err-mge"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-max-lg-0 mt-4">
                        <div class="py-2 bg-white br-5 box-shadow">
                            <div class="row m-0">
                                <div class="col-lg-4">
                                    <div class="form-group mb-2 mb-lg-3">
                                        <label for="" class="form-label">Guardian Name</label>
                                        <input type="text" name="guardian_name" id="guardian_name" data-required-field="Guardian Name" data-type="text" class="empty validation form-control guardian_name">
                                        <small class="text-danger err-mge"></small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-2 mb-lg-3">
                                        <label for="" class="form-label">Relation</label>
                                        <input type="text" name="relation" id="relation" data-required-field="Relation" data-type="text" class="form-control empty validation relation">
                                        <small class="text-danger err-mge"></small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-2 mb-lg-3">
                                        <label for="" class="form-label">Contact No</label>
                                        <input type="text" name="relation_contact_no" id="relation_contact_no" data-type="text" data-required-field="Contact No" class="empty validation form-control relation_contact_no">
                                        <small class="text-danger err-mge"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-max-lg-0 mt-4">
                        <div class="p-lg-2 p-2 bg-white br-5 box-shadow">
                            <p class="my-3">Current Address Information</p>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="curr_address" id="curr_address" data-required-field="Address" data-type="text" class="form-control validation empty curr_address">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">City</label>
                                <input type="text" name="curr_city" id="curr_city" data-required-field="City" data-type="text" class="form-control validation empty curr_city">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">State</label>
                                <input type="text" name="curr_state" id="curr_state" data-required-field="State" data-type="text" class="form-control validation empty curr_state">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Pincode</label>
                                <input type="text" name="curr_pincode" id="curr_pincode" data-required-field="Pincode" data-type="text" class="validation empty form-control curr_pincode">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <p>Ignore this CHECK BOX if you have different permanent address</p>
                            <div class="form-check mb-2 mb-lg-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                My permanent address is same as above!
                                </label>
                                <small class="text-danger err-mge d-block"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-max-lg-0 mt-4">
                        <div class="p-lg-2 p-2 bg-white br-5 box-shadow">
                            <p class="my-3">Permanent Address Information</p>
                            <p>Please fill up the form "ONLY IF" you've different permanent address!</p>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="permanent_address" id="permanent_address" data-type="text" data-required-field="Address" class="validation empty form-control permanent_address">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">City</label>
                                <input type="text" name="permanent_city" id="permanent_city" data-type="text" data-required-field="City" class="form-control validation empty permanent_city">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">State</label>
                                <input type="text" name="permanent_state" id="permanent_state" data-type="text" data-required-field="State" class="validation empty form-control permanent_state">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="form-group mb-2 mb-lg-3">
                                <label for="" class="form-label">Pincode</label>
                                <input type="text" name="permanent_pincode" id="permanent_pincode" data-required-field="Pincode" data-type="text" class="form-control validation empty permanent_pincode">
                                <small class="text-danger err-mge"></small>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary book_room" id='book_room'>Book Room</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- =============================
    ============== End : Contact page =========== -->
<?php include '../_template/footer.tpl.php'; ?>
<script>
    var activeTab = 'book-room';
</script>
<script src="../assets/js/booking-room.js"></script>