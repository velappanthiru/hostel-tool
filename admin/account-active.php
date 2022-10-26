<?php include '../_template/header.tpl.php' ?>

<?php include '../includes/sidebar.php' ?>
    
    <!-- =============================
    ============== Start : Contact page =========== -->
    <main class="main-contant-page">
        <section class="account-active">
            <h5 class="mt-4">New request to active account</h5>

            <div class="account-active-table mt-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="account-active">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>      
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
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
<script src="../assets/js/login.js"></script>
<script>
    var activeTab = '';
</script>