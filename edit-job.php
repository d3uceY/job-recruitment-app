<?php
include("includes/db_con.php");


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM job_openings WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>
<?php include 'layout/header.php'; ?>

<body>
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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

            <!-- Job Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Job Posting</h6>
                            <form id="jobForm" method="POST" action="controllers/edit_job_controller.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['job_title']); ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-select" id="location" name="location" required>
                                            <option value="">Select Location</option>
                                            <?php
                                            // Query to get all locations from the locations table
                                            $location_query = "SELECT * FROM locations";
                                            $location_result = mysqli_query($conn, $location_query);

                                            // Loop through each location
                                            while($location = mysqli_fetch_assoc($location_result)) {
                                                // Check if this location matches the job's current location
                                                // If it matches, mark it as selected in the dropdown
                                                $selected = ($location['id'] == $row['job_location']) ? 'selected' : '';

                                                // Output the location as an option in the dropdown
                                                // Format: "State, Country" 
                                                // Value is the location ID
                                                // Use htmlspecialchars to prevent XSS attacks
                                                echo "<option value='" . $location['id'] . "' " . $selected . ">" . 
                                                     htmlspecialchars($location['state'] . ', ' . $location['country']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input type="date" class="form-control" id="duration" name="duration" value="<?php echo $row['duration']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Job Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($row['job_description']); ?></textarea>
                                    </div>
                                </div>

                                <button type="submit" name="edit_job" class="btn btn-primary">Update Job</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Job Form End -->

            <?php include 'layout/footer.php'; ?>
        </div>
    </div>
</body>

<?php
} else {
    header("location:view_jobs.php?error=this operation could not be completed");
}
?>