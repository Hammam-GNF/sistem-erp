<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Stock Movement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-sm">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Item Number</label>
                        <select id="edit_item_id" name="item_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($items as $i)
                                <option value="{{ $i->id }}">{{ $i->sku }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select id="edit_type" name="type" class="form-select">
                            <option value="">-- pilih --</option>
                            <option value="in">In</option>
                            <option value="out">Out</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="qty" id="edit_qty" name="qty" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reference Type</label>
                        <input type="text" id="edit_reference_type" name="reference_type" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reference ID</label>
                        <input type="number" id="edit_reference_id" name="reference_id" class="form-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-sm">Simpan</button>
            </div>
        </div>
    </div>
</div>