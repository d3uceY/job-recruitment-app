<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Bank It</a>, All Right Reserved.
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- Quill CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="lib/chart/chart.min.js"></script>

<!-- jQuery Easing -->
<script src="lib/easing/easing.min.js"></script>

<!-- Waypoints -->
<script src="lib/waypoints/waypoints.min.js"></script>

<!-- Owl Carousel -->
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Tempus Dominus Date/Time Picker -->
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            responsive: true
        });

        $('#myTable type=[search]').off().on('input', function () {
            var input = $(this).val();
            if (input.length >= 1 || input.length === 0) {
                // Trigger search if input is 1+ characters or empty
                table.search(input).draw();
            }
        });
    });
</script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- Custom Template Javascript -->
<script src="js/main.js"></script>

</body>

</html>