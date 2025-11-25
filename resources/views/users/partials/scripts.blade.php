<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            "ajax": {
                "url": "{{ route('user.getall') }}",
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
                { "data": "name" },
                { "data": "email" },
                { "data": "role.role_name" },
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
        $('#create-user, #edit-user').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let isEdit = form.attr('id') === 'edit-user';
            let url = isEdit ? `/user/${$('#edit_id').val()}` : "{{ route('user.store') }}";
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
                url: `/user/${id}`,
                type: "GET",
                success: function(res) {
                    if(res.status === 200){
                        var user = res.data;

                        $('#edit_id').val(user.id);
                        $('#edit_name').val(user.name);
                        $('#edit_email').val(user.email);
                        $('#edit_password').val('');
                        $('#edit_password_confirmation').val('');
                        $('#edit_role').val(user.role_id);
                        

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
        //     let formData = new FormData(document.getElementById('edit-user'));

        //     $.ajax({
        //         url: `/user/${id}`,
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
                    url: `/user/${id}`,
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