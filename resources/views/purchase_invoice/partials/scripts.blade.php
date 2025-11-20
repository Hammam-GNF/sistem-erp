<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            "ajax": {
                "url": "{{ route('pi.getall') }}",
                "type": "GET",
                "dataType": "json",
                "dataSrc": function(response) {
                    return response.status === 200 ? response.data.map((item, index) => {
                            item.iteration = index + 1;
                            return item;
                        })
                        : [];
                }
            },
            "columns": [
                { "data": "iteration", className: "text-center" },
                { "data": "pi_number" },
                { "data": "purchase_order.po_number" },
                { "data": "supplier.name" },
                { "data": "pi_date" },
                { "data": "due_date" },
                { data: 'total_amount', render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ') },
                { "data": "status" },
                { "data": "notes" },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                            <a href="#" class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                                <i class="bi bi-trash"></i>
                            </a>
                        `;
                    }
                }
            ]
        });
   
        //Handle add form
        // $('#create-pi-form, #edit-pi-form').submit(function(e) {
        //     e.preventDefault();
        //     let form = $(this);
        //     let isEdit = form.attr('id') === 'edit-pi-form';
        //     let url = isEdit ? `/purchase-invoice/${$('#edit_id').val()}` : "{{ route('pi.store') }}";
        //     let method = isEdit ? 'POST' : 'POST';

        //     $.ajax({
        //         url: url,
        //         method: method,
        //         data: new FormData(this),
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         success: function(res) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: isEdit ? 'Berhasil Update!' : 'Berhasil Tambah!',
        //                 text: res.message,
        //                 timer: 1500,
        //                 showConfirmButton: false
        //             });
        //             form[0].reset();
        //             let modalId = isEdit ? '#editModal' : '#createModal';
        //             $(modalId).modal('hide');
        //             $('.modal-backdrop').remove();
        //             $('body').removeClass('modal-open').css('overflow', 'auto');
        //             $('html').css('overflow', 'auto');
        //             table.ajax.reload();
        //         },
        //         error: function(xhr) {
        //             let errors = xhr.responseJSON?.errors;
        //             if(xhr.status === 422 && errors) {
        //                 // bisa diimprove validasi lebih detail kalau perlu
        //                 let msg = Object.values(errors).map(e => e[0]).join('<br>');
        //                 Swal.fire({ icon: 'error', title: 'Error Validasi', html: msg });
        //             } else {
        //                 Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal proses data!' });
        //             }
        //         }
        //     });
        // });
        

        //Handle load edit form
        $('#myTable').on('click', '.edit-btn', function() {
            var id = $(this).data('id');

            $.ajax({
                url: `/purchase-invoice/${id}`,
                type: "GET",
                success: function(res) {
                    if(res.status === 200){
                        var pi = res.data;

                        $('#edit_id').val(pi.id);
                        $('#edit_po_id').val(pi.po_id);
                        $('#edit_supplier_id').val(pi.supplier_id);
                        $('#edit_pi_date').val(pi.pi_date);
                        $('#edit_due_date').val(pi.due_date);
                        $('#edit_total_amount').val(pi.total_amount);
                        $('#edit_notes').val(pi.notes);

                        $('#editModal').modal('show');
                    } else {
                        Swal.fire('Error', 'Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Gagal memuat data', 'error');
                }
            });
        });
        
    });


    // Handle delete button click
    $('#myTable').on('click', '.delete-btn', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus?',
            text: 'Data ini akan hilang permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/purchase-invoice/${id}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },

                    success: function(res) {
                        Swal.fire('Hapus!', res.message, 'success');
                        table.ajax.reload(null, false); // <= aman
                    }
                });
            }
        });
    });


    $(document).ready(function() {

    // Auto-fill supplier berdasarkan PO
    $('#po_id').change(function() {
        let opt = $(this).find(':selected');

        $('#supplier_name').val(opt.data('supplier.name'));
        $('#supplier_id').val(opt.data('supplier_id'));     
    });


    // Add item row
    $('#add-item').click(function() {
        let index = $('.item-row').length;

        let row = `
            <div class="item-row border rounded p-3 mb-3" data-index="${index}">
                <div class="row g-2">
                    <div class="col-md-4">
                        <label>Produk</label>
                        <select name="items[${index}][product_id]" class="form-control product-select" required>
                            <option value="">-- pilih --</option>
                            @foreach ($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Qty</label>
                        <input type="number" name="items[${index}][qty]" class="form-control qty-input" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label>Harga</label>
                        <input type="number" name="items[${index}][price]" class="form-control price-input" min="0" required>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-row w-100">Hapus</button>
                    </div>
                </div>
            </div>
        `;

        $('#item-wrapper').append(row);
    });


    // Remove item row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('.item-row').remove();
        calculateTotal();
    });


    // Auto recalc total setiap qty/price berubah
    $(document).on('input', '.qty-input, .price-input', calculateTotal);

    function calculateTotal() {
        let total = 0;

        $('.item-row').each(function() {
            let qty = parseFloat($(this).find('.qty-input').val()) || 0;
            let price = parseFloat($(this).find('.price-input').val()) || 0;

            total += qty * price;
        });

        $('#total_amount').val(total);
    }

});
    

</script>