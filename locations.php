<?php include 'layout/header.php'; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                            <form>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
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
                                        <tr>
                                            <td>California</td>
                                            <td>USA</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="">Delete</a>
                                            </td>
                                        </tr>
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
