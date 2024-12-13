<?php
/*
 * Query Applications Page
 * This page allows users to search and view applications
 * Includes the standard layout components (header, sidebar, navbar)
 */

include 'includes/db_con.php'; // Database connection
include 'layout/header.php';  // Page header template
include 'includes/protect.inc.php'; // Protect the page from unauthorized access
?>

<body>
    <?php
    // Display success message if set
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Display error message if set 
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Loading spinner -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Include sidebar navigation -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- Main content area -->
        <div class="content">
            <!-- Top navigation bar -->
            <?php include 'layout/navbar.php'; ?>

            <!-- Your main content goes here -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!-- Add your query applications content here -->
                </div>
            </div>

            <!-- Page footer -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>
</body>
