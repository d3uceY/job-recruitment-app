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

if (isset($_GET['bg_color_3'])) {
    $bg_color_3 = $_GET['bg_color_3'];
}

?>


<body style="background-color: <?php echo $bg_color; ?> !important; color: <?php echo $text_color; ?> !important">
    <?php include("layout/career_nav.php"); ?>
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

        <div class="wrapper !px-4">
            <!-- Main heading -->
            <div class="heading-container !pt-12 !pb-8">
                <h1 class=" text-center" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>Career
                    Opportunities</h1>
            </div>

            <!-- Filter form -->
            <form
                class="filter d-flex md:flex-row flex-col !mb-[3rem] md:!mb-[5rem] justify-content-between align-items-center py-4 px-3 rounded-3"
                method="GET" <?= $bg_color_2 ? "style='background-color: {$bg_color_2} !important'" : '' ?>>

                <p class="flex-1 mb-0 filter-label !text-[1.2rem] font-bold" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                    Filter by:</p>
                <div class="max-w-[500px] w-full">

                    <div class="d-flex w-full justify-between gap-6 !ml-auto">
                        <!-- hidden inputs holding customization values -->
                        <input type="hidden" name="text_color" value="<?= $text_color ?>">
                        <input type="hidden" name="bg_color" value="<?= $bg_color ?>">
                        <input type="hidden" name="bg_color_2" value="<?= $bg_color_2 ?>">
                        <input type="hidden" name="text_color_2" value="<?= $text_color_2 ?>">
                        <input type="hidden" name="btn_text_color" value="<?= $btn_text_color ?>">
                        <input type="hidden" name="btn_color" value="<?= $btn_color ?>">
                        <input type="hidden" name="bg_color_3" value="<?= $bg_color_3 ?>">

                        <!-- Location filter dropdown -->
                        <select name="filter" id="filter" class="filter-select !text-[1rem]" <?= $text_color || $bg_color_2 ? "style='color: {$text_color} !important; background-color: {$bg_color_2} !important'" : '' ?>>
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
                        <select name="sort" id="sort" class="filter-select !text-[1rem]" <?= $text_color || $bg_color_2 ? "style='color: {$text_color} !important; background-color: {$bg_color_2} !important'" : '' ?>>
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
                        <button class="btn btn-primary text-white search-btn !text-[1rem]" <?= $btn_text_color || $btn_color ? "style='background-color: {$btn_color} !important; color: {$btn_text_color} !important'" : '' ?>>Search</button>
                    </div>
                </div>
            </form>

            <!-- Job listings section -->
            <h2 class="job-listings-heading mb-3 !text-[1rem] !font-semibold" <?= $text_color ? "style='color: {$text_color} !important'" : '' ?>>
                Job listings
            </h2>

            <div class="job-listings-container">



                <?php
                // Build base query to get job openings with location details
                //and render the only ones that are not expired
                $query =
                    "SELECT 
                    job_openings.*, 
                    locations.state, 
                    locations.country,
                    DATEDIFF(job_openings.duration, CURDATE()) as days_remaining 
                FROM
                 job_openings 
                LEFT JOIN 
                locations 
                ON 
                job_openings.job_location = locations.id";



                // Add location filter if specified in URL parameters
                if (isset($_GET['filter']) && $_GET['filter'] != "locations") {
                    $query .= " WHERE locations.id = " . mysqli_real_escape_string($conn, $_GET['filter']);
                }



                // Add sort order (default to DESC if not specified)
                $order = isset($_GET['sort']) ? mysqli_real_escape_string($conn, $_GET['sort']) : 'DESC';
                $query .= " ORDER BY job_openings.job_title " . $order;





                // Execute query 
                $result = mysqli_query($conn, $query);


                //if job openings found
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-borderless">';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {

                        // Check if job opening is expired
                        if ($row['days_remaining'] < 0) {
                            continue;
                        }

                        echo '<tr>';
                        echo '<td class="text-capitalize" ' . ($text_color_2 ? "style='color: {$text_color_2} !important'" : '') . '>' . $row['job_title'] . '</td>';
                        echo '<td class="text-capitalize" ' . ($text_color_2 ? "style='color: {$text_color_2} !important'" : '') . '>' .
                            ($row['state'] ? $row['state'] . ', ' . $row['country'] : 'Location not found') .
                            '</td>';
                        echo '<td class="text-end">



                    <a class="btn btn-primary text-white apply-btn" href="application_form.php?job_id=' . $row['id'] .
                            (isset($text_color) ? '&text_color=' . urlencode($text_color) : '') .
                            (isset($bg_color) ? '&bg_color=' . urlencode($bg_color) : '') .
                            (isset($bg_color_2) ? '&bg_color_2=' . urlencode($bg_color_2) : '') .
                            (isset($text_color_2) ? '&text_color_2=' . urlencode($text_color_2) : '') .
                            (isset($bg_color_3) ? '&bg_color_3=' . urlencode($bg_color_3) : '') .
                            (isset($btn_text_color) ? '&btn_text_color=' . urlencode($btn_text_color) : '') .
                            '&btn_color=' . urlencode($btn_color) . '" ' . ($btn_text_color || $btn_color ? "style='background-color: {$btn_color} !important; color: {$btn_text_color} !important'" : '') . '>View/Apply</a></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    //display message if no job openings found
                    echo '<p class="text-center" ' . ($text_color ? "style='color: {$text_color} !important'" : '') . '>No job openings found.</p>';
                }



                //display join our talent community button
                echo '<a class="btn btn-primary text-white py-2 px-4 rounded-md shadow-sm hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 !ml-auto block !w-fit" href="talent_hunt.php?' .
                    (isset($text_color) ? '&text_color=' . urlencode($text_color) : '') .
                    (isset($bg_color) ? '&bg_color=' . urlencode($bg_color) : '') .
                    (isset($bg_color_2) ? '&bg_color_2=' . urlencode($bg_color_2) : '') .
                    (isset($text_color_2) ? '&text_color_2=' . urlencode($text_color_2) : '') .
                    (isset($bg_color_3) ? '&bg_color_3=' . urlencode($bg_color_3) : '') .
                    (isset($btn_text_color) ? '&btn_text_color=' . urlencode($btn_text_color) : '') .
                    '&btn_color=' . urlencode($btn_color) . '" >Join our talent community</a>';

                ?>

            </div>
        </div>
    </main>
    <?php include("layout/career_footer.php"); ?>
</body>