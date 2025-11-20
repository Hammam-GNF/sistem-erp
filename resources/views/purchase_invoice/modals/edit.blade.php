<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Purchase Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-pi-form">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Purchase Order</label>
                        <select id="edit_po_id" name="po_id" class="form-control">
                            @foreach ($pos as $po)
                                <option value="{{ $po->id }}">{{ $po->po_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select id="edit_supplier_id" name="supplier_id" class="form-control">
                            @foreach ($pos as $po)
                                <option value="{{ $po->supplier->id }}">{{ $po->supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal PI</label>
                        <input type="date" id="edit_pi_date" name="pi_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal jatuh tempo</label>
                        <input type="date" id="edit_due_date" name="due_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input type="number" id="edit_total_amount" name="total_amount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea id="edit_notes" name="notes" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="edit-pi-form">Simpan</button>
            </div>
        </div>
    </div>
</div>