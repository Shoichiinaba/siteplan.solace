<style>
.demo {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    flex-direction: column;
    margin-top: 10px;
    margin-bottom: 2px;
}

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: 0 5px;
    display: grid;
}

.label-select {
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

.label-select2 {
    color: #4B49AC;
    font-size: 8px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 63px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transform: translateY(-25px);
}

.label-select {
    color: #CB0C9F;
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

.label-select2 {
    color: #CB0C9F;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 25px;
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

input,
select,
textarea {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

input:invalid+label,
select:invalid+label,
textarea:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

input:focus,
select:focus,
textarea:focus {
    border-color: #21A8FD;
}

input:focus+label,
select:focus+label,
textarea:focus+label {
    color: #CB0C9F;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.select2-container {
    z-index: 10000
}

.select2-container--default .select2-selection--single {
    height: 40px;
    border: 1px solid #ced4da;
    border-radius: 9px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.flash-animation {
    animation: fadeIn 0.5s ease-in-out;
}
</style>

<div class="panel-table">
    <div class="container-fluid py-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="row mb-2">
                <div class="col-lg-2 col-xxl-2  col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body bg-gradient-info">
                            <i class="ni ni-building" style="color:white;" aria-hidden="true"></i>
                        </span>
                        <select class="form-control" id="fil-unit">
                            <option value=""> &nbsp;Filter Unit</option>
                            <?php foreach ($perumahan as $data) { ?>
                            <option value="<?= $data->id_perum; ?>"> &nbsp;<?= $data->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-xxl-2  col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body bg-gradient-info">
                            <i class="ni ni-satisfied" style="color:white;" aria-hidden="true"></i>
                        </span>
                        <select class="form-control" id="fil-kategori">
                            <option value=""> &nbsp; Filter Kategori</option>
                            <option value="Lead"> &nbsp; Lead</option>
                            <option value="FU"> &nbsp; FU</option>
                            <option value="Minat Survey"> &nbsp; Minat Survey</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-xxl-2  col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body bg-gradient-info">
                            <i class="ni ni-tv-2" style="color:white;" aria-hidden="true"></i>
                        </span>
                        <select class="form-control" id="fil-sumber">
                            <option value=""> &nbsp; Filter Sumber</option>
                            <option value="Media instagram"> &nbsp; Media Instagram</option>
                            <option value="Media facebook"> &nbsp; Media Facebook</option>
                            <option value="Broker"> &nbsp; Broker</option>
                            <option value="Walkin"> &nbsp; Walkin</option>
                            <option value="Event"> &nbsp; Event</option>
                            <option value="Website"> &nbsp; Websita</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-xxl-2 col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body bg-gradient-info"><i class="fa fa-calendar"
                                style="color:white;" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" id="fil-daterange" name="fil_daterange"
                            placeholder=" Pilih Range Tanggal">
                    </div>
                </div>
                <?php if ($userdata->role == 'Admin') : ?>
                <div class="col-lg-2 col-xxl-2  col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body bg-gradient-info">
                            <i class="ni ni-badge" style="color:white;" aria-hidden="true"></i>
                        </span>
                        <select class="form-control" id="fil-marketing">
                            <option value=""> &nbsp;Filter Marketing</option>
                            <?php foreach ($marketing as $data) { ?>
                            <option value="<?= $data->id; ?>"> &nbsp;<?= $data->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-lg-2 col-xxl-2 col-md-3">
                    <a id="cetak" target="_blank" href="<?php echo site_url('Lap_lead'); ?>">
                        <button type="button" class="btn bg-gradient-danger btn-sm">
                            <i class="fa fa-print" style="font-size:small;"></i>
                        </button>
                    </a>
                </div>
                <?php if ($userdata->role == 'Marketing') : ?>
                <div class="col-lg-2 col-xxl-2 col-md-3 text-end">
                    <button type="button" class="btn bg-gradient-info btn-sm rounded-3" data-bs-toggle="modal"
                        data-bs-target="#tambah-data"> <i class="" style="font-size:small;"></i>
                        &nbsp; Input Lead
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <div class="table-responsive p-0">
                <table id="list-lead" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <?php if ($userdata->role == 'Admin') : ?>
                            <th>Marketing</th>
                            <?php endif; ?>
                            <th>nama</th>
                            <th>Tanggal</th>
                            <th>Telepon</th>
                            <th>Unit</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Sumber</th>
                            <th>Hasil FU</th>
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

<!-- Modal simpan-->
<div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Customer Survey</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="input-survey">
                <div class="modal-body">
                    <input type="text" id="id-marketing" class="col-lg-12" value="<?php echo $userdata->id; ?>" required
                        hidden>
                    <div class=" row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="nama" class="col-lg-12" required>
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control" id="tanggal" name="tanggal"
                                    placeholder=" Pilih Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="no-tlp" class="col-lg-12" required>
                                <label class="label-in">Telephon</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Unit</label>
                                <select type="text" id="unit" class="col-lg-12" required>
                                    <option value="">Pilih Unit</option>
                                    <?php foreach ($perumahan as $data) { ?>
                                    <option value="<?= $data->id_perum; ?>"><?= $data->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select">Kategori</label>
                                <select type="text" id="kategori" class="col-lg-12" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Lead">Lead</option>
                                    <option value="FU">FU</option>
                                    <option value="Minat Survey">Minat Survey</option>
                                    <option value="Sudah Survey">Sudah Survey</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <input type="text" id="keterangan" class="col-lg-12">
                                <label class="label-in">Keterangan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Sumber</label>
                                <select type="text" id="sumber" class="col-lg-12">
                                    <option value="">Pilih Sumber</option>
                                    <option value="Media instagram">Media Instagram</option>
                                    <option value="Media facebook">Media Facebook</option>
                                    <option value="Broker">Broker</option>
                                    <option value="Walkin">Walkin</option>
                                    <option value="Event">Event</option>
                                    <option value="Website">Website</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <textarea type="text" id="hasil-fu" class="col-lg-12"></textarea>
                                <label class="label-in">Hasil FU</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-warning btn-sm rounded-3"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary btn-sm rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal simpan-->

<!-- Modal edit-->
<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Survey</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah-survey" action="<?= base_url('Customer/edit_data'); ?>" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="id-marketing" name="id_marketing" class="col-lg-12"
                                    value="<?php echo $userdata->id; ?>" required hidden>
                                <input type="text" id="id" name="id" class="col-lg-12" value="" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="nama" name="nama" class="col-lg-12">
                                <label class="label-in">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control" id="tanggal" name="tanggal"
                                    placeholder=" Pilih Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="no-tlp" name="no_tlp" class="col-lg-12">
                                <label class="label-in">Telephon</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select">Unit</label>
                                <select type="text" id="unit-edit" name="unit" class="col-lg-12">
                                    <option value="">Pilih Unit</option>
                                    <?php foreach ($perumahan as $data) { ?>
                                    <option value="<?= $data->id_perum; ?>"><?= $data->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <label class="label-select">Kategori</label>
                                <select type="text" id="kategoriSelect" name="kategori" class="col-lg-12">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Lead">Lead</option>
                                    <option value="FU">FU</option>
                                    <option value="Minat Survey">Minat Survey</option>
                                    <option value="Sudah Survey">Sudah Survey</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-wrapper">
                                <input type="text" id="keterangan" name="keterangan" class="col-lg-12" required>
                                <label class="label-in">Keterangan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Sumber</label>
                                <select type="text" id="sumber" name="sumber" class="col-lg-12" value="">
                                    <option value="">Pilih Sumber</option>
                                    <option value="Media instagram">Media Instagram</option>
                                    <option value="Media facebook">Media Facebook</option>
                                    <option value="Broker">Broker</option>
                                    <option value="Walkin">Walkin</option>
                                    <option value="Event">Event</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="input-wrapper">
                                <textarea type="text" id="hasil-fu" name="hasil_fu" class="col-lg-12"
                                    value=""></textarea>
                                <label class="label-in">Hasil FU</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2" id="select2-kapling">
                        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                            style="background-image: url('<?= base_url('assets_adm/img/form/beck.jpg'); ?>');">
                            <span class="mask bg-gradient-primary"></span>
                            <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="label-select2">Kapling</label>
                                        <select class="js-example-basic-single w-100" style="width: 100%;" id="code"
                                            name="code" data-dropdown-parent="#edit-data">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-wrapper">
                                            <label class="label-select">Type Unit</label>
                                            <select type="text" id="type_unit" name="type_unit" class="col-lg-12"
                                                value="">
                                                <option value="">Pilih Tipe Unit</option>
                                                <option value="Subsidi">Subsidi</option>
                                                <option value="Komersil">Komersil</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-warning btn-sm rounded-3"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-success btn-sm rounded-3">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Edit-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    var kategoriSelect = document.getElementById('kategoriSelect');
    var select2Kapling = document.getElementById('select2-kapling');

    select2Kapling.style.display = 'none';

    kategoriSelect.addEventListener('change', function() {
        // console.log('Nilai Kategori yang dipilih:', kategoriSelect.value);

        if (kategoriSelect.value === 'UTJ') {
            select2Kapling.style.display = 'block';
            select2Kapling.classList.add('flash-animation');
        } else {
            select2Kapling.classList.remove('flash-animation');
            setTimeout(function() {
                select2Kapling.style.display = 'none';
            }, 1000);
        }
    });
});

$(document).ready(function() {

    var picker;
    var table = $('#list-lead').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Customer/get_customer_lead')?>",
            "type": "POST",
            "data": function(d) {
                d.fil_unit = $('#fil-unit').val();
                d.fil_kategori = $('#fil-kategori').val();
                d.fil_sumber = $('#fil-sumber').val();
                d.fil_marketing = $('#fil-marketing').val();
                d.fil_daterange = $('#fil-daterange').val();
            }
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
    });

    $('#fil-daterange').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            applyLabel: 'Pilih',
            format: 'DD-MM-YYYY',
        }
    });


    $('#fil-daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format(
            'DD-MM-YYYY'));
        // console.log('Nilai select: ' + $(this).val());
        table.ajax.reload();
    });

    $('#fil-daterange').on('cancel.daterangepicker', function(ev, p) {
        $(this).val('');
        picker = null;
        table.ajax.reload();
    });

    $('#fil-kategori, #fil-sumber, #fil-unit, #fil-marketing').on('change', function() {
        // console.log('Nilai select: ' + $(this).val());
        table.ajax.reload();
    });

    // kode untuk print pdf
    $('#cetak').on('click', function() {
        printFilteredData();
    });

    function printFilteredData() {
        var fil_unit = $('#fil-unit').val();
        var fil_kategori = $('#fil-kategori').val();
        var fil_sumber = $('#fil-sumber').val();
        var fil_marketing = $('#fil-marketing').val();
        var fil_daterange = $('#fil-daterange').val();

        var printUrl = "<?=site_url('Lap_lead')?>";
        printUrl += "?fil_unit=" + fil_unit + "&fil_kategori=" + fil_kategori +
            "&fil_sumber=" + fil_sumber + "&fil_marketing=" + fil_marketing +
            "&fil_daterange=" + fil_daterange;

        window.open(printUrl, '_blank');
    }
    // akhir kode untuk print pdf

});

