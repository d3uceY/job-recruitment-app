<?php
/**
 * Career Page
 * 
 * This file displays career opportunities and job listings.
 * It includes a filter form to search jobs by location and sort order.
 * The page layout includes a header, main content area with job listings,
 * and uses Bootstrap classes for styling and responsive design.
 * 
 * @author https://github.com/d3uceY
 * 
 */

include("includes/db_con.php");
?>


<?php include("layout/career_header.php"); ?>



<?php

// Initialize variables with default values
$text_color = null;
$bg_color = null;
$bg_color_2 = null;
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


<body style="background-color: <?php echo $bg_color; ?> !important; color: <?php echo $text_color; ?> !important">

    <main>

        <?php
        // Show success/error message if status is set
        if (isset($_GET['status'])): ?>
            <!-- Display alert message based on status parameter -->
            <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x"
                style="z-index: 1050;" role="alert">
                <?php echo $_GET['status'] == 'success' ? 'Application submitted successfully!' : urldecode($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif;
        ?>

        <div class="wrapper">
            <!-- Main heading -->
            <div class="heading-container">
                <h1 class=" text-uppercase" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>Career
                    Opportunities</h1>
            </div>

            <!-- Filter form -->
            <form class="filter d-flex justify-content-between align-items-center py-4 px-3 rounded-3" method="GET"
                <?= $bg_color_2 ? "style='background-color: {$bg_color_2} !important'" : '' ?>>
                <p class="flex-1 mb-0 filter-label" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                    Filter by:</p>
                <div class="d-flex justify-content-between  flex-2">

                    <!-- Location filter dropdown -->
                    <select name="filter" id="filter" class="filter-select" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                        <option value="locations">All
                            Locations
                        </option>

                        <?php
                        // Fetch all locations from the database and populate dropdown
                        $query = "SELECT * FROM locations";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Mark currently selected location
                            $selected = '';
                            if (isset($_GET['filter']) && $_GET['filter'] == $row['id']) {
                                $selected = 'selected';
                            }

                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['state'] . '</option>';
                        }
                        ?>

                    </select>

                    <!-- Sort order dropdown -->
                    <select name="sort" id="sort" class="filter-select" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                        <?php
                        // Helper function to check if sort option should be selected
                        function get_sort_option($sort_value)
                        {
                            if (isset($_GET['sort']) && $_GET['sort'] === $sort_value) {
                                return 'selected';
                            }
                            return '';
                        }
                        ?>

                        <option value="DESC" <?php echo get_sort_option('DESC') ?>>DESC</option>
                        <option value="ASC" <?php echo get_sort_option('ASC') ?>>ASC</option>

                    </select>
                    <button class="btn btn-primary text-white search-btn" <?= $btn_text_color || $btn_color ? "style='background-color: {$btn_color} !important; color: {$btn_text_color} !important'" : '' ?>>Search</button>
                </div>
            </form>

            <!-- Job listings section -->
            <h2 class="job-listings-heading mb-3" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                Job listings
            </h2>

            <div class="job-listings-container">
                <?php
                // Build base query to get job openings with location details
                $query = "SELECT 
                    job_openings.*, 
                    locations.state, 
                    locations.country 
                FROM job_openings 
                LEFT JOIN locations ON job_openings.job_location = locations.id";

                // Add location filter if specified in URL parameters
                if (isset($_GET['filter']) && $_GET['filter'] != "locations") {
                    $query .= " WHERE locations.id = " . mysqli_real_escape_string($conn, $_GET['filter']);
                }

                // Add sort order (default to DESC if not specified)
                $order = isset($_GET['sort']) ? mysqli_real_escape_string($conn, $_GET['sort']) : 'DESC';
                $query .= " ORDER BY job_openings.job_title " . $order;

                // For debugging purposes
                // echo $query; // Uncomment this line to see the actual query
                
                // Execute query and display results in table format
                $result = mysqli_query($conn, $query);
                echo '<table class="table table-borderless">';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td class="text-capitalize" ' . ($text_color_2 ? "style='color: {$text_color_2} !important'" : '') . '>' . $row['job_title'] . '</td>';
                    echo '<td class="text-capitalize" ' . ($text_color_2 ? "style='color: {$text_color_2} !important'" : '') . '>' .
                        ($row['state'] ? $row['state'] . ', ' . $row['country'] : 'Location not found') .
                        '</td>';
                    echo '<td class="text-end">

                    <a class="btn btn-primary text-white apply-btn" href="application_form.php?job_id=' . $row['id'] . '&text_color=' . $text_color . '&bg_color=' . $bg_color . '&bg_color_2=' . $bg_color_2 . '&text_color_2=' . $text_color_2 . '&btn_text_color=' . $btn_text_color . '&btn_color=' . $btn_color . '" ' . ($btn_text_color || $btn_color ? "style='background-color: {$btn_color} !important; color: {$btn_text_color} !important'" : '') . '>View/Apply</a></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                ?>
            </div>
        </div>
    </main>
</body>