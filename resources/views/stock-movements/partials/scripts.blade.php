<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            "ajax": {
                "url": "{{ route('sm.getall') }}",
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
                { "data": "item.sku" },
                { "data": "type" },
                { "data": "qty", "className": "text-center" },
                { "data": "reference_type" },
                { "data": "reference_id" },
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
        $('#create-sm, #edit-sm').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let isEdit = form.attr('id') === 'edit-sm';
            let url = isEdit ? `/stock-movement/${$('#edit_id').val()}` : "{{ route('sm.store') }}";
            let method = isEdit ? 'POST' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: isEdit ? 'Berhasil Update!' : 'Berhasil Tambah!',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    form[0].reset();
                    let modalId = isEdit ? '#editModal' : '#createModal';
                    // $(modalId).modal('hide');
                    // $('.modal-backdrop').remove();
                    // $('body').removeClass('modal-open').css('overflow', 'auto');
                    // $('html').css('overflow', 'auto');
                    $(modalId).modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if(xhr.status === 422 && errors) {
                        // bisa diimprove validasi lebih detail kalau perlu
                        let msg = Object.values(errors).map(e => e[0]).join('<br>');
                        Swal.fire({ icon: 'error', title: 'Error Validasi', html: msg });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal proses data!' });
                    }
                }
            });
        });
        

        //Handle load edit form
        $('#myTable').on('click', '.edit-btn', function() {
            var id = $(this).data('id');

            $.ajax({
                url: `/stock-movement/${id}`,
                type: "GET",
                success: function(res) {
                    if(res.status === 200){
                        var sm = res.data;

                        $('#edit_id').val(sm.id);
                        $('#edit_item_id').val(sm.item_id);
                        $('#edit_type').val(sm.type);
                        $('#edit_qty').val(sm.qty);
                        $('#edit_reference_type').val(sm.reference_type);
                        $('#edit_reference_id').val(sm.reference_id);

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


        //Handle update form
        // $('#btn-update-po').click(function() {
        //     let id = $('#edit_id').val();
        //     let formData = new FormData(document.getElementById('edit-item'));

        //     $.ajax({
        //         url: `/item/${id}`,
        //         type: "POST",
        //         data: formData,
        //         processData: false,
        //         contentType: false,

        //         success: function(res) {
        //             Swal.fire('Updated!', res.message, 'success');
        //             $('#editModal').modal('hide');
        //             table.ajax.reload();
        //         },

        //         error: function() {
        //             Swal.fire('Error', 'Gagal update data!', 'error');
        //         }
        //     });
        // });


        
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
                    url: `/stock-movement/${id}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },

                    success: function(res) {
                        Swal.fire('Berhasil dihapus!', res.message, 'success');
                        table.ajax.reload(null, false); // <= aman
                    }
                });
            }
        });
    });


    

</script>