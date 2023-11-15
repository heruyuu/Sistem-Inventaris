<script type="text/javascript">
    $('#thumbnail').change(function(e) {
	    if(typeof FileReader == "undefined") return true;
	    var elem = $(this).attr('name');
	    var files = e.target.files;
        for (var i = 0, f; f = files[i]; i++) {
		    if (f.type.match('image.*')) {
			    var reader = new FileReader();
			    reader.onload = (function(theFile) {
			        return function(e) {
			            var image = e.target.result;
			            $("#view_"+elem).attr("src", image);
			            $("#remove_"+elem).show();
			        };
		        })(f);
		    reader.readAsDataURL(f);
		    }
	    }
    });

    function btn_remove_img(obj) {
	    $("#view_"+obj).attr("src", url_link+"assets/img/placeholder.jpg");
	    $("#"+obj).val("");
	    $("#remove_"+obj).hide();
	    $("#remove_"+obj).attr("onclick","btn_remove_img('"+obj+"')");
    }

    // Set Setting
    $('#data_form').on('submit', function(e) {
        e.preventDefault();
        idata = new FormData($('#data_form')[0]);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ asset('/setStore') }}",
            data: idata,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                toastr.success(''+data.status+'', ''+data.messages+'', 'success');
                window.location.href= "{{ asset('/setting') }}"
                out_load();
            },
            error: function(error) {
                error_detail(error);
                out_load();
            }
        });
    });

    $('.show_modal').click(function() {
        let id = $(this).data('id');
        let token = $('input[name=_token]').val();
        $.ajax({
            type: "GET",
            url: "{{ asset('comodities/show') }}/"+ id,
            data: {
                id: id,
                _token: token
            },
            beforeSend: function() {
                in_load();
            },
            success: function(data) {
                console.log(data);
                $("#modalLabel").html(data.data.item_code);
                $("#item_code_show").val(data.data.item_code);
                $("#comodity_locations_id_show").html(data.data.comodity_locations_id);
                $("#name_show").html(data.data.name);
                $("#brand_show").val(data.data.brand);
                $("#material_show").val(data.data.material);
                $("#date_of_purchase_show").val(data.data.date_of_purchase);
                $("#school_operational_id_show").html(data.data.school_operational_id);
                $("#quantity_show").val(data.data.quantity);
                $("#price_show").val(data.data.price);
                $("#price_per_item_show").val(data.data.price_per_item);
                $("#note_show").html(data.data.note);
            }
        });
    });

    function greeting() {
        let asiaTime = new Date().toLocaleString('en-US', {
            timeZone: 'Asia/Makassar'
        });
        asiaTime = new Date(asiaTime);
        let hours = asiaTime.getHours();
        if(hours <= 10) msg = 'Selamat Pagi !';
        if(hours >= 11) msg = 'Selamat Siang !';
        if(hours >= 16) msg = 'Selamat Sore !';
        if(hours >= 19) msg = 'Selamat Malam !';

        return msg;
    }
</script>
