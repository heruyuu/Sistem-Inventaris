<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ asset('comodity_locations') }}",
                "type": "get",
            },
            columns: [
                { data: 'DT_RowIndex', sClass: 'text-center', orderable: false, searchable: false },
                { data: 'name', sClass: 'text-center' },
                { data: 'description', sClass: 'text-center' },
                { data: 'created_at', sClass: 'text-center', render: DataTable.render.datetime('D MMMM YYYY') },
                { data: 'act', sClass: 'text-center', orderable: false, searchable: false },
            ],
            order: []
        });
    });

    // Create Data
    $('#data_form').on('submit', function(e) {
        e.preventDefault();
        idata = new FormData($('#data_form')[0]);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ asset('comodity_locations/store') }}",
            data: idata,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                window.location.href = "{{ asset('comodity_locations') }}"
                out_load();
            },
            error: function(error) {
                error_detail(error);
                out_load();
            }
        });
    });

    // Show Edit Data
    function edit_data(id) {
        let token = $("input[name=_token]").val();
        $('#swal-update-button').attr('data-id', id);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ asset('comodity_locations/edit') }}/"+ id,
            data: {
                id: id,
                _token: token
            },
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                $("#name_edit").val(data.data.name);
                $("#description_edit").val(data.data.description);
            },
            error: function(error) {
                error_detail(error);
                out_load();
            }
        });

        // Update Data
        $('#swal-update-button').click(function(e) {
            e.preventDefault();
            let id = $('#swal-update-button').attr('data-id');
            let token = $("input[name=_token]").val();
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: "{{ asset('comodity_locations/update') }}/"+ id,
                data: {
                    _token: token,
                    name: $('#name_edit').val(),
                    description: $('#description_edit').val(),
                },
                cache: false,
                beforeSend: function() {
                    in_load();
                },
                success: function(data) {
                    toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                    window.location.href= "{{ asset('comodity_locations') }}"
                    out_load();
                },
                error: function(error) {
                    error_detail(error);
                    out_load();
                }
            });
        });
    }


    function show_data(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ asset('comodity_locations/show') }}/"+ id,
            data: "_method=SHOW&_token="+tokenCSRF,
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                console.log(data.data);
                $('#modalLabel').val(data.data.name);
                $("#name_show").html(data.data.name);
                $("#description_show").html(data.data.description);
            },
            error: function(error) {
                error_detail(error);
                out_load();
            }
        });
    }

    // Delete Data
    function delete_data(id) {
        swal({
            title: "Konfirmasi Hapus !",
            text: "Apakah anda yakin ingin menghapus Data ?",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: "Ya, Hapus !",
            },
            dangerMode: true
        }).then((deleteFile) => {
            if(deleteFile) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ asset('/comodity_locations/destroy') }}/"+ id,
                    data: "_method=DELETE&_token="+tokenCSRF,
                    beforeSend: function() {
                        in_load();
                    },
                    success: function(data) {
                        toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                        window.location.href= "{{ asset('comodity_locations') }}";
                        out_load();
                    },
                    error: function(error) {
                        error_detail(error);
                        out_load();
                    }
                });
            }
        });
    }
</script>
