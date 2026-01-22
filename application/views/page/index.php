<style>
.bg-dur-green {
    background: #5dcf32;
    padding: 1px 4px;
    border-radius: 5px;
    color: white;
}

.bg-dur-orange {
    background: #e0ab0e;
    padding: 1px 4px;
    border-radius: 5px;
    color: white;
}

.bg-dur-red {
    background: #e00e13;
    padding: 1px 4px;
    border-radius: 5px;
    color: white;
}

.bg-dur-sold-out {
    border: dashed 2px red;
    padding: 0px 6px;
    border-radius: 5px;
    font-weight: bold;
    color: #f05151;
}

.bg-tr {
    background: aliceblue;
}

.tr {
    font-size: x-small;
}

.border-transaksi {
    border: 2px solid #0000002e;
    padding: 0px 6px;
    border-radius: 5px;
    font-size: x-small;
    font-weight: bold;
}

.btn-small {
    margin: 2px;
    font-size: smaller;
}

.sorting_1 {
    text-transform: uppercase;
}

.required {
    border: 2px solid #ff000030 !important;
}

#Iframe-Master-CC-and-Rs {
    max-width: 812px;
    max-height: 100%;
    overflow: hidden;
}

/* inner wrapper: make responsive */
.responsive-wrapper {
    position: relative;
    height: 0;
}

.responsive-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    border: none;
}

/* padding-bottom = h/w as % -- sets aspect ratio */
/* YouTube video aspect ratio */
.responsive-wrapper-wxh-572x612 {
    padding-bottom: 107%;
}

/* general styles */
/* ============== */
.set-border {
    border: 5px inset #ddd;
}

.set-box-shadow {
    -webkit-box-shadow: 4px 4px 14px #4f4f4f;
    -moz-box-shadow: 4px 4px 14px #4f4f4f;
    box-shadow: 4px 4px 14px #4f4f4f;
}

.set-padding {
    padding: 10px;
}

.set-margin {
    margin: 30px;
}

.center-block-horiz {
    margin-left: auto !important;
    margin-right: auto !important;
}

sup {
    top: -0.5em;
    color: red;
}

[readonly] {
    background: #a9a9a936;
}
</style>
<div class="container">
    <div id="svg-container">
    </div>
    <div class="card-body p-1">
        <div class="row">
            <div class="col-xl-9 col-md-6 mb-xl-0">
                <div id="data-siteplan" class="card card-blog card-plain">
                    <?php
                    foreach ($siteplan as $data) :
                    ?>
                    <?php echo $data->file_siteplan; ?>
                    <input id="id-siteplan" type="text" value="<?= $data->id_siteplan; ?>" hidden>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <!-- Panel Control -->
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card h-100 card-plain border">
                    <div id="example2" class="controls">
                        <div class="controls-pan">
                            <p><button type="button" class="btn btn-success fa fa-arrow-up"></button></p>
                            <p>
                                <button type="button" class="btn btn-success fa fa-arrow-left"></button>
                                <button type="button" class="btn btn-success fa fa-arrow-right"></button>
                            </p>
                            <p><button type="button" class="btn btn-success fa fa-arrow-down"></button></p>
                        </div>

                        <div class="controls-zoom">
                            <p><button type="button" class="btn btn-warning fa fa-refresh"></button></p>
                            <p><button type="button" class="btn btn-danger fa fa-plus"></button></p>
                            <p><button type="button" class="btn btn-danger fa fa-minus"></button></p>
                        </div>

                        <div class="controls-keterangan">
                            <p><span class="badge bg-gradient-danger">Dipesan</span></p>
                            <p><span class="badge bg-warning text-dark">Sold Out</span></p>
                            <p><span class="badge bg-gradient-info">Rumah Ready</span></p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- akhir panel control -->
        </div>
    </div>
