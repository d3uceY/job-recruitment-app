<div class="modal fade" id="editEducationalLevelModal" tabindex="-1" aria-labelledby="editEducationalLevelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationalLevelModalLabel">Edit
                    Educational Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="controllers/edit_educational_level_controller.php">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Educational
                            Level</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit_level">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to populate and show edit modal
    function editEducationalLevel(id, name) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        var myModal = new bootstrap.Modal(document.getElementById('editEducationalLevelModal'));
        myModal.show();
    }

    // Add event listener to handle modal cleanup
    document.getElementById('editEducationalLevelModal').addEventListener('hidden.bs.modal', function () {
        document.querySelector('.modal-backdrop').remove();
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    });
</script>