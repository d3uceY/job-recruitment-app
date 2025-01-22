<div class="modal fade" id="openNewApplicationsModal" tabindex="-1" aria-labelledby="openNewApplicationsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openNewApplicationsModalLabel"> Applicant count</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php
                    $query = 'SELECT 
                                        job_openings.id,
                                        job_openings.job_title,
                                        COUNT(job_applications.id) AS total_applicants
                                        FROM job_openings
                                        LEFT JOIN job_applications ON job_openings.id = job_applications.job_id
                                        GROUP BY job_openings.id';

                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="list-group-item">' . $row['job_title'] . ' - ' . $row['total_applicants'] . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>