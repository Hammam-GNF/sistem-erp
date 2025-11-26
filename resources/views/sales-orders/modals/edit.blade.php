<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sales Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-so">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">SO Number</label>
                        <input type="text" id="edit_so_number" name="so_number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select id="edit_customer_id" name="customer_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="edit_status" name="status" class="form-select">
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
                <button type="submit" class="btn btn-primary" form="edit-so">Simpan</button>
            </div>
        </div>
    </div>
</div>