<div class="modal fade" id="openTotalApplicationsModal" tabindex="-1" aria-labelledby="openTotalApplicationsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openTotalApplicationsModalLabel">Applicant status count
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php
                    $query = 'SELECT 
                                        job_application_status.id,
                                        job_application_status.status,
                                        COUNT(job_applications.id) AS total_applicants
                                        FROM job_application_status
                                        LEFT JOIN job_applications ON job_application_status.status = job_applications.status
                                        GROUP BY job_application_status.id
                                        ORDER BY total_applicants DESC
                                        ';

                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="list-group-item">' . $row['status'] . ' - ' . $row['total_applicants'] . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>