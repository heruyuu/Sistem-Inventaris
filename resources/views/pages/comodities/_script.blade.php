<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "Processing": "Processing...Please wait"
            },
            ajax: {
                type: "GET",
                url: "{{ asset('comodities') }}"
            },
            columns: [
                { data: 'DT_RowIndex', sClass: 'text-center', orderable: false, searchable: false },
                { data: 'item_code', sClass: 'text-center' },
                { data: 'name', sClass: 'text-center' },
                { data: 'date_of_purchase', sClass: 'text-center', render: DataTable.render.datetime('D MMMM YYYY') },
                { data: 'condition', sClass: 'text-center' },
                { data: 'act', sClass: 'text-center', orderable: false, searchable: false }
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
            url: "{{ asset('comodities/store') }}",
            data: idata,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                window.location.href = "{{ asset('comodities') }}"
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
        let token = $('input[name=_token]').val();
        $('#swal-update-button').attr('data-id', id);
        $.ajax({
            type: "GET",
            // dataType: "json",
            url: "{{ asset('comodities/edit') }}/"+ id,
            data: {
                id: id,
                _token: token
            },
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                console.log(data.data);
                $('#item_code_edit').val(data.data.item_code);
                $('#school_operational_id_edit').val(data.data.school_operational_id);
                $('#name_edit').val(data.data.name);
                $('#brand_edit').val(data.data.brand);
                $('#date_of_purchase_edit').val(data.data.date_of_purchase);
                $('#material_edit').val(data.data.material);
                $('#comodity_locations_id_edit').val(data.data.comodity_locations_id);
                $('#condition_edit').val(data.data.condition);
                $('#quantity_edit').val(data.data.quantity);
                $('#price_edit').val(data.data.price);
                $('#price_per_item_edit').val(data.data.price_per_item);
                $('#note_edit').val(data.data.note);
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
            let token = $('input[name=_token]').val();
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: "{{ asset('comodities/update') }}/"+ id,
                data: {
                    _token:token,
                    item_code: $('#item_code_edit').val(),
                    school_operational_id: $('#school_operational_id_edit').val(),
                    name: $('#name_edit').val(),
                    brand: $('#brand_edit').val(),
                    date_of_purchase: $('#date_of_purchase_edit').val(),
                    material: $('#material_edit').val(),
                    comodity_locations_id: $('#comodity_locations_id_edit').val(),
                    condition: $('#condition_edit').val(),
                    quantity: $('#quantity_edit').val(),
                    price: $('#price_edit').val(),
                    price_per_item: $('#price_per_item_edit').val(),
                    note: $('#note_edit').val()
                },
                cache: false,
                beforeSend: function() {
                    in_load();
                },
                success: function(data) {
                    toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                    window.location.href= "{{ asset('comodities') }}"
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
            url: "{{ asset('/comodities/show') }}/"+ id,
            data: "_method=SHOW&_token="+tokenCSRF,
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                console.log(data.data);
                $('#modalLabel').val(data.data.item_code);
                $('#item_code_show').val(data.data.item_code);
                $('#school_operational_id_show').html(data.data.school_operational_id);
                $('#name_show').html(data.data.name);
                $('#brand_show').val(data.data.brand);
                $('#date_of_purchase_show').val(data.data.date_of_purchase);
                $('#material_show').val(data.data.material);
                $('#comodity_locations_id_show').html(data.data.comodity_locations_id);
                $('#condition_show').html(data.data.condition);
                $('#quantity_show').val(data.data.quantity);
                $('#price_show').val(data.data.price);
                $('#price_per_item_show').val(data.data.price_per_item);
                $('#note_show').html(data.data.note);
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
                    url: "{{ asset('comodities/destroy') }}/"+ id,
                    data: "_method=DELETE&_token="+tokenCSRF,
                    beforeSend: function() {
                        in_load();
                    },
                    success: function(data) {
                        toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                        window.location.href= "{{ asset('comodities') }}";
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

    // function load_school_operational(school_operational_id) {
    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: "{{ asset('school_operationals') }}",
    //         beforeSend: function() {
    //             in_load();
    //         },
    //         success: function(data) {
    //             var opt = "<option value=''>:: Pilih ::</option>";
    //             var selected = "";
    //             $.each(data.data, function(key, item) {
    //                 if(school_operational_id) {
    //                     selected = item.id =school_operational_id?"selected":"";
    //                 }
    //                 opt = opt+"<option value='"+item.id+"' "+selected+">"+item.type+"</option>"
    //             });
    //             $("#school_operational_id").html(opt);
    //             out_load();
    //         },
    //         error: function(error) {
    //             error_detail(error);
    //             out_load();
    //         }
    //     });
    // }

    // function load_comodity_location(comodity_locations_id) {
    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: "{{ asset('comodity_locations') }}",
    //         beforeSend: function() {
    //             in_load();
    //         },
    //         success: function(data) {
    //             var opt = "<option value=''>:: Pilih ::</option>";
    //             var selected = "";
    //             $.each(data.data, function(key, item) {
    //                 if(comodity_locations_id) {
    //                     selected = item.id =comodity_locations_id?"selected":"";
    //                 }
    //                 opt = opt+"<option value='"+item.id+"' "+selected+">"+item.type+"</option>"
    //             });
    //             $("#comodity_locations_id").html(opt);
    //             out_load();
    //         },
    //         error: function(error) {
    //             error_detail(error);
    //             out_load();
    //         }
    //     });
    // }
</script>
