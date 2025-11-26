<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-invoice">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" id="edit_invoice_number" name="invoice_number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select id="edit_type" name="type" class="form-control">
                            <option value="purchase">Purchase</option>
                            <option value="sales">Sales</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ref ID</label>
                        <input type="number" id="edit_ref_id" name="ref_id" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input type="decimal" id="edit_total" name="total" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="edit_status" name="status" class="form-control">
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-invoice">Simpan</button>
            </div>
        </div>
    </div>
</div>