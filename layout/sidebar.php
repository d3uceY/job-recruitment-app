<?php
/**
 * Sidebar Layout
 * 
 * This file defines the sidebar navigation for the application.
 * It includes:
 * - Master data pages
 * - Job openings pages
 * - Applications pages
 * - Current page detection
 * - Active class assignment for navigation items
 * 
 * @author https://github.com/d3uceY
 * 
 */


// Get the current page file name
$current_page = basename($_SERVER['PHP_SELF']);



// Define the page menu that should have the active class
// Stored in an array 
$master_data_pages = [
    'locations.php',
    'educational_level.php',
    'industry.php',
    'manage_referrals.php'
];



$job_openings_pages = [
    'view_jobs.php',
    'add-jobs.php'
];



$applications_pages = [
    'job_applications.php',
    'query_applications.php',
    'talent_hunt_applications.php',
    'manage_talent_hunt_application.php',
    'manage_job_applications.php'
];

// Check if the current page is in the active pages array
$master_data_active = in_array($current_page, $master_data_pages);

$job_openings_active = in_array($current_page, $job_openings_pages);

$applications_active = in_array($current_page, $applications_pages);





// Check if the current page is active
$locations_page_active = $current_page == 'locations.php';

$referrals_page_active = $current_page == 'manage_referrals.php';

$educational_level_page_active = $current_page == 'educational_level.php';

$industry_page_active = $current_page == 'industry.php';

$view_jobs_page_active = $current_page == 'view_jobs.php';

$add_jobs_page_active = $current_page == 'add-jobs.php';

$job_applications_page_active = $current_page == 'job_applications.php' || $current_page == 'manage_job_applications.php';

$query_applications_page_active = $current_page == 'query_applications.php';

$dashboard_page_active = $current_page == 'index.php';

$talent_hunt_page_active = $current_page == "talent_hunt_applications.php" || $current_page == "manage_talent_hunt_application.php";
?>

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <i class="fa fa-hashtag me-2"></i>BANK IT
            </h3>
        </a>

        <!-- <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>

            <?php
            if (isset($_SESSION["userid"])) {
                echo "<div class='ms-3'>";
                echo "<h6 class='mb-0'>" . $_SESSION["username"] . "</h6>";
                echo "<span>admin</span>";
                echo "</div>";
            }
            ?>
        </div> -->

        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php echo $dashboard_page_active ? 'active' : ''; ?>">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <div class="nav-item dropdown">


                <a href="#" class="nav-link dropdown-toggle <?php echo $master_data_active ? "active show" : ''; ?>"
                    data-bs-toggle="dropdown">
                    <i class="fa fa-database me-2"></i>Master Data
                </a>


                <div class="dropdown-menu bg-transparent border-0 <?php echo $master_data_active ? "show" : ''; ?>"
                    <?php echo $master_data_active ? "data-bs-popper='none'" : ''; ?>>

                    <a href="locations.php"
                        class="dropdown-item <?php echo $locations_page_active ? 'active' : ''; ?>">Locations</a>

                    <a href="educational_level.php"
                        class="dropdown-item <?php echo $educational_level_page_active ? 'active' : ''; ?>">Educational
                        Levels</a>

                    <a href="industry.php"
                        class="dropdown-item <?php echo $industry_page_active ? 'active' : ''; ?>">Industry
                        Categories</a>

                    <a href="manage_referrals.php"
                        class="dropdown-item <?php echo $referrals_page_active ? 'active' : ''; ?>">Manage Referrals</a>

                </div>
            </div>

            <div class="nav-item dropdown ">


                <a href="#" class="nav-link dropdown-toggle <?php echo $job_openings_active ? 'active show' : ''; ?>"
                    data-bs-toggle="dropdown">
                    <i class="fa fa-briefcase me-2"></i>Job Openings
                </a>


                <div class="dropdown-menu bg-transparent border-0 <?php echo $job_openings_active ? "show" : ''; ?>"
                    <?php echo $job_openings_active ? "data-bs-popper='none'" : ''; ?>>

                    <a href="view_jobs.php"
                        class="dropdown-item <?php echo $view_jobs_page_active ? 'active' : ''; ?>">Job Openings</a>

                    <a href="add-jobs.php"
                        class="dropdown-item <?php echo $add_jobs_page_active ? 'active' : ''; ?>">Add Job Opening</a>


                </div>
            </div>

            <div class="nav-item dropdown">


                <a href="#" class="nav-link dropdown-toggle <?php echo $applications_active ? 'active show' : ''; ?>"
                    data-bs-toggle="dropdown">


                    <i class="fa fa-file-alt me-2"></i>Applications
                </a>


                <div class="dropdown-menu bg-transparent border-0 <?php echo $applications_active ? "show" : ''; ?>"
                    <?php echo $applications_active ? "data-bs-popper='none'" : ''; ?>>

                    <a href="job_applications.php"
                        class="dropdown-item <?php echo $job_applications_page_active ? 'active' : ''; ?>">Job
                        Applications</a>

                    <a href="talent_hunt_applications.php"
                        class="dropdown-item <?php echo $talent_hunt_page_active ? 'active' : ''; ?>">Talent
                        Hunt</a>




                </div>
            </div>

            <!-- <a href="widget.php" class="nav-item nav-link">
                <i class="fa fa-th me-2"></i>Widgets
            </a>

            <a href="form.php" class="nav-item nav-link">
                <i class="fa fa-keyboard me-2"></i>Forms
            </a>

            <a href="table.php" class="nav-item nav-link">
                <i class="fa fa-table me-2"></i>Tables
            </a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="far fa-file-alt me-2"></i>Pages
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.php" class="dropdown-item">Sign In</a>
                    <a href="signup.php" class="dropdown-item">Sign Up</a>
                    <a href="404.php" class="dropdown-item">404 Error</a>
                    <a href="blank.php" class="dropdown-item">Blank Page</a>
                </div> -->
        </div>
</div>
</nav>
</div>