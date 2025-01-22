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

// Initialize variables with default values
$text_color = null;
$bg_color = null;
$bg_color_2 = null;
$bg_color_3 = null;
$text_color_2 = null;
$btn_text_color = null;
$btn_color = null;



// query string template for customization
if (isset($_GET['text_color'])) {
    $text_color = $_GET['text_color'];
}

if (isset($_GET['bg_color'])) {
    $bg_color = $_GET['bg_color'];
}

if (isset($_GET['bg_color_2'])) {
    $bg_color_2 = $_GET['bg_color_2'];
}

if (isset($_GET['text_color_2'])) {
    $text_color_2 = $_GET['text_color_2'];
}

if (isset($_GET['btn_text_color'])) {
    $btn_text_color = $_GET['btn_text_color'];
}

if (isset($_GET['btn_color'])) {
    $btn_color = $_GET['btn_color'];
}
?>




<style>
    .bg_color {
        background-color:
            <?= $bg_color; ?>
            !important;
    }

    .text_color {
        color:
            <?= $text_color; ?>
            !important;
    }

    .bg_color_2 {
        background-color:
            <?= $bg_color_2; ?>
            !important;
    }

    .text_color_2,
    .text_color_2 * {
        color:
            <?= $text_color_2; ?>
            !important;
    }

    .btn_color {
        background-color:
            <?= $btn_color; ?>
            !important;
        color:
            <?= $btn_text_color; ?>
            !important;
    }

    .bg_color_2 {
        background-color:
            <?= $btn_color_2; ?>
            !important;
        color:
            <?= $btn_text_color_2; ?>
            !important;
    }

    .bg_color_3 {
        background-color:
            <?= $bg_color_3; ?>
            !important;
    }
</style>



<main class="bg_color">
    <div class="container">
        <?php
        // Show success/error message if status is set
        if (isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> mt-3">
                <?php echo $_GET['status'] == 'success' ? 'Application submitted successfully!' : urldecode($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-danger mt-3">
                <?php echo urldecode($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Application Form Section -->
        <div class="application-form-container" id="apply">
            <h2 class="application-form-heading mb-4 text_color">Talent hunt</h2>

            <div class="bg-white rounded-3 p-4  bg_color_2">

                <form id="jobApplication" action="controllers/talent_application_form_controller.php" method="POST"
                    enctype="multipart/form-data">
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

                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="desired_role" name="desired_role" placeholder=""
                            required></textarea>
                        <label for="address">Desired Role / Position</label>
                    </div>

                    <!-- Professional Information Section -->
                    <div class="row g-4 mb-4">
                        <!-- Educational Qualifications -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="education" name="education" required>
                                    <option value="">Select Educational Qualification</option>

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




                        <!-- Years of Experience -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="experience" name="experience"
                                    placeholder="Experience" required>
                                <label for="experience">Years of Experience</label>
                            </div>
                        </div>

                        <!-- Expected Salary -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary"
                                    required>
                                <label for="salary">Expected Salary (NGN)</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills"
                                    required>
                                <label for="skills">Relevant skills / certifications</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                                <label for="start_date">Relevant skills / certifications</label>
                            </div>
                        </div>
                    </div>





                    <!-- Resume Upload Section -->
                    <div class="mb-4">
                        <label for="coverLetter" class="form-label">Upload Cover Letter</label>
                        <input class="form-control" type="file" id="coverLetter" name="cover_letter"
                            accept=".pdf,.doc,.docx">
                        <div class="form-text">Accepted formats: PDF, DOC, DOCX. Max size: 2MB</div>
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
                        <button type="submit" name="submit" class="btn btn-primary apply-btn btn_color ">Submit
                            Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>