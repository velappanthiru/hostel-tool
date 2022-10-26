<?php require_once '../_template/header.tpl.php' ?>

<?php include '../includes/sidebar.php' ?>

    
    <!-- =============================
    ============== Start : Contact page =========== -->
    <main class="main-contant-page">
        <section class="manage-room-section">

            <div id="buttons" class="d-flex flex-wrap justify-content-between mt-4">
                <button class="btn btn-search px-4 m-3" id="add_room">Add Room</button>
            </div>
            
            <div class="room-details mt-4 bg-white p-3 box-shadow rounded-3">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0" id="room-details">
                        <thead class="table-dark">
                            <tr>
                                <th>S.No</th>      
                                <th>Room No</th>
                                <th>Seater</th>
                                <th>Branch</th>
                                <th>Fees Per Month</th>
                                <th>Published On</th>
                                <th class="noExport">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <!-- =============================
    ============== End : Contact page =========== -->
<?php include '../_template/footer.tpl.php' ?>

<script src="../public/js/room-manage.min.js"></script>

<script>
    var activeTab = 'manage-room';
</script>