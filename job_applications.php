<?php
/*
 * Job Applications Page
 * This page manages job applications and their display
 * Includes the standard layout components (header, sidebar, navbar)
 */

include 'includes/db_con.php'; // Database connection
include 'layout/header.php';  // Page header template
include 'includes/protect.inc.php';
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

            <!-- Main content for job applications -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Job Applications</h6>
                            <div class="table-responsive">
                                <table id="myTable"
                                    class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone No</th>
                                            <th scope="col">Industry</th>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">Experience (Years)</th>
                                            <th scope="col">Preferred Location</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        <?php
                                        // Fetch and display job applications
                                        $sql = "SELECT job_applications.*, 
                                               job_openings.job_title 
                                        FROM job_applications 
                                        LEFT JOIN job_openings 
                                            ON job_applications.job_id = job_openings.id";

                                        $result = mysqli_query($conn, $sql);




                                        while ($row = mysqli_fetch_assoc($result)) {




                                            // Display the row data
                                            echo "<tr>";
                                            echo "<td>" . $row['first_name'] . "</td>";
                                            echo "<td>" . $row['last_name'] . "</td>";
                                            echo "<td>" . $row['job_title'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['industry'] . "</td>";
                                            echo "<td>" . $row['education'] . "</td>";
                                            echo "<td>" . $row['experience'] . "</td>";
                                            echo "<td>" . $row['preferred_location'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";




                                            // Display the manage button and view cv button
                                            echo "<td class=''>
                                                <a href='manage_job_applications.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Manage</a>
                                                <a href='uploads/resumes/" . $row['resume_path'] . "' target='_blank' class='btn btn-sm btn-info'>View CV</a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <!-- Page footer -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>

    <!-- Add any necessary JavaScript -->
    <script>
        // Add your custom JavaScript here
    </script>
</body>
</rewritten_file>