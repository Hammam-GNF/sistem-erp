<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-item">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <input type="unit" name="unit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Minimum Stock</label>
                        <input type="min_stock" name="min_stock" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="price" name="price" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="create-item">Simpan</button>
            </div>
        </div>
    </div>
</div>
