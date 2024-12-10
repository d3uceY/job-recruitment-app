<?php include 'layout/header.php'; ?>
<?php include 'includes/db_con.php'; ?>
<?php include 'includes/protect.inc.php'; ?>

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

            <!-- Job Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Job Posting</h6>
                            <form id="jobForm" method="POST" action="controllers/add_job_controller.php">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-select" id="location" name="location" required>
                                            <option value="">Select Location</option>
                                            <?php
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

                                <!-- Hidden inputs for Quill content -->
                                <input type="hidden" name="summary" id="summary_content">
                                <input type="hidden" name="responsibilities" id="responsibilities_content">
                                <input type="hidden" name="requirements" id="requirements_content">

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
            <!-- Job Form End -->

            <!-- Footer Start -->
            <?php include 'layout/footer.php'; ?>
        </div>
        <!-- Content End -->
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
        form.onsubmit = function () {
            // Update hidden fields with editor content
            document.getElementById('summary_content').value = summaryEditor.root.innerHTML;
            document.getElementById('responsibilities_content').value = responsibilitiesEditor.root.innerHTML;
            document.getElementById('requirements_content').value = requirementsEditor.root.innerHTML;
            console.log(document.getElementById('requirements_content').value);
            return true;
        };
    </script>
</body>