// datepicker
$(function() {
    $('input[name="tanggal"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
            format: 'DD-MM-YYYY'
        }

    });
});
// akhir datepicker

// kode simpan data
$('#input-survey').submit(function(event) {
    event.preventDefault();

    var id_marketing = $('#id-marketing').val();
    var nama = $('#nama').val();
    var tanggal = $('#tanggal').val();
    var no_tlp = $('#no-tlp').val();
    var unit = $('#unit').val();
    var kategori = $('#kategori').val();
    var keterangan = $('#keterangan').val();
    var sumber = $('#sumber').val();
    var hasil_fu = $('#hasil-fu').val();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('Customer/input_lead') ?>',
        data: {
            id_marketing: id_marketing,
            nama: nama,
            tanggal: tanggal,
            no_tlp: no_tlp,
            unit: unit,
            kategori: kategori,
            keterangan: keterangan,
            sumber: sumber,
            hasil_fu: hasil_fu,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                // console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Tagihan Berhasil Dibuat.',
                });

                window.location.href =
                    "<?php echo base_url('Customer/customer_lead'); ?>";
            } else {
                console.error('Terjadi kesalahan saat validasi data di server.');

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim data ke server.',
            });
        }
    });
});
// akhir kode simpan data

$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var tanggal = $(this).data('tanggal');
        var no_tlp = $(this).data('no_tlp');
        var unit = $(this).data('unit');
        var kategori = $(this).data('kategori');
        var keterangan = $(this).data('keterangan');
        var sumber = $(this).data('sumber');
        var hasil_fu = $(this).data('hasil_fu');
        // untuk ke tabel denahs / sitemap
        var code = $(this).data('code');
        var type_unit = $(this).data('type_unit');

        $('#edit-data #id').val(id);
        $('#edit-data #nama').val(nama);
        $('#edit-data #tanggal').val(tanggal);
        $('#edit-data #no-tlp').val(no_tlp);
        $('#edit-data #unit-edit').val(unit);
        $('#edit-data #kategoriSelect').val(kategori);
        $('#edit-data #keterangan').val(keterangan);
        $('#edit-data #sumber').val(sumber);
        $('#edit-data #hasil-fu').val(hasil_fu);
        // untuk ke tabel denahs / sitemap
        $('#edit-data #code').val(code);
        $('#edit-data #type_unit').val(type_unit);
    });


});

$('#ubah-survey').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(response) {
            if (response.status) {
                // Berhasil
                console.log(response);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Survey Berhasil Diubah.',
                });

                window.location.href = "<?php echo base_url('Customer/customer_lead'); ?>";
            } else {
                // Gagal
                console.error(response.message);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message ||
                        'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },

    });
});
</script>