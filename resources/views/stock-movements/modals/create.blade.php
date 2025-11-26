<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Stock Movement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-sm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Item Number</label>
                        <select name="item_id" id="item_id" class="form-select" required>
                            <option value="">-- pilih --</option>
                            @foreach ($items as $i)
                                <option value="{{ $i->id }}">{{ $i->sku }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">-- pilih --</option>
                            <option value="in">In</option>
                            <option value="out">Out</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="qty" name="qty" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reference Type</label>
                        <input type="text" name="reference_type" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reference ID</label>
                        <input type="number" name="reference_id" class="form-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="create-sm">Simpan</button>
            </div>
        </div>
    </div>
</div>
