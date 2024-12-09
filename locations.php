<?php include 'layout/header.php'; ?>
<?php include 'includes/db_con.php'; ?>
<?php include 'includes/protect.inc.php'; ?>
<!-- 
    This file manages the locations functionality of the application.
    It provides a form to add new locations (state and country) and displays existing locations.
    The file includes:
    - Form for adding new locations that submits to add_location_controller.php
    - Display of success/error messages via URL parameters
    - Integration with database through db_con.php
    - Full page layout with header, sidebar and navbar components
-->

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

            <!-- Location Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Location</h6>

                            <form method="POST" action="controllers/add_location_controller.php">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Eg: "Lagos, Nigeria"</small>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Location" name="add_location">
                            </form>

                        </div>
                    </div>
                    <!-- New Location Table -->
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Locations</h6>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">State</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $query = "SELECT * FROM locations";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die('Query Failed' . mysqli_error($conn));
                                        } else {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['state']; ?></td>
                                                    <td><?php echo $row['country']; ?></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="controllers/delete_locations_controller.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Location Form End -->

            <!-- Footer Start -->
            <?php include 'layout/footer.php'; ?>
        </div>
        <!-- Content End -->
    </div>
</body>