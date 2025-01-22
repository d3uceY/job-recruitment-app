<div class="row g-4">



    <?php
    //this query will count the number of applicants for each referral
//by selecting the referral id, referral, and the count of the number of applicants
    $query = "SELECT 
referrals.id, 
referrals.referral, 
COUNT(job_applications.id) AS applicant_count
FROM 
referrals
LEFT JOIN 
job_applications 
ON 
referrals.id = job_applications.referral_id
GROUP BY 
referrals.id, referrals.referral
ORDER BY 
applicant_count DESC";

    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Extract values from the row
            $referral = htmlspecialchars($row['referral']);
            $applicant_count = $row['applicant_count'];
            ?>

            <div class="col-sm-4 col-md-3">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0"><?php echo $referral; ?></h6>
                        <!-- <a href="" class="text-primary"><i class="fa fa-eye"></i></a> -->
                    </div>
                    <div class="d-flex align-items-center py-2">
                        <div class="d-flex align-items-center w-100">
                            <i class="fa fa-users me-2 text-primary"></i>
                        <span class="fw-bold"> <?php echo ($applicant_count == 0) ? '__' : $applicant_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<p class='text-center'>No referrals found.</p>";
    }
    ?>

</div>