</div>
<!-- akhir Tampilan map -->
<!-- Table data -->
<div class="panel-table">
    <div class="container-fluid py-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="row mb-2">
                    <div class="col-lg-3 col-xxl-2  col-md-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text text-body">
                                <i class="ni ni-building" aria-hidden="true"></i>
                            </span>
                            <select class="form-control" id="fil-type-unit">
                                <option value=""> &nbsp; Filter Type Unit</option>
                                <?php
                                foreach ($type_unit as $data) :

                                ?>
                                <option value="<?= $data->type_unit; ?>"> &nbsp; <?= $data->type_unit; ?></option>

                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-2  col-md-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text text-body">
                                <i class="ni ni-money-coins" aria-hidden="true"></i>
                            </span>
                            <select class="form-control" id="fil-payout">
                                <option value=""> &nbsp; Filter Payout</option>
                                <option value="cash"> &nbsp; Cash</option>
                                <option value="kpr"> &nbsp; KPR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-2  col-md-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text text-body">
                                <i class="ni ni-check-bold" aria-hidden="true"></i>
                            </span>
                            <select class="form-control" id="status">
                                <option value=""> &nbsp; Filter Status</option>
                                <option value="Dipesan"> &nbsp; Dipesan</option>
                                <option value="UTJ"> &nbsp; UTJ</option>
                                <option value="DP"> &nbsp; DP</option>
                                <option value="Sold Out"> &nbsp; Sold Out</option>
                                <option value="Rumah Ready"> &nbsp; Rumah Ready</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-2 col-md-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text text-body"><i class="fa fa-calendar"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" id="filter-tgl" name="daterange"
                                placeholder=" Pilih Range Tanggal">
                            <input type="text" id="tgl-start" value="" hidden>
                            <input type="text" id="tgl-end" value="" hidden>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <a id="cetak-pdf">
                            <button type="button" class="btn bg-gradient-success btn-sm"> <i class="fa fa-print"
                                    style="font-size:small;"></i>
                                &nbsp; Cetak
                            </button>
                        </a>
                    </div>
                </div>
                <table id="list-selatan" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Kode unit</th>
                            <th>Type Unit</th>
                            <th>Status</th>
                            <th>Payout</th>
                            <th>Transaction</th>
                            <th>Description</th>
                            <th>Progress doc</th>
                            <th>Duration</th>
                            <th>Action</th>
                            <th>Tgl Update</th>
                            <th>Admin</th>
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
<input type="text" id="code-arr" value="" hidden>
<input type="text" id="progres-berkas" value="" hidden>
<!-- Modal Edit-->
<div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Denah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form-edit-denah">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Kapling</label>
                                <input type="text" class="form-control form-control-sm" id="code" name="code" readonly>
                                <input type="text" id="id-denahs-edit" value="" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="type-unit" class="form-label">Type Unit</label>
                            <select class="form-control form-control-sm" id="type-unit" name="type_unit">
                                <option value="">Pilih type unit</option>
                                <option value="Subsidi">Subsidi</option>
                                <option value="Komersil">Komersil</option>
                            </select>
                            <div class="readonly-select-type-unit"></div>
                        </div>
                        <div class="col-lg-6">
                            <label for="type" class="form-label">Status</label>
                            <select class="form-control form-control-sm" id="type" name="type">
                                <option value="Dipesan">Dipesan</option>
                                <option value="Sold Out">Sold Out</option>
                                <option value="Rumah Ready">Rumah Ready</option>
                                <option value="Kosong">Kosongkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="nama-cus" class="form-label">Nama</label>
                            <div class="form-group mb-1">
                                <input type="text" class="form-control form-control-sm" id="nama-cus" name="nama-cus">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="no-wa" class="form-label">Whatsap</label>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <a class="chat-wa" target="_blank">
                                        <span class="input-group-text"><i class="fa fa-whatsapp"></i></span>
                                    </a>
                                    <input class="form-control form-control-sm" placeholder="" type="number" id="no-wa"
                                        name="no-wa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="status-trans" class="form-label">Transaksi</label>
                            <select class="form-control form-control-sm" id="status-trans" name="status-trans">
                                <option value="">Pilih transaksi</option>
                                <option value="UTJ">UTJ</option>
                                <option value="DP">DP</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="tgl-trans" class="form-label">Tanggal</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text text-body"><i class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control" id="tgl-trans" name="tgl-trans"
                                    placeholder=" Pilih Range Tanggal">
                            </div>
                        </div>
                        <div id="in-nominal-dp" class="col-lg-3" hidden>
                            <label for="nominal-dp" id="label-nominal-dp" class="form-label">Harga Unit</label>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    <input class="form-control form-control-sm" placeholder="" type="text"
                                        id="nominal-dp" name="nominal-dp">
                                </div>
                            </div>
                        </div>
                        <!-- Sembunyikan input Nominal Dibayar -->
                        <div class="col-lg-3" id="in-nominal-dibayar" hidden>
                            <label for="nominal" class="form-label">Nominal Dibayar</label>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    <input class="form-control form-control-sm" type="number" id="nominal"
                                        name="nominal">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="btn-form-trans" class="row">
                        <div class="col-6">
                            <button type="button" id="btn-batal-trans" class="btn btn-small ">Batal</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="btn-simpan-trans" class="btn btn-success btn-sm"
                                style="float: right;">Simpan transaksi</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <table class="table align-items-center mb-0" style="overflow: auto;display: block;">
                            <thead>
                                <tr class="tr bg-tr">
                                    <th>TRANSAKSI</th>
                                    <th>TANGGAL</th>
                                    <th>TAHAP</th>
                                    <th>NOMINAL</th>
                                    <th>ACTION</th>
                                    <th>TGL UPDATE</th>
                                    <th>ADMIN</th>
                                </tr>
                            </thead>
                            <tbody id="data-transaksi">

                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save-change-denah">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Attech-->
