<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-item">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" id="edit_sku" name="sku" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <input type="unit" id="edit_unit" name="unit" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Minimum Stock</label>
                        <input type="min_stock" id="edit_min_stock" name="min_stock" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="price" id="edit_price" name="price" class="form-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-item">Simpan</button>
            </div>
        </div>
    </div>
</div>