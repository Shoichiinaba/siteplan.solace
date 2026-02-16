<style>
/* Placeholder for title (name) */
.title-placeholder {
    width: 150px;
    height: 20px;
    margin-bottom: 10px;
}

/* Placeholder for subtitle (position) */
.sub-title-placeholder {
    width: 100px;
    height: 15px;
    margin-bottom: 10px;
}

/* Placeholder for other details (location, contact) */
.details-placeholder {
    width: 120px;
    height: 15px;
    margin-bottom: 10px;
}

/* Placeholder for image (profile picture) */
.image-placeholder {
    width: 105px;
    height: 105px;
    border-radius: 50%;
}

.card-body-custom {
    margin-top: -10px;
}

.badge-small {
    font-size: 9px;
    padding: 5px 4px;
    height: auto;
}

.list {
    font-size: 12px;
}

img {
    filter: drop-shadow(2px 0px 56px);
}

/* css inputan */
.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: 0 0px;
    display: grid;
}

.label-in {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.form-control,
textarea,
select {
    font-size: 12px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

.form-control:invalid+label,
select:invalid+label,
textarea:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

.form-control:focus,
select:focus,
textarea:focus {
    border-color: #1A44B2;
}

.form-control:focus+label,
select:focus+label,
textarea:focus+label {
    color: #2b96f1;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}


/* hover foto keluar tombol */
.card {
    position: relative;
}

.card .hover-buttons {
    display: none;
    position: absolute;
    top: 10px;
    /* Sesuaikan dengan posisi yang diinginkan */
    right: 10px;
    /* Sesuaikan dengan posisi yang diinginkan */
    z-index: 2;
}

.card:hover .hover-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
}

.card .hover-buttons button {
    width: 25px;
    height: 25px;
    font-size: 10px;
    padding: 0px;
}

.action-buttons .btn {
    margin-right: 10px;
}

.action-buttons .btn:last-child {
    margin-right: 0;
}

.listing-label {
    margin-top: 38px;
}

.listing-text {
    font-size: 10px;
    color: #1a44b2;
    font-weight: 500;
}

.alert {
    position: relative;
}

.foto-box {
    position: relative;
    height: 220px;
    /* tinggi tetap */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.foto-preview {
    width: 150px;
    height: 150px;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f4f6f9;
}

.foto-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.btn-ganti {
    margin-top: 10px;
}
</style>

<div class="panel-table">
    <div class="container-fluid py-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table id="list-customer" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>nama</th>
                            <th>Email</th>
                            <th>Domiasili</th>
                            <th>telepon</th>
                            <th>Tanggal</th>
                            <th>Perumahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal lengkapi cus -->
<div class="modal fade" id="edit-customer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lengkapi akun Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="container mt-2" id="form-container">
                    <form id="edit-customer-form" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="id-visit" name="id_visit">
                        <div class="row">
                            <div class="input-wrapper mt-1 col-4">
                                <input type="text" id="nama-customer" name="nama_customer" class="form-control"
                                    required>
                                <label for="nama-customer" class="label-in">Nama Customer</label>
                            </div>
                            <div class="input-wrapper mt-1 col-4">
                                <input type="email" id="email" name="email" class="form-control" required>
                                <label for="edit-email" class="label-in">Email</label>
                            </div>
                            <div class="input-wrapper mt-1 col-4">
                                <input type="number" id="no-tlp" name="no_tlp" class="form-control" required>
                                <label for="no-tlp" class="label-in">Phone</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="input-wrapper col-4">
                                <input type="text" id="username" name="username" class="form-control" required>
                                <label for="username" class="label-in">Username</label>
                            </div>
                            <div class="input-wrapper col-4">
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="password" class="label-in">Password (opsional)</label>
                            </div>
                            <div class="input-wrapper mt-1 col-4">
                                <input type="text" id="domisili" name="domisili" class="form-control" required>
                                <label for="domisili" class="label-in">Domisili</label>
                            </div>
                        </div>
                        <!-- FOTO -->
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="alert alert-primary p-1">

                                    <strong>Upload Foto Profile</strong>

                                    <div class="foto-box mt-0 mb-0">

                                        <div id="profil-preview" class="foto-preview">
                                            <!-- preview muncul di sini -->
                                        </div>

                                        <button type="button" id="change-foto"
                                            class="btn btn-sm btn-primary rounded-3 btn-ganti">
                                            Ganti Profil
                                        </button>

                                        <input type="file" id="upload-profil" name="foto_profil" class="d-none"
                                            accept="image/*">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitCustomer" class="btn btn-primary rounded-3">
                    <span id="loadingIconEdit" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="loadingTextEdit" class="d-none">Menyimpan...</span>
                    <span id="submitTextEdit">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
var table;

table = $('#list-customer').DataTable({
    "paging": true,
    "autoWidth": true,
    "search": true,
    "responsive": true,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('Customer_account/get_customer_account')?>",
        "type": "POST",
    },

    "columnDefs": [{
            "targets": [1, 2, 3, 4],
            "className": 'text-left'
        },
        {
            "targets": [0],
            "className": 'text-center'
        },
        {
            "targets": [1, 3, 4],
            "orderable": false
        },
    ]
})

$(document).ready(function() {
    var baseUrl = "<?= base_url(); ?>";
    // =============================
    // BUKA MODAL EDIT
    // =============================
    $(document).on('click', '.btn-edit', function() {

        const id_customer = $(this).data('id');
        const id_visit = $(this).data('id_visit');
        const nama_customer = $(this).data('nama');
        const email = $(this).data('email');
        const username = $(this).data('username');
        const no_tlp = $(this).data('telepon');
        const domisili = $(this).data('domisili');
        const foto = $(this).data('foto');

        $('#id').val(id_customer);
        $('#id-visit').val(id_visit);
        $('#nama-customer').val(nama_customer);
        $('#email').val(email);
        $('#username').val(username);
        $('#no-tlp').val(no_tlp);
        $('#domisili').val(domisili);
        $('#password').val('');

        // Reset preview
        $('#profil-preview').html('');
        $('#upload-profil').val('');

        if (foto && foto !== '') {

            const fotoPath = baseUrl + "upload/foto_customer/" + foto;

            $('#profil-preview').html(`
                <img src="${fotoPath}">
            `);

        } else {
            // placeholder default
            $('#profil-preview').html(`
                <img src="${baseUrl}assets/img/no-image.png">
            `);
        }

        $('#edit-customer').modal('show');
    });


    // =============================
    // TOMBOL GANTI FOTO
    // =============================
    $('#change-foto').on('click', function() {
        $('#upload-profil').click();
    });


    // =============================
    // PREVIEW FOTO BARU
    // =============================
    $('#upload-profil').on('change', function() {

        if (this.files && this.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {
                $('#profil-preview').html(`
                    <img src="${e.target.result}"
                         class="img-fluid rounded-3 mb-2"
                         style="max-height:150px; object-fit:cover;">
                `);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });


    // =============================
    // SUBMIT AJAX
    // =============================
    $('#submitCustomer').on('click', function() {

        const formData = new FormData($('#edit-customer-form')[0]);

        $.ajax({
            url: "<?= base_url('customer_account/update_customer'); ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            beforeSend: function() {
                $('#loadingIconEdit').removeClass('d-none');
                $('#loadingTextEdit').removeClass('d-none');
                $('#submitTextEdit').addClass('d-none');
            },

            success: function(response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                var modalElement = document.getElementById('edit-customer');
                var modalInstance = bootstrap.Modal.getInstance(modalElement);

                if (modalInstance) {
                    modalInstance.hide();
                }

                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');

                // RELOAD DATATABLE
                $('#list-customer').DataTable().ajax.reload(null, false);
            },

            complete: function() {
                $('#loadingIconEdit').addClass('d-none');
                $('#loadingTextEdit').addClass('d-none');
                $('#submitTextEdit').removeClass('d-none');
            }
        });

    });

});
</script>