<?php 
// Include header template and database connection
include 'layout/header.php'; 
include 'includes/db_con.php'; 
?>

<body>
    <?php
    // Display success message if set in URL parameters
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Display error message if set in URL parameters 
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Loading spinner shown while page loads -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Include sidebar navigation -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- Main content area -->
        <div class="content">
            <!-- Include top navigation bar -->
            <?php include 'layout/navbar.php'; ?>

            <!-- Jobs listing table section -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <!-- Table header with add new job button -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Job Listings</h6>
                        <a href="add-jobs.php" class="btn btn-primary">Add New Job</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Title</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to fetch job listings with location details and calculate remaining days
                                $query = "SELECT j.*, l.state, l.country,
                                          DATEDIFF(j.duration, CURDATE()) as days_remaining 
                                          FROM job_openings j 
                                          LEFT JOIN locations l ON j.job_location = l.id";
                                $result = mysqli_query($conn, $query);

                                // Check if query executed successfully
                                if (!$result) {
                                    die('Query Failed' . mysqli_error($conn));
                                } else {
                                    // Loop through each job listing
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['state'] . ', ' . $row['country']); ?></td>
                                            <td>
                                                <?php 
                                                // Display remaining days or expired status
                                                $days = $row['days_remaining'];
                                                if ($days <= 0) {
                                                    echo "<span class='text-danger'>Expired</span>";
                                                } else {
                                                    echo $days . " days remaining";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- Edit and delete buttons with confirmation for delete -->
                                                <a class="btn btn-sm btn-primary" href="edit-job.php?id=<?php echo $row['id']; ?>">Edit</a>
                                                <a class="btn btn-sm btn-danger" href="controllers/delete_job_controller.php?id=<?php echo $row['id']; ?>" 
                                                   onclick="return confirm('Are you sure you want to delete this job posting?');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Include footer template -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>
</body>