<?php
/**
 * Index Page
 * 
 * This file is the main entry point for the admin dashboard.
 * It includes:
 * - Protected access (requires authentication)
 * - Responsive layout with sidebar navigation
 * 
 * @author https://github.com/d3uceY
 * 
 */
?>
<?php include 'layout/header.php'; ?>
<?php include 'includes/protect.inc.php'; ?>
<?php include 'includes/db_con.php'; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'layout/navbar.php'; ?>
            <!-- Navbar End -->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-briefcase fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Open Positions</p>
                                <h6 class="mb-0">


                                    <?php
                                    // Count the number of open positions
                                    $query = 'SELECT COUNT(*) FROM job_openings';
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(*)'];
                                    ?>



                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">New Applicants</p>
                                <h6 class="mb-0">


                                    <?php
                                    // Count the number of new applicants
                                    $query = 'SELECT COUNT(*) FROM job_applications where status = "NEW"';
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(*)'];
                                    ?>


                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Applicants</p>
                                <h6 class="mb-0">


    
                                    <?php
                                    // Count the number of total applicants
                                    $query = 'SELECT COUNT(*) FROM job_applications';
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(*)'];
                                    ?>


                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Footer Start -->
            <?php include 'layout/footer.php'; ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>