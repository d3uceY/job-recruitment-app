<?php
// Include database connection
include("includes/db_con.php");

// Check if job ID is provided in URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch job details from database using prepared statement
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
    // Display success message if present
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Display error message if present
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <!-- Main container -->
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Loading spinner -->
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

            <!-- Job editing form section -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Job Posting</h6>
                            <!-- Form for editing job details -->
                            <form id="jobForm" method="POST" action="controllers/edit_job_controller.php">
                                <!-- Hidden field for job ID -->
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                
                                <!-- Job title field -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['job_title']); ?>" required>
                                    </div>
                                </div>

                                <!-- Location and duration fields -->
                                <div class="row mb-3">
                                    <!-- Location dropdown -->
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-select" id="location" name="location" required>
                                            <option value="">Select Location</option>
                                            <?php
                                            // Fetch all locations from database
                                            $location_query = "SELECT * FROM locations";
                                            $location_result = mysqli_query($conn, $location_query);

                                            // Generate location options
                                            while($location = mysqli_fetch_assoc($location_result)) {
                                                // Mark current location as selected
                                                $selected = ($location['id'] == $row['job_location']) ? 'selected' : '';

                                                // Display location option with XSS protection
                                                echo "<option value='" . $location['id'] . "' " . $selected . ">" . 
                                                     htmlspecialchars($location['state'] . ', ' . $location['country']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Duration field -->
                                    <div class="col-md-6">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input type="date" class="form-control" id="duration" name="duration" value="<?php echo $row['duration']; ?>" required>
                                    </div>
                                </div>

                                <!-- Job description field -->
                                <div class="row mb-3">
                                    <!-- Remove the old description textarea and add hidden inputs for Quill content -->
                                    <input type="hidden" name="summary" id="summary_content">
                                    <input type="hidden" name="responsibilities" id="responsibilities_content">
                                    <input type="hidden" name="requirements" id="requirements_content">

                                    <div class="mb-3">
                                        <label class="form-label">Job Summary</label>
                                        <div id="summary_editor" style="height: 200px;">
                                            <?php echo $row['job_summary']; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Responsibilities</label>
                                        <div id="responsibilities_editor" style="height: 200px;">
                                            <?php echo $row['job_responsibility']; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Requirements</label>
                                        <div id="requirements_editor" style="height: 200px;">
                                            <?php echo $row['job_requirements']; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="edit_job" class="btn btn-primary">Update Job</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include footer -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>

    <!-- Initialize Quill editors -->
    <script>
        // Initialize Quill editors
        const summaryEditor = new Quill('#summary_editor', {
            theme: 'snow',
            placeholder: 'Enter job summary...'
        });

        const responsibilitiesEditor = new Quill('#responsibilities_editor', {
            theme: 'snow',
            placeholder: 'Enter job responsibilities...'
        });     

        const requirementsEditor = new Quill('#requirements_editor', {
            theme: 'snow',
            placeholder: 'Enter job requirements...'
        });

        // Handle form submission
        const form = document.getElementById('jobForm');
        form.onsubmit = function() {
            // Update hidden fields with editor content
            document.getElementById('summary_content').value = summaryEditor.root.innerHTML;
            document.getElementById('responsibilities_content').value = responsibilitiesEditor.root.innerHTML;
            document.getElementById('requirements_content').value = requirementsEditor.root.innerHTML;
            return true;
        };
    </script>
</body>

<?php
} else {
    // Redirect if no job ID provided
    header("location:view_jobs.php?error=this operation could not be completed");
}
?>