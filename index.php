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
        <!-- <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
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
                <div class="row g-4 mb-4">
                    <div class="col-sm-6 col-xl-4">
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
                    <div class="col-sm-6 col-xl-4">
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
                    <div class="col-sm-6 col-xl-4">
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
                <!-- Referral count -->
                <h2 class="mb-4 text-center">Application Referrals</h2>
                <div class="row g-4">



                    <?php
                    //this query will count the number of applicants for each referral
                    //by selecting the referral id, referral, and the count of the number of applicants
                    $query = "SELECT 
                referrals.id, 
                referrals.referral, 
                COUNT(job_applications.id) AS applicant_count
              FROM 
                referrals
              LEFT JOIN 
                job_applications 
              ON 
                referrals.id = job_applications.referral_id
              GROUP BY 
                referrals.id, referrals.referral
              ORDER BY 
                applicant_count DESC";

                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract values from the row
                            $referral = htmlspecialchars($row['referral']);
                            $applicant_count = $row['applicant_count'];
                            ?>

                            <div class="col-sm-3 col-sm-3">
                                <div class="bg-light rounded h-100 p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0"><?php echo $referral; ?></h6>
                                        <!-- <a href="" class="text-primary"><i class="fa fa-eye"></i></a> -->
                                    </div>
                                    <div class="d-flex align-items-center py-2">
                                        <div class="d-flex align-items-center w-100">
                                            <i class="fa fa-users me-2 text-primary"></i>
                                            <span>Applicants: <?php echo $applicant_count; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<p class='text-center'>No referrals found.</p>";
                    }
                    ?>

                </div>

                <!-- Footer Start -->
                <?php include 'layout/footer.php'; ?>
                <!-- Footer End -->
            </div>
            <!-- Content End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>