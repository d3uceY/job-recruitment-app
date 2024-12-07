<?php
/*
 * Educational Level Management Page
 * This page provides an interface to manage educational levels including:
 * - Adding new educational levels via a form
 * - Displaying existing educational levels in a table
 * - Editing educational levels through a modal popup
 * - Deleting educational levels
 * Includes success/error alerts for user feedback
 */

include 'includes/db_con.php'; // Database connection
include 'layout/header.php';  // Page header template
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

            <!-- Form section for adding new educational level -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Educational Level</h6>
                            <form method="POST" action="controllers/add_educational_level_controller.php">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Educational Level</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Example: "B.Sc", "HND", "NCE", "OND", "SSCE"</small>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Level" name="add_level">
                            </form>
                        </div>
                    </div>
                    <!-- Table displaying existing educational levels -->
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Educational Levels</h6>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Name</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display all educational levels
                                        $query = "SELECT * FROM educational_level";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die('Query Failed' . mysqli_error($conn));
                                        } else {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['education']; ?></td>
                                                    <td>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#editEducationalLevelModal"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="editEducationalLevel('<?php echo $row['id']; ?>','<?php echo $row['education']; ?>')">Edit</button>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="controllers/delete_educational_level_controller.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Modal for editing educational level -->
                                <?php include 'includes/education_edit_modal.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page footer -->
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>
</body>