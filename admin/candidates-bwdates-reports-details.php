<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid'] == 0)) {
    header('location:logout.php');
} else {

?>
    <!doctype html>
    <html lang="en" class="no-focus"> <!--<![endif]-->

    <head>
        <title>PataKazi - Serviceseeker Lists</title>

        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

    </head>

    <body>

        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">

            <?php include_once('includes/sidebar.php'); ?>




            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">



                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                            <h3 class="block-title">Service Seeker Report</h3>

                        </div>
                        <div class="block-content block-content-full">


                            <?php
                            $fdate = $_POST['fromdate'];
                            $tdate = $_POST['todate'];

                            ?>
                            <h5 align="center" style="color:#A020F0">Report from <?php echo $fdate ?> to <?php echo $tdate ?></h5>
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr style="color:#000;">
                                        <th class="text-center"></th>
                                        <th>Full Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell">Registration Date</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * from tbljobseekers where date(RegDate) between '$fdate' and '$tdate'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {               ?>
                                            <tr style="color:#000;">
                                                <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="font-w600"><?php echo htmlentities($row->FullName); ?></td>
                                                <td class="font-w600"><?php echo htmlentities($row->ContactNumber); ?></td>
                                                <td class="font-w600"><?php echo htmlentities($row->EmailId); ?></td>
                                                <?php if ($row->IsActive == '1') { ?>
                                                    <td class="font-w600"><?php echo "Active"; ?></td>
                                                <?php } else { ?>

                                                    <td class="font-w600"><?php echo "Inactive"; ?></td><?php } ?>

                                                <td class="d-none d-sm-table-cell"><?php echo htmlentities($row->RegDate); ?></td>

                                                <td class="d-none d-sm-table-cell"><a href="view-jobseeker-details.php?viewid=<?php echo htmlentities($row->id); ?>">View</a></td>
                                            </tr>




                                </tbody>
                            <?php
                                            $cnt = $cnt + 1;
                                        }
                                    } else { ?>
                            <tr>
                                <td colspan="8"> No record found against this search</td>

                            </tr>
                        <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->

                    <!-- END Dynamic Table Simple -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->


        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>

    </html>
<?php }  ?>