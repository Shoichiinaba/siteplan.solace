<script>
    $(document).ready(function() {
        $('#form-add-admin, #select-role').removeAttr('hidden', true).hide();

    });
    load_data_admin();
    $('#btn-add-admin').click(function() {
        add_admin();
    });
    $('#btn-cencel-add-admin').click(function() {
        close_admin();
    });
    $('#btn-seve-admin').click(function() {
        let formData = new FormData();
        formData.append('nama', $('#nama').val());
        formData.append('username', $('#username').val());
        formData.append('password', $('#password').val());
        formData.append('role', $('#role').val());
        formData.append('role-perum', $('#role-perum').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Setting_event/save_admin'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Data berhasil disimpan..')
                load_data_admin();
                close_admin();

            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });


    function load_data_admin() {

        $.ajax({
            // type: 'POST',
            url: "<?php echo site_url('Setting_event/data_admin'); ?>",
            // data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data)
                $('#data-admin').html(data);

            },
            error: function() {
                alert("Data Gagal Diupload 123");
            }
        });
    }

    function add_admin() {
        $('#form-add-admin').show(200);
        $('#btn-add-admin').hide();
    };

    function close_admin() {
        $('#form-add-admin, #select-role').hide();
        $('#btn-add-admin').show(200);
        $('#nama, #username, #password').val('')
    }
</script>