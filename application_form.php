<?php
include("includes/db_con.php");
?>

<?php include("layout/career_header.php"); ?>

<?php

// fetch job details from the database
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

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
}
?>

<main>
    <div class="container">
        <div class="heading-container">
            <div class="application-form-header d-flex justify-content-between align-items-center">
                <h1 class="text-uppercase"><?php echo $row['job_title']; ?></h1>
                <a href="#apply" class="btn btn-primary text-white apply-btn">APPLY</a>
            </div>
        </div>

        <div class="job-details rounded-3 p-4">
            <?php

            ?>
            <h2 class="job-listings-heading mb-3">Application Deadline:
                <?php echo $row['formatted_date']; ?>
                <div class="days-left">
                    <?php echo '(<span class="text-danger">' . $row['days_left'] . '</span> days left)' ?>
                </div>
            </h2>

            <div class="mb-4">
                <h3 class="filter-label">Job Summary</h3>
                <div class="job-content"><?php echo $row['job_summary']; ?></div>
            </div>

            <div class="mb-4">
                <h3 class="filter-label">Responsibilities</h3>
                <div class="job-content"><?php echo $row['job_responsibility']; ?></div>
            </div>

            <div class="mb-4">
                <h3 class="filter-label">Job Requirement</h3>
                <div class="job-content"><?php echo $row['job_requirements']; ?></div>
            </div>
        </div>
        <div class="application-form-container">
            <h2 class="application-form-heading mb-4">Apply for this job</h2>

            <div class="bg-white rounded-3 p-4">
                <form id="jobApplication" method="POST" enctype="multipart/form-data">
                    <!-- Personal Information -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="First Name" required>
                                <label for="firstName">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Last Name" required>
                                <label for="lastName">Last Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                    required>
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="address" name="address" placeholder="Address"
                            style="height: 100px" required></textarea>
                        <label for="address">Complete Address</label>
                    </div>

                    <!-- Professional Information -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="education" name="education" required>
                                    <option value="">Select highest education</option>



                                    <?php
                                    // fetch all educational levels from the database
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

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="industry" name="industry" required>
                                    <option value="">Select previous industry</option>




                                    <?php
                                    // fetch all industries from the  database
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
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="experience" name="experience"
                                    placeholder="Experience" required>
                                <label for="experience">Years of Experience</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary"
                                    required>
                                <label for="salary">Expected Salary (PHP)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Resume Upload -->
                    <div class="mb-4">
                        <label for="resume" class="form-label">Upload Resume/CV</label>
                        <input class="form-control" type="file" id="resume" name="resume" accept=".pdf,.doc,.docx"
                            required>
                        <div class="form-text">Accepted formats: PDF, DOC, DOCX. Max size: 2MB</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary apply-btn">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>