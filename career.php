<?php
// This file displays career opportunities and job listings
// It includes a filter form to search jobs by location and sort order
// The page layout includes a header, main content area with job listings,
// and uses Bootstrap classes for styling and responsive design

include("includes/db_con.php");
?>


<?php include("layout/career_header.php"); ?>


<main>
    <div class="wrapper">
        <div class="heading-container">
            <h1 class=" text-uppercase">Career Opportunities</h1>
        </div>

        <form class="filter d-flex justify-content-between align-items-center py-4 px-3 rounded-3" method="GET">
            <p class="flex-1 mb-0 filter-label">Filter by:</p>
            <div class="d-flex justify-content-between  flex-2">

                <select name="filter" id="filter" class="filter-select">
                    <option value="locations">All Locations</option>


                    <?php
                    // Fetch all locations from the database
                    $query = "SELECT * FROM locations";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $selected = '';
                        if (isset($_GET['filter']) && $_GET['filter'] == $row['id']) {
                            $selected = 'selected';
                        }

                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['state'] . '</option>';
                    }
                    ?>


                </select>
                <select name="sort" id="sort" class="filter-select">


                    <?php
                    // Function to check if a sort option should be selected based on URL parameter
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
                <button class="btn btn-primary text-white search-btn">Search</button>
            </div>
        </form>

        <h2 class="job-listings-heading mb-3">
            Job listings
        </h2>

        <div class="job-listings-container">




            <?php


            // Get the location order from the URL parameter
            // Initialize empty location filter
            $locationFilter = "";

            // Check if filter parameter exists in URL
            if (isset($_GET['filter'])) {
                // Only set location filter if not "locations" (all locations)
                if ($_GET['filter'] != "locations") {
                    $locationFilter = $_GET['filter'];
                }
            }




            // Build the base query
            $query = "SELECT 
                job_openings.*, 
                locations.state, 
                locations.country 
            FROM job_openings 
            LEFT JOIN locations ON job_openings.job_location = locations.id";



            // Add location filter if specified
            if (isset($_GET['filter']) && $_GET['filter'] != "locations") {
                $query .= " WHERE locations.id = " . mysqli_real_escape_string($conn, $_GET['filter']);
            }


            // Add sorting (with default DESC if not specified)
            $order = isset($_GET['sort']) ? mysqli_real_escape_string($conn, $_GET['sort']) : 'DESC';
            $query .= " ORDER BY job_openings.job_title " . $order;

            // For debugging
            // echo $query; // Uncomment this line to see the actual query



            
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="job-listing d-flex justify-content-between align-items-center p-3">';
                echo '<p class="job-title mb-0 text-capitalize">' . $row['job_title'] . '</p>';
                echo '<p class="location mb-0 text-capitalize">' .
                    ($row['state'] ? $row['state'] . ', ' . $row['country'] : 'Location not found') .
                    '</p>';
                echo '<button class="btn btn-primary text-white apply-btn">View/Apply</button>';
                echo '</div>';
            }




            ?>

        </div>
    </div>
</main>