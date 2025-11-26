<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Sales Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-so">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">SO Number</label>
                        <input type="text" name="so_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">-- pilih --</option>
                            <option value="open">Open</option>
                            <option value="shipped">Shipped</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="create-so">Simpan</button>
            </div>
        </div>
    </div>
</div>
