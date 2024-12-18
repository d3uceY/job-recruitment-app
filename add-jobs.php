<?php
/**
 * Add Jobs Page
 * 
 * This file provides a form interface for administrators to add new job postings.
 * It includes:
 * - Form validation and processing
 * - Success/error message handling through URL parameters
 * - Database connectivity for storing job listings
 * - Protected access (requires authentication)
 * - Responsive layout with sidebar navigation
 * 
 * The page is part of the admin dashboard and requires proper authentication
 * through the protect.inc.php include.
 * 
 * @author https://github.com/d3uceY
 * 
 */

?>

<?php include 'layout/header.php'; ?>
<?php include 'includes/db_con.php'; ?>
<?php include 'includes/protect.inc.php'; ?>

<body>

    <!-- Show success alert if success message exists in URL -->
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;" role="alert">
            ' . $_GET['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Show error alert if error message exists in URL
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
            <!-- Include top navigation bar -->
            <?php include 'layout/navbar.php'; ?>

            <!-- Job posting form -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Job Posting</h6>
                            <!-- Form for submitting job details -->
                            <form id="jobForm" method="POST" action="controllers/add_job_controller.php">
                                <!-- Job title input -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                </div>

                                <!-- Location and duration inputs -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-select" id="location" name="location" required>
                                            <option value="">Select Location</option>
                                            <?php
                                            // Fetch and display all locations from database
                                            $query = "SELECT * FROM locations";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['state'] . ", " . $row['country'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input type="date" class="form-control" id="duration" name="duration" required>
                                    </div>
                                </div>

                                <!-- Hidden fields to store Quill editor content -->
                                <input type="hidden" name="summary" id="summary_content">
                                <input type="hidden" name="responsibilities" id="responsibilities_content">
                                <input type="hidden" name="requirements" id="requirements_content">

                                <!-- Rich text editors for detailed job information -->
                                <div class="mb-3">
                                    <label class="form-label">Job Summary</label>
                                    <div id="summary_editor" style="height: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Responsibilities</label>
                                    <div id="responsibilities_editor" style="height: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Requirements</label>
                                    <div id="requirements_editor" style="height: 200px;">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Add Job" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include footer -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>

    <!-- JavaScript for Quill rich text editors -->
    <script>
        // Initialize Quill editors with snow theme
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

        // Handle form submission by updating hidden fields with editor content
        const form = document.getElementById('jobForm');
        form.onsubmit = function () {
            document.getElementById('summary_content').value = summaryEditor.root.innerHTML;
            document.getElementById('responsibilities_content').value = responsibilitiesEditor.root.innerHTML;
            document.getElementById('requirements_content').value = requirementsEditor.root.innerHTML;
            console.log(document.getElementById('requirements_content').value);
            return true;
        };
    </script>
</body>