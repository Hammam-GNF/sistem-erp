<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-supplier">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="address" id="edit_address" name="address" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="phone" id="edit_phone" name="phone" class="form-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-supplier">Simpan</button>
            </div>
        </div>
    </div>
</div>