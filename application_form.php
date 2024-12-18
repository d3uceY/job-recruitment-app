<?php
// Include database connection
/**
 * Application Form Page
 * 
 * This file handles job application submissions and displays job details.
 * It includes:
 * - Job details display fetched from database
 * - Application form interface
 * - Form validation and processing
 * - Success/error message handling through URL parameters
 * - Database connectivity for storing applications
 * 
 * @author https://github.com/d3uceY
 * 
 */

include("includes/db_con.php");
?>

<?php
// Include header template
include("layout/career_header.php");
?>

<?php
// Fetch job details from the database if job_id is set
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Query to get job details with days remaining and formatted date
    $query = "SELECT *, 
                DATEDIFF(job_openings.duration, CURDATE()) AS days_left,
                DATE_FORMAT(job_openings.duration, '%M %D, %Y') AS formatted_date
              FROM job_openings 
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    header('location:career.php?status=error&message=' . urlencode('Invalid request method.'));
    exit();
}
?>

<main>
    <div class="container">
        <?php
        // Show success/error message if status is set
        if (isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> mt-3">
                <?php echo $_GET['status'] == 'success' ? 'Application submitted successfully!' : urldecode($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Job Title Header -->
        <div class="heading-container">
            <div class="application-form-header d-flex justify-content-between align-items-center">
                <h1 class="text-uppercase"><?php echo $row['job_title']; ?></h1>
                <a href="#apply" class="btn btn-primary text-white apply-btn">APPLY</a>
            </div>
        </div>

        <!-- Job Details Section -->
        <div class="job-details rounded-3 p-4">
            <?php
            // Space for additional PHP code if needed
            ?>
            <h2 class="job-listings-heading mb-3">Application Deadline:
                <?php echo $row['formatted_date']; ?>
                <div class="days-left">
                    <?php echo '(<span class="text-danger">' . $row['days_left'] . '</span> days left)' ?>
                </div>
            </h2>

            <!-- Job Summary -->
            <div class="mb-4">
                <h3 class="filter-label">Job Summary</h3>
                <div class="job-content"><?php echo $row['job_summary']; ?></div>
            </div>

            <!-- Job Responsibilities -->
            <div class="mb-4">
                <h3 class="filter-label">Responsibilities</h3>
                <div class="job-content"><?php echo $row['job_responsibility']; ?></div>
            </div>

            <!-- Job Requirements -->
            <div class="mb-4">
                <h3 class="filter-label">Job Requirement</h3>
                <div class="job-content"><?php echo $row['job_requirements']; ?></div>
            </div>
        </div>

        <!-- Application Form Section -->
        <div class="application-form-container">
            <h2 class="application-form-heading mb-4">Apply for this job</h2>

            <div class="bg-white rounded-3 p-4">
                <form id="jobApplication" action="controllers/application_form_controller.php" method="POST"
                    enctype="multipart/form-data">
                    <!-- Hidden Job ID -->
                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

                    <!-- Personal Information Section -->
                    <div class="row g-4 mb-4">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="First Name" required>
                                <label for="firstName">First Name</label>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Last Name" required>
                                <label for="lastName">Last Name</label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                    required>
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="address" name="address" placeholder="Address"
                            style="height: 100px" required></textarea>
                        <label for="address">Complete Address</label>
                    </div>

                    <!-- Professional Information Section -->
                    <div class="row g-4 mb-4">
                        <!-- Educational Qualifications -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="education" name="education" required>
                                    <option value="">Select highest education</option>

                                    <?php
                                    // Fetch and display educational levels from database
                                    $education_query = "SELECT * FROM educational_level";
                                    $education_result = mysqli_query($conn, $education_query);

                                    while ($education_row = mysqli_fetch_assoc($education_result)) {
                                        echo '<option value="' . $education_row['education'] . '">' . $education_row['education'] . '</option>';
                                    }
                                    ?>

                                    <option value="Other">Other</option>
                                </select>
                                <label for="education">Educational Qualifications</label>
                            </div>
                        </div>

                        <!-- Industry Experience -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="industry" name="industry" required>
                                    <option value="">Select previous industry</option>

                                    <?php
                                    // Fetch and display industry categories from database
                                    $industry_query = "SELECT * FROM industry_category";
                                    $industry_result = mysqli_query($conn, $industry_query);

                                    while ($industry_row = mysqli_fetch_assoc($industry_result)) {
                                        echo '<option value="' . $industry_row['category'] . '">' . $industry_row['category'] . '</option>';
                                    }
                                    ?>

                                    <option value="Other">Other</option>
                                </select>
                                <label for="industry">Previous Industry Experience</label>
                            </div>
                        </div>

                        <!-- Years of Experience -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="experience" name="experience"
                                    placeholder="Experience" required>
                                <label for="experience">Years of Experience</label>
                            </div>
                        </div>

                        <!-- Expected Salary -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary"
                                    required>
                                <label for="salary">Expected Salary (NGN)</label>
                            </div>
                        </div>
                    </div>


                    <!-- Preferred Job Location -->
                    <div class="col-md-12">
                        <div class="form-floating mb-4">
                            <select class="form-control" id="location" name="preferred_location" required>
                                <option value="">Select preferred location</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross River">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="FCT">Federal Capital Territory</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                            </select>
                            <label for="location">Preferred Job Location</label>
                        </div>
                    </div>



                    <!-- Cover Letter Section -->
                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="coverLetter" name="coverLetter" placeholder="Cover Letter"
                            style="height: 200px" required></textarea>
                        <label for="coverLetter">Cover Letter</label>
                    </div>

                    <!-- Resume Upload Section -->
                    <div class="mb-4">
                        <label for="resume" class="form-label">Upload Resume/CV</label>
                        <input class="form-control" type="file" id="resume" name="resume" accept=".pdf,.doc,.docx"
                            required>
                        <div class="form-text">Accepted formats: PDF, DOC, DOCX. Max size: 2MB</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" name="submit" class="btn btn-primary apply-btn">Submit
                            Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>