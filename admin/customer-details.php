<?php include '../_template/header.tpl.php' ?>

<?php include '../includes/sidebar.php' ?>
    
    <!-- =============================
    ============== Start : Contact page =========== -->
    <main class="main-contant-page">
        <section class="customer-details-section">
            <h3 class="mt-4">Customers Account</h3>
            <div id="buttons" class="d-flex flex-wrap justify-content-end mt-4"></div>
            <div class="customer-details-table mt-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="customer-details">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>      
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
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
<script src="../public/js/customer-details.min.js"></script>
<script>
    var activeTab = 'custumer-details';
</script>