<div class="modal fade" id="exampleModalatt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Document</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id-denahs" value="" hidden>
                <div class="row mb-2">
                    <div class="col-lg-3 mb-1">
                        <input type="text" class="form-control form-control-sm" id="doc-type-unit" readonly>
                    </div>
                    <div class="col-12">
                        <select id="select-pembayaran" class="form-control form-control-sm">
                            <option value="">Pilih Status Pembayaran</option>
                            <option value="cash">CASH</option>
                            <option value="kpr">KPR</option>
                        </select>
                        <div class="readonly-select-pembayaran"></div>
                    </div>
                </div>
                <div id="form-document" class="row" hidden>
                    <div class="col-6">
                        <select id="select-document" class="form-control form-control-sm">
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group ">
                            <input type="file" id="file-document" class="form-control form-control-sm"
                                placeholder="Recipient's username" value="">
                        </div>
                        <span style="font-family: 'NucleoIcons';font-size: smaller;"> <sup>*</sup> PDF Only, Max
                            2mb</span>
                    </div>
                </div>
                <div id="add-document" class="row">
                    <div class="col">
                        <button type="button" id="btn-add-document" class="btn bg-gradient-default btn-sm col-12">Upload
                            document</button>
                    </div>
                </div>
                <div id="action-upload" class="row" hidden>
                    <div class="col-6">
                        <a href="javascript:;" id="btn-cencel-document" class="btn btn-danger btn-lg btn-sm"
                            role="button" aria-pressed="true">Cencel</a>
                    </div>
                    <div class="col-6 ">
                        <a href="javascript:;" id="btn-save-document" class="btn btn-success btn-lg btn-sm"
                            role="button" aria-pressed="true" style="float: right;">Save document</a>
                    </div>
                </div>
                <hr class="mt-0" style="border-top: solid #00000040 !important;">
                <table class="table align-items-center mb-0" style="overflow: auto;display: block;">
                    <thead>
                        <tr class="tr bg-tr">
                            <th>DOCUMENT</th>
                            <th>TGL UPDATE</th>
                            <th>ADMIN</th>
                        </tr>
                    </thead>
                    <tbody id="data-document">
                    </tbody>
                </table>
                <div id="" class="row"></div>
                <input type="text" id="flied" value="" hidden>
                <input type="text" id="file-doc" value="" hidden>
                <input type="text" id="id-upload" value="" hidden>
                <div id="preview-pdf" class="row" hidden>
                    <div class="col-12">
                        <hr style="border-top: solid #00000040 !important;">
                        <button type="button" id="btn-close-preview" class="btn-sm btn btn-default"
                            style="float: right;">Close</button>
                        <button type="button" id="btn-delete-doc" class="btn-sm btn btn-danger mr-3"
                            style="float: right;margin-right: 25px;">DELETE</button>
                        <a id="link-down-pdf" href="" download="">
                            <button type="button" class="btn-sm btn btn-info mr-3"
                                style="float: right;margin-right: 25px;">Download</button>
                        </a>
                    </div>
                    <div id="Iframe-Master-CC-and-Rs" class="set-padding set-border set-box-shadow center-block-horiz">
                        <div class="responsive-wrapper responsive-wrapper-wxh-572x612"
                            style="-webkit-overflow-scrolling: touch; overflow: auto;">
                            <iframe id="view-pdf" src="">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#cetak-pdf').click(function() {
    var val_type_unit = $('#fil-type-unit').val();
    var val_payout = $('#fil-payout').val();
    var val_status = $('#status').val();
    var data_arr = $('#code-arr').val();
    if (val_type_unit == '') {
        var type_unit = 'Komersil, Subsidi';
    } else {
        // var data_fil =
        var type_unit = val_type_unit;

    }
    if (val_payout == '') {
        var payout = 'CASH, KPR';
    } else {
        if (payout == 'cash') {
            var payout = 'CASH';

        } else {
            var payout = 'KPR';

        }

    }
    if (val_status == '') {
        var status = '';
    } else {
        var status = '-' + val_status;

    }
    // $data_arr = [type_unit, payout, status]
    // alert(data_arr)
    // $('#code-arr').val(type_unit + payout + status)
    $.ajax({
        // type: 'POST',
        url: "<?php echo base_url('/Home/get_data_pdf'); ?>/" + $('#id-siteplan').val() +
            "?map=" + $('#id-siteplan').val() + "&fil_type_unit=" + $('#fil-type-unit').val() +
            "&fil_payout=" + $('#fil-payout').val() + "&status=" + $('#status').val() + "&tgl_start=" +
            $('#tgl-start').val() + "&tgl_end=" + $('#tgl-end').val(),
        // data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            // load_data_document();\
            // alert(data)

            window.location.href =
                "<?= base_url('Laporan_pdf'); ?>/data/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/" +
                data + '/?type=' + type_unit + '&payout=' + payout;
            // Laporan_pdf/data/6/A1-A10-A12-/

        },
        error: function() {
            alert("Data Gagal Diupload");
        }
    });
});

