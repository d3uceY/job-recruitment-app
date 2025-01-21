<?php
/**
 * Manage Job Applications Page
 * 
 * This file manages job applications and their display.
 * It includes:
 * - Displaying job application details
 * - Updating application status
 * - Deleting applications
 * 
 * @author https://github.com/d3uceY
 * 
 */

include 'layout/header.php';
include 'includes/db_con.php';
include 'includes/protect.inc.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT ja.*, jo.job_title 
              FROM job_applications ja 
              LEFT JOIN job_openings jo ON ja.job_id = jo.id 
              WHERE ja.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $application = $result->fetch_assoc();
    ?>

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <?php include 'layout/sidebar.php'; ?>

            <div class="content">
                <?php include 'layout/navbar.php'; ?>

                <!-- Application Form Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="bg-light rounded h-100 p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h6>Job Application Details</h6>
                                    <a href="job_applications.php" class="btn btn-secondary btn-sm">Back to Applications</a>
                                </div>

                                <form action="controllers/update_status_controller.php" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Job Title</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['job_title']); ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Application Date</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['application_date']); ?>"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['first_name']); ?>"
                                                readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['last_name']); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control"
                                                value="<?php echo htmlspecialchars($application['email']); ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['phone']); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" rows="2"
                                            readonly><?php echo htmlspecialchars($application['address']); ?></textarea>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Education</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['education']); ?>" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Industry</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['industry']); ?>" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Experience (Years)</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['experience']); ?>"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Expected Salary</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['expected_salary']); ?>"
                                                readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Preferred Location</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlspecialchars($application['preferred_location']); ?>"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Cover Letter</label>
                                        <textarea class="form-control" rows="4"
                                            readonly><?php echo htmlspecialchars($application['cover_letter']); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>


                                        <select name="status" class="form-control">
                                            <option value="NEW" <?php echo ($application['status'] == 'NEW') ? 'selected' : ''; ?>>NEW</option>
                                            <option value="PENDING" <?php echo ($application['status'] == 'PENDING') ? 'selected' : ''; ?>>PENDING</option>
                                            <option value="OPENED" <?php echo ($application['status'] == 'OPENED') ? 'selected' : ''; ?>>OPENED</option>
                                            <option value="SHORTLISTED" <?php echo ($application['status'] == 'SHORTLISTED') ? 'selected' : ''; ?>>SHORTLISTED</option>
                                            <option value="REJECTED" <?php echo ($application['status'] == 'REJECTED') ? 'selected' : ''; ?>>REJECTED</option>
                                            <option value="HIRED" <?php echo ($application['status'] == 'HIRED') ? 'selected' : ''; ?>>HIRED</option>
                                        </select>



                                    </div>

                                    <input type="hidden" name="id" value="<?php echo $application['id']; ?>">

                                    <!-- Update Status -->
                                    <button type="submit" class="btn btn-primary" name="update_status">Update
                                        Status</button>

                                    <!-- Delete Application -->
                                    <a href="controllers/delete_application_controller.php?id=<?php echo $application['id']; ?>"
                                        class="btn btn-danger">Delete Application</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Application Form End -->

                <?php include 'layout/footer.php'; ?>
            </div>
        </div>
    </body>
    <?php
} else {
    // Redirect to applications page if no ID is provided
    header('Location: job_applications.php');
    exit();
}
?>