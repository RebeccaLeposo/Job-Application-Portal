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
        <title>PataKazi - Admin Dashboard</title>
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">

            <?php include_once('includes/sidebar.php'); ?>




            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <div class="block-header bg-gd-emerald">
                        <h3 class="text-white">Dashboard</h3>

                    </div>
                    </br></br></br></br>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #1 -->
                        <div class="col-6 col-md-4 col-xl-3">
                            <?php
                            $sql1 = "SELECT id from tblcategory";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results = $query1->fetchAll(PDO::FETCH_OBJ);
                            $totcat = $query1->rowCount(); ?>
                            <a class="block text-center" href="manage-category.php">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk">


                                    <div class="text-white"><?php echo htmlentities($totcat); ?></div>
                                    <p class="font-w600 text-white">Total Service Category</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <?php
                            $sql2 = "SELECT id from tblemployers";
                            $query2 = $dbh->prepare($sql2);
                            $query2->execute();
                            $results = $query2->fetchAll(PDO::FETCH_OBJ);
                            $totemp = $query2->rowCount();
                            ?>
                            <a class="block text-center" href="employer-list.php">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk">

                                    <div class="text-white"><?php echo htmlentities($totemp); ?></div>
                                    <p class="font-w600 text-white">Total Service Provider</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <?php
                            $sql3 = "SELECT id from tbljobseekers";
                            $query3 = $dbh->prepare($sql3);
                            $query3->execute();
                            $results = $query3->fetchAll(PDO::FETCH_OBJ);
                            $totcan = $query3->rowCount();
                            ?>
                            <a class="block text-center" href="reg-jobseekers.php">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-sea">

                                    <div class="text-white"><?php echo htmlentities($totcan); ?></div>
                                    <p class="font-w600 text-white">Total Service seeker</p>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #1 -->
                    </div>


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
        <script src="assets/js/plugins/chartjs/Chart.bundle.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_pages_dashboard.js"></script>
    </body>

    </html>
<?php }  ?>