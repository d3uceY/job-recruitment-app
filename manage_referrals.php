<?php
/*
 * Referral Management Page
 * 
 * This page provides an interface to manage referrals including:
 * - Adding new referrals via a form
 * - Displaying existing referrals in a table
 * - Editing referrals through a modal popup
 * - Deleting referrals
 * 
 * The page includes:
 * - Success/error message alerts
 * - Loading spinner
 * - Add industry form
 * - Referrals table with edit/delete actions
 * 
 * @author https://github.com/d3uceY
 * 
 */

include 'includes/db_con.php';
include 'layout/header.php';
include 'includes/protect.inc.php';
?>

<body>
    <?php
    // Display success/error messages
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
        <!-- Spinner Loading -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <?php include 'layout/sidebar.php'; ?>

        <div class="content">
            <?php include 'layout/navbar.php'; ?>

            <!-- Form Section -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Referral</h6>
                            <form method="POST" action="controllers/add_referral_controller.php">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Referral Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Eg: "LinkedIn", "Facebook", "Google"</small>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Referral" name="add_referral">
                            </form>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Referrals</h6>
                            <div class="table-responsive">
                                <table id="myTable"
                                    class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Referral Name</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM referrals";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die('Query Failed' . mysqli_error($conn));
                                        } else {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['referral']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#editReferralModal"
                                                            onclick="editReferral('<?php echo $row['id']; ?>', '<?php echo $row['referral']; ?>')">Edit</button>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="controllers/delete_referral_controller.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- referral edit modal -->
                                <?php include 'includes/referral_edit_modal.php'; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'layout/footer.php'; ?>
        </div>
    </div>
</body>