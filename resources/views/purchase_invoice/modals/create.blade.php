<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Purchase Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-pi-form">
                    @csrf
                    <div class="mb-3">
                        <label>Purchase Order</label>
                        <select name="po_id" class="form-control" required>
                            <option value="">-- pilih --</option>
                            @foreach ($pos as $po)
                                <option value="{{ $po->id }}"
                                    data-supplier-name="{{ $po->supplier->name }}"
                                    data-supplier-id="{{ $po->supplier->id }}">
                                    {{ $po->po_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Supplier</label>
                        <input type="text" id="supplier_name" class="form-control" readonly>
                        <input type="hidden" name="supplier_id" id="supplier_id">
                    </div>

                    <hr>

                    <!-- ITEM WRAPPER -->
                    <div id="item-wrapper">
                        <h5>Items</h5>

                        <div class="item-row border rounded p-3 mb-3" data-index="0">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label>Produk</label>
                                    <select name="items[0][product_id]" class="form-control product-select" required>
                                        <option value="">-- pilih --</option>
                                        @foreach ($products as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Qty</label>
                                    <input type="number" name="items[0][qty]" class="form-control qty-input" min="1" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Harga</label>
                                    <input type="number" name="items[0][price]" class="form-control price-input" min="0" required>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-row w-100">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-item" class="btn btn-secondary mb-3">
                        + Tambah Item
                    </button>

                    <hr>

                    <div class="mb-3">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal PI</label>
                        <input type="date" name="pi_date" id="pi_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal jatuh tempo(opsional)</label>
                        <input type="date" name="due_date" id="due_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="create-pi-form">Simpan</button>
            </div>
        </div>
    </div>
</div>