var select_subsidi = '<option value="0">Pilih status pembayaran</option>' +
    '<option value="cash">Cash</option>' +
    '<option value="kpr-sub">KPR</option>';

var select_komersil = '<option value="0">Pilih status pembayaran</option>' +
    '<option value="cash">Cash</option>' +
    '<option value="kpr-kom">KPR</option>';

var html_cash = '<option value="0">Pilih Document</option>' +
    '<option value="ktp">KTP</option>' +
    '<option value="kk">kk</option>' +
    '<option value="npwp">NPWP</option>' +
    '<option value="buku_nikah">Buku Nikah</option>';

var html_kpr_subsidi = '<option value="0">Pilih Document</option>' +
    '<option value="ktp">KTP</option>' +
    '<option value="kk">kk</option>' +
    '<option value="npwp">NPWP</option>' +
    '<option value="buku_nikah">Buku Nikah</option>' +
    '<option value="skk">Surat keterangan kerja</option>' +
    '<option value="slip_g">Slip gaji 3 bulan terakhir</option>' +
    '<option value="rek_koran">Rekening koran 3 bulan terakhir</option>' +
    '<option value="pas_foto">Pas Foto</option>' +
    '<option value="spt">SPT</option>' +
    '<option value="blanko">Blanko</option>' +
    '<option value="doc1">Surat Pernyataan permohonan KPR</option>' +
    '<option value="doc2">Surat Pernyataan penghuni rumah umum bersubsidi</option>' +
    '<option value="doc3">Surat kuasa pendebetan dana</option>' +
    '<option value="doc4">Surat permohonan subsidi</option>' +
    '<option value="doc5">Surat pengakuan kekurangan bayar KPR</option>' +
    '<option value="doc6">Surat perintah pemindah bukuan dana SBUM</option>';

var html_kpr_komersil = '<option value="0">Pilih Document</option>' +
    '<option value="ktp">KTP</option>' +
    '<option value="kk">kk</option>' +
    '<option value="npwp">NPWP</option>' +
    '<option value="buku_nikah">Buku Nikah</option>' +
    '<option value="skk">Surat keterangan kerja</option>' +
    '<option value="slip_g">Slip gaji 3 bulan terakhir</option>' +
    '<option value="rek_koran">Rekening koran 3 bulan terakhir</option>' +
    '<option value="pas_foto">Pas Foto</option>' +
    '<option value="spt">SPT</option>' +
    '<option value="blanko">Blanko</option>';
