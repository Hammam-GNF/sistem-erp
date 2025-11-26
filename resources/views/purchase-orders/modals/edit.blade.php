<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-po">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">PO Number</label>
                        <input type="text" id="edit_po_number" name="po_number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">PR Number</label>
                        <select id="edit_purchase_request_id" name="purchase_request_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($prs as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->pr_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select id="edit_supplier_id" name="supplier_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="edit_status" name="status" class="form-select">
                            <option value="">-- pilih --</option>
                            <option value="open">Open</option>
                            <option value="received">Received</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-po">Simpan</button>
            </div>
        </div>
    </div>
</div>