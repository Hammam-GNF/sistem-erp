<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-po">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">PO Number</label>
                        <input type="text" name="po_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">PR Number</label>
                        <select name="purchase_request_id" id="purchase_request_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($prs as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->pr_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select">
                            <option value="">-- pilih --</option>
                            @foreach ($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
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
                <button type="submit" class="btn btn-primary" form="create-po">Simpan</button>
            </div>
        </div>
    </div>
</div>
