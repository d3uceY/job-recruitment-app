                                <!-- Edit Modal -->
                                <div class="modal fade" id="editIndustryModal" tabindex="-1" aria-labelledby="editIndustryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editIndustryModalLabel">Edit Industry Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="controllers/edit_industry_controller.php">
                                                <div class="modal-body">
                                                    <input type="hidden" id="edit_id" name="id">
                                                    <div class="mb-3">
                                                        <label for="edit_name" class="form-label">Industry Category</label>
                                                        <input type="text" class="form-control" id="edit_name" name="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_industry">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function editIndustry(id, name) {
                                        document.getElementById('edit_id').value = id;
                                        document.getElementById('edit_name').value = name;
                                        var myModal = new bootstrap.Modal(document.getElementById('editIndustryModal'));
                                        myModal.show();
                                    }

                                    // Handle modal cleanup
                                    document.getElementById('editIndustryModal').addEventListener('hidden.bs.modal', function () {
                                        document.querySelector('.modal-backdrop').remove();
                                        document.body.classList.remove('modal-open');
                                        document.body.style.overflow = '';
                                        document.body.style.paddingRight = '';
                                    });
                                </script>