load_data_kapling();
filter_tgl();
$(document).ready(function() {
    $('.btn-modal-document').click(function() {
        cencel_upload_document();
        var id_denahs = $('#id-denahs').val();
        $("#select-pembayaran").removeAttr("readonly", true)

        if ($("#select-pembayaran").val() == 'cash') {
            $('#select-document').html(html_cash);
        } else if ($("#select-pembayaran").val() == 'kpr-sub') {
            $('#select-document').html(html_kpr_subsidi);
        } else if ($("#select-pembayaran").val() == 'kpr-kom') {
            $('#select-document').html(html_kpr_komersil);
        } else {
            $('#select-document').html('');

        }
        load_data_document();
    });

    $('#select-pembayaran').change(function(e) {
        // alert($(this).val())
        var id_denahs = $('#id-denahs').val();
        if ($(this).val() == 'cash') {
            $('#select-document').html(html_cash);
            $('#btn-document-' + id_denahs).val('cash');
        } else if ($(this).val() == 'kpr-sub') {
            $('#select-document').html(html_kpr_subsidi);
            $('#btn-document-' + id_denahs).val('kpr-sub');
        } else if ($(this).val() == 'kpr-kom') {
            $('#select-document').html(html_kpr_komersil);
            $('#btn-document-' + id_denahs).val('kpr-kom');
        } else {
            $('#btn-document-' + id_denahs).val('');
            $('#select-document').html('');

        }
        let formData = new FormData();
        formData.append('id-denahs', $('#id-denahs').val());
        formData.append('status-pembayaran', $('#select-pembayaran').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Home/update_status_pembayaran'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                load_data_document();
                window.crud.ajax.reload(null, false);

            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });

    // load data saat pertama di buka
    $('#status, #fil-type-unit, #fil-payout').on('change', function() {

        if ($('#fil-type-unit').val() == 'Komersil') {
            if ($('#fil-payout').val() == 'kpr') {
                var payout = 'kpr-kom';
            } else {

                var payout = $('#fil-payout').val();
            }
        } else if ($('#fil-type-unit').val() == 'Subsidi') {
            if ($('#fil-payout').val() == 'kpr') {
                var payout = 'kpr-sub';
            } else {
                var payout = $('#fil-payout').val();
            }

        }
        window.crud.ajax.url("<?php echo base_url('/Home/search'); ?>/" + $('#id-siteplan').val() +
            "?fil_type_unit=" + $('#fil-type-unit').val() + "&fil_payout=" + $('#fil-payout')
            .val() + "&status=" + $('#status').val() + "&tgl_start=" + $('#tgl-start').val() +
            "&tgl_end=" + $('#tgl-end').val() + "&pdf=false").load();
        var tgl_start = $('#tgl-start').val();
        var tgl_end = $('#tgl-end').val();
        var strStart = tgl_start.replace(/\//g, '-');
        var strEnd = tgl_end.replace(/\//g, '-');

    });
});

window.UTJsudahAda = false; // false = belum ada UTJ, true = sudah ada UTJ
window.nominalUTJ = 2000000;

function formatRupiah(angka) {
    if (!angka || isNaN(angka)) return "Rp. 0";
    return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateDPfield() {
    if (typeof window.nominalDP !== "undefined") {
        $("#in-nominal-dp").removeAttr("hidden");

        if (window.totalDPdibayar == 0) {
            // Belum ada DP
            $('#label-nominal-dp').text('Harga Unit');
            $('#nominal-dp').val('').prop('readonly', false).attr('type', 'number');

            // Tampilkan input Nominal Dibayar, isi default = Nominal DP
            $("#in-nominal-dibayar").removeAttr("hidden").show();
            $("#nominal").val(window.nominalDP).prop("readonly", false).removeAttr("disabled");

        } else if (window.sisaDP > 0) {
            // Masih ada kekurangan DP
            $('#label-nominal-dp').text('Kekurangan DP');
            $('#nominal-dp').val(formatRupiah(window.sisaDP)).prop('readonly', true).attr('type', 'text');

            // Tampilkan input Nominal Dibayar, isi default = Sisa DP
            $("#in-nominal-dibayar").removeAttr("hidden").show();
            $("#nominal").val(window.sisaDP).prop("readonly", false).removeAttr("disabled");

        } else {
            // DP sudah lunas
            $('#label-nominal-dp').text('DP Lunas');
            $('#nominal-dp').val('').prop('readonly', true).attr('type', 'text');
            $("#in-nominal-dp").attr("hidden", true);

            // Sembunyikan input nominal dibayar
            $("#in-nominal-dibayar").attr("hidden", true);
            $("#nominal").val("").prop("readonly", true).attr("disabled", true);
        }
    }
}

$(document).ready(function() {
    // Default state saat modal dibuka
    $('#btn-form-trans').hide(); // tombol disembunyikan
    $('#tgl-trans, #nominal').attr('disabled', true); // input disable

    updateDPfield();

    // Event perubahan dropdown transaksi
    $('#status-trans').change(function() {
        let val = $(this).val();

        if (val === 'DP') {
            // Kalau pilih DP
            $('#in-nominal-dp').removeAttr('hidden').show();
            $('#in-nominal-dibayar').removeAttr('hidden').show(); // <<< tambahkan ini
            updateDPfield(); // otomatis hitung DP

        } else if (val === 'UTJ') {
            // Kalau pilih UTJ
            $("#in-nominal-dibayar").removeAttr("hidden").show();

            if (window.UTJsudahAda) {
                // Kalau UTJ sudah ada → readonly + disabled
                $("#nominal")
                    .val(window.nominalUTJ || '')
                    .prop("readonly", true)
                    .attr("disabled", true);
            } else {
                // Kalau UTJ belum ada → bisa input
                $("#nominal")
                    .val("")
                    .prop("readonly", false)
                    .removeAttr("disabled");
            }

            $('#in-nominal-dp').hide();

        } else {
            // Kalau kembali pilih "Pilih transaksi"
            $('#nominal').val('').attr("disabled", true);
            $('#in-nominal-dp').hide();
            $('#in-nominal-dibayar').hide();
        }

        if (val === '') {
            // jika pilih "Pilih transaksi"
            $('#tgl-trans, #nominal').attr('disabled', true);
            $('#btn-form-trans').hide(300);
            $('#btn-simpan-trans').val('');
            $('#save-change-denah').attr("data-bs-dismiss", "modal");
        } else {
            // jika pilih UTJ / DP
            $('#tgl-trans').removeAttr('disabled');
            $('#btn-form-trans').show(300);
            $('#save-change-denah').removeAttr("data-bs-dismiss");
            $('#btn-simpan-trans').val('action');
        }
    });


});

$('#btn-simpan-trans').click(function() {
    let formData = new FormData();
    formData.append('id-trans-denahs', $('#id-denahs-edit').val());
    formData.append('nama-cus', $('#nama-cus').val());
    formData.append('no-wa', $('#no-wa').val());
    formData.append('status-trans', $('#status-trans').val());
    formData.append('tgl-trans', $('#tgl-trans').val());
    formData.append('nominal', $('#nominal').val());
    formData.append('nominal-dp', $('#nominal-dp').val());
    $.ajax({
        type: 'POST',
        url: "<?php echo site_url('Home/upload_transaksi') ?>",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            load_data_transaksi();
            $('#tgl-trans, #nominal').attr('disabled', true);
            $('#btn-form-trans').hide(300);
            $('#status-trans, #nominal').val('').change();
            $('#save-change-denah').attr("data-bs-dismiss", "modal");
            alert('Transaksi berhasil di upload..');
        },
        error: function() {
            alert("Data Gagal Diupload");
        }
    });
});
$('#btn-batal-trans').click(function() {
    $('#tgl-trans, #nominal').attr('disabled', true);
    $('#btn-form-trans').hide(300);
    $('#status-trans').val('').change()
});

$('#btn-save-document').click(function() {
    // cencel_upload_document();
    $(this).addClass('active');

    if ($('#file-document').val() == '' || $('#select-document').val() == '0') {
        if ($('#select-document').val() == '0') {
            $('#select-document').addClass('required');
            $(this).removeClass('active');
        } else {
            $('#select-document').removeClass('required');
        }

        if ($('#file-document').val() == '') {
            $('#file-document').addClass('required');
            $(this).removeClass('active');
        } else {
            $('#file-document').removeClass('required');
        }

    } else {
        upload_document();
    }

});
$('#btn-cencel-document').click(function() {
    cencel_upload_document();
    $(this).addClass('active');
});
$('#btn-close-preview').click(function() {
    close_preview_pdf();
});
$('#btn-delete-doc').click(function() {
    alert($('#id-upload').val() + $('#flied').val() + $('#file-doc').val());
    var confirmalert = confirm("Apakah anda yakin untuk menghapus document ini ?");

    if (confirmalert == true) {

        let formData = new FormData();
        formData.append('id-upload', $('#id-upload').val());
        formData.append('flied', $('#flied').val());
        formData.append('file-doc', $('#file-doc').val());
        formData.append('select-pembayaran', $('#select-pembayaran').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Home/delete_document') ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Documen berhasil di hapus..');
                load_data_document();
                $('#progres-' + $('#id-denahs').val()).html(data);
                close_preview_pdf();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
});

function add_document() {
    $('#form-document, #action-upload').removeAttr('hidden', true);
    $('#add-document').attr('hidden', true);
    $('#file-document').val('');

}

function cencel_upload_document() {
    $('#form-document, #action-upload').attr('hidden', true);
    $('#add-document').removeAttr('hidden', true);
    $('#file-document').val('');
    $('#select-document').val('0');

}

function close_preview_pdf() {
    $("#link-down-pdf").attr("href", "");
    $("#link-down-pdf").attr("download", "");
    $("#preview-pdf").attr("hidden", true);
    $("#flied").val('');
    $("#file-doc").val('');
}

function upload_document() {
    var confirmalert = confirm("Apakah anda yakin untuk upload document ini ?");
    if (confirmalert == true) {
        const file_document = $('#file-document').prop('files')[0];

        let formData = new FormData();
        formData.append('id-doc-kapling', $('#id-denahs').val());
        formData.append('select-pembayaran', $('#select-pembayaran').val());
        formData.append('select-document', $('#select-document').val());
        formData.append('file-document', file_document);
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Home/upload_document') ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Documen berhasil di upload...');
                load_data_document();
                $('#file-document').val('');
                $('#select-document').val('0');
                $('#progres-' + $('#id-denahs').val()).html(data);
                // alert(data)


            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
};

function load_data_document() {
    let formData = new FormData();
    formData.append('status-pembayaran', $('#select-pembayaran').val());
    formData.append('id-doc-kapling', $('#id-denahs').val());
    $.ajax({
        type: 'POST',
        url: "<?php echo site_url('Home/select_data_document'); ?>",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#data-document').html(data);

        },
        error: function() {
            alert("Data Gagal Diupload 123");
        }
    });
}

$('#type').change(function() {
    if ($(this).val() == 'Dipesan') {
        $('#nama-cus, #no-wa, #status-trans').removeAttr('disabled', true)
        $('.btn-delete-transaksi').show();
    } else if ($(this).val() == 'Sold Out') {
        $('#nama-cus, #no-wa, #status-trans, #nominal').attr('disabled', true)
        $('#tgl-trans').removeAttr('disabled', true);
        $('.btn-delete-transaksi').hide();
    } else {
        $('#nama-cus, #no-wa, #status-trans, #tgl-trans, #nominal').attr('disabled', true)
    }
    // alert($(this).val());
});
$('#type-unit').change(function() {
    if ($(this).val() == '') {
        $('#save-change-denah').removeAttr("data-bs-dismiss", true);
        $('#type-unit').addClass('required');
    } else {
        $('#save-change-denah').attr("data-bs-dismiss", "modal");
        $('#type-unit').removeClass('required');
    }
});

$('#save-change-denah').click(function() {
    if ($('#form-edit-denah #type-unit').val() == '') {
        $('#type-unit').addClass('required');

    } else {
        if ($('#type').val() == 'Rumah Ready') {

            if ($('#progres-berkas').val() == '0') {
                $(this).html('Loading...');
                $(this).attr('disabled', true);
                save_change_denah();
            } else {
                alert('Silahkan kosongkan data unit terlebih dahulu !');
            }
        } else if ($('#type').val() == 'Dipesan') {

            if ($('#btn-simpan-trans').val() == 'action') {
                alert('Silahkan simpan data transaksi terlebih dahulu !');
            } else {
                $(this).html('Loading...');
                $(this).attr('disabled', true);
                save_change_denah();
            }
        } else {
            // $('#type-unit').remmoveClass('required');
            $(this).html('Loading...');
            $(this).attr('disabled', true);
            save_change_denah();

        }
    }
});

function save_change_denah() {
    var id, code, type_unit, type, description;
    id = $('#form-edit-denah #id-denahs-edit').val();
    code = $('#form-edit-denah #code').val();
    type_unit = $('#form-edit-denah #type-unit').val();
    type = $('#form-edit-denah #type').val();
    description = $('#form-edit-denah #description').val();
    nama_cus = $('#form-edit-denah #nama-cus').val();
    no_wa = $('#form-edit-denah #no-wa').val();
    tgl_trans = $('#form-edit-denah #tgl-trans').val();
    // if($('#form-edit-denah #type').val()=='Dipesan'){
    // }
    $.ajax({
        url: "<?php echo base_url('Home/change_denah') ?>",
        data: {
            id: id,
            code: code,
            type_unit: type_unit,
            type: type,
            desc: description,
            nama_cus: nama_cus,
            no_wa: no_wa,
            tgl_trans: tgl_trans,
        },
        type: 'post',
        success: function(data) {
            $('#save-change-denah').html('Save changes');
            $('#save-change-denah').attr('disabled', false);
            $(`#${data.results.code}`).css('fill', data.results.color);
            window.crud.ajax.reload(null, false);
            const modal = bootstrap.Modal.getInstance($('#exampleModaledit'));
            modal.hide();

        }
    });
}


function load_data_kapling() {
    if ($.fn.DataTable.isDataTable('#list-selatan')) {

        $('#list-selatan').DataTable().destroy();
    }
    window.crud = $('#list-selatan').DataTable({
        "paging": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": true,
        processing: true,
        serverSide: true,
        ajax: "<?php echo base_url('/Home/search'); ?>/" + $('#id-siteplan').val(),
        columns: [{
                data: 'code',
                name: 'code'
            },
            {
                data: 'type_unit',
                name: 'type_unit'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'status_pembayaran',
                name: 'status_pembayaran'
            },
            {
                data: 'transaction',
                name: 'transaction'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'color',
                name: 'color'
            },
            {
                data: 'duration',
                name: 'duration'
            },
            {
                data: 'action',
                name: 'action'
            },
            {
                data: 'tgl_update',
                name: 'tgl_update'
            },
            {
                data: 'user_admin',
                name: 'user_admin'
            }
        ],
    });

}

function openDataRow(id, type_unit, code, type, desc, progres_berkas) {
    $('#form-edit-denah #id-denahs-edit').val(id).change();
    $('#form-edit-denah #code').val(code).change();
    $('#form-edit-denah #description').val(desc).change();
    $('#form-edit-denah #type').val(type).change();
    $('#form-edit-denah #type-unit').val(type_unit).change();
    if (progres_berkas == '0') {

        $('#form-edit-denah #type-unit').removeAttr("disabled", 'disabled');
        $('.readonly-select-type-unit').html('')
    } else {
        $('#form-edit-denah #type-unit').prop('disabled', true);
        $('.readonly-select-type-unit').html(
            '<span style="font-family: NucleoIcons;font-size: smaller;"> <sup>*</sup> Kosongkan data unit jika ingin merubahnya !</span>'
        )
    }
    $('#progres-berkas').val(progres_berkas);
    load_data_transaksi();
}

function load_data_transaksi() {
    let formData = new FormData();
    formData.append('id-trans-denahs', $('#id-denahs-edit').val());
    $.ajax({
        type: 'POST',
        url: "<?php echo site_url('Home/load_data_transaksi'); ?>",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#data-transaksi').html(data);
        },
        error: function() {
            alert("Data Gagal Diupload 123");
        }
    });
};

function getDataDoc(id_denahs, type_unit, status_pembayaran, progres_berkas) {
    $('#doc-type-unit').val(type_unit);
    $('#id-denahs').val(id_denahs).change();
    if (type_unit == 'Subsidi') {
        $("#select-pembayaran").html(select_subsidi)
    } else if (type_unit == 'Komersil') {
        $("#select-pembayaran").html(select_komersil)
    }

    if (status_pembayaran == 'null') {

        $('#select-pembayaran').val('0').change();
    } else {

        $('#select-pembayaran').val(status_pembayaran).change();
    }

    if (progres_berkas == '0') {

        $('#select-pembayaran').removeAttr("disabled", 'disabled');
        $('.readonly-select-pembayaran').html('');
    } else {
        $('#select-pembayaran').prop('disabled', true);
        $('.readonly-select-pembayaran').html(
            '<span style="font-family: NucleoIcons;font-size: smaller;"> <sup>*</sup> Kosongkan data unit jika ingin merubahnya !</span>'
        )
    }
    $('#progres-berkas').val(progres_berkas);

}

function filter_tgl() {
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD/MM/YYYY'
            }
        }, function(start, end, label) {
            console.log("A date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
                'YYYY-MM-DD'));
            // alert(start);
            $('#tgl-start').val(start.format('DD/MM/YYYY'));
            $('#tgl-end').val(end.format('DD/MM/YYYY'));
            // var tgl_start = $('#tgl-start').val();
            // var tgl_end = $('#tgl-end').val();
            // var strStart = tgl_start.replace(/\//g, '-');
            // var strEnd = tgl_end.replace(/\//g, '-');

            // if ($('#status').val() == 'UTJ' || $('#status').val() == 'DP' || $('#status').val() == 'Sold Out') {
            //     window.crud.ajax.url("<?php echo base_url('/Home/search'); ?>/" + $('#id-siteplan').val() +
            //         "?fil_type_unit=" + $('#fil-type-unit').val() + "&status=" + $('#status').val() + "&tgl_start=" + $('#tgl-start').val() + "&tgl_end=" + $('#tgl-end').val()).load();

            //     $('#cetak-pdf').attr('href', "<?= base_url('Laporan_pdf'); ?>/data/" + $('#id-siteplan').val() + '/' + $('#status').val() + '/' + strStart + '/' + strEnd)
            // } else {

            // }

            if ($('#fil-type-unit').val() == 'Komersil') {
                if ($('#fil-payout').val() == 'kpr') {
                    var payout = 'kpr-kom';
                } else {

                    var payout = $('#fil-payout').val();
                }
            } else if ($('#fil-type-unit').val() == 'Subsidi') {
                if ($('#fil-payout').val() == 'kpr') {
                    var payout = 'kpr-sub';
                } else {
                    var payout = $('#fil-payout').val();
                }

            }
            window.crud.ajax.url("<?php echo base_url('/Home/search'); ?>/" + $('#id-siteplan').val() +
                "?fil_type_unit=" + $('#fil-type-unit').val() + "&fil_payout=" + $('#fil-payout')
                .val() + "&status=" + $('#status').val() + "&tgl_start=" + $('#tgl-start').val() +
                "&tgl_end=" + $('#tgl-end').val()).load();
            var tgl_start = $('#tgl-start').val();
            var tgl_end = $('#tgl-end').val();
            var strStart = tgl_start.replace(/\//g, '-');
            var strEnd = tgl_end.replace(/\//g, '-');
            // alert(strStart)
            // if ($('#status').val() == 'UTJ' || $('#status').val() == 'DP' || $('#status').val() == 'Sold Out') {

            //     $('#cetak-pdf').attr('href', "<?= base_url('Laporan_pdf'); ?>/data/" + $('#id-siteplan').val() + '/' + $('#status').val() + '/' + strStart + '/' + strEnd)
            // } else {

            // }
        });

    });
}
$(function() {
    $('input[name="tgl-trans"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
            format: 'DD/MM/YYYY'
        }

    });
});
</script>