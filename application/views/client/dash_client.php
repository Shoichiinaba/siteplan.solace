<!-- Load jQuery & Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
.select2-container {
    width: 100% !important;
    display: block;
}

.select2-container--default .select2-selection--single {
    height: 38px;
    padding: 6px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 24px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
    right: 70px;
}
</style>

<main class="main-content  mt-0">
    <div class="container">
        <!-- <div class="page-header min-heig-nav m-h"> -->
        <img class="img-fluid mt-5" src="<?= base_url('upload'); ?>/header.png" alt="" style="border-radius: 9px;">
        <!-- </div> -->

        <div class="row">
            <?php
            if (!$this->session->userdata('form_data')) { ?>
            <?php
                $no = 1;
                foreach ($perumahan as $data) :
                    $nama = preg_replace("![^a-z0-9]+!i", "-", $data->nama);
                ?>
            <div class="col-6 mt-3">
                <img class="img-fluid cek-siteplan" src="<?= base_url('upload'); ?>/<?= $data->foto_hed; ?>"
                    data-perum="<?= $nama; ?>" data-id_perum="<?= $data->id_perum; ?>" data-bs-toggle="modal"
                    data-bs-target="#modal-formulir" style="border-radius: 9px;">
            </div>
            <?php
                endforeach;
                ?>

            <?php
            } else {
            ?>
            <?php
                $no = 1;
                foreach ($perumahan as $data) :
                    $nama = preg_replace("![^a-z0-9]+!i", "-", $data->nama);
                ?>
            <div class="col-6 mt-3">
                <a href="<?= base_url('Client/visit/'.$nama.'/'.$data->id_perum); ?>">
                    <img class="img-fluid" src="<?= base_url('upload/'.$data->foto_hed); ?>"
                        style="border-radius: 9px;">
                </a>
            </div>
            <?php
                endforeach;
                ?>
            <?php
            } ?>

        </div>
    </div>
</main>

<div class="modal fade" id="modal-formulir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Mohon Mengisikan Data Diri Anda</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('Client/submit'); ?>" method="post">
                    <!-- Alert -->
                    <!-- Menampilkan alert saat data berhasil disimpan -->
                    <?php if ($this->session->flashdata('success_message')) : ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success_message'); ?></div>
                    <?php endif; ?>

                    <!-- Menampilkan alert saat data sudah ada -->
                    <?php if ($this->session->flashdata('error_message')) : ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error_message'); ?></div>
                    <?php endif; ?>

                    <!-- akhir alert -->

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" required="" autocomplete="off"
                            placeholder="Ketikan Nama Anda...">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" autocomplete="off" required="" placeholder="Email"
                            name="email" aria-describedby="email-addon">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" autocomplete="off" required=""
                            placeholder="No. telp 62" name="telepon" aria-describedby="email-addon">
                    </div>
                    <div class="input-group mb-3">
                        <select id="domisili" name="domisili" class="form-control w-100" required></select>
                    </div>
                    <div class="input-group mb-3" hidden>
                        <input type="text" id="nm-perum" name="perum">
                    </div>
                    <div class="input-group mb-3" hidden>
                        <input type="text" id="id-perum" name="id_perum">
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">
                                Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Attech-->
</div>
<script>
$('.cek-siteplan').click(function() {
    // alert();
    $('#nm-perum').val($(this).data('perum'))
    $('#id-perum').val($(this).data('id_perum'))
});

$(document).ready(function() {
    // Ambil semua data provinsi dulu
    $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json", function(provinces) {
        let requests = [];
        provinces.forEach(function(prov) {
            let url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + prov.id +
                ".json";
            requests.push($.getJSON(url));
        });

        // Jalankan semua request
        $.when.apply($, requests).done(function() {
            let allCities = [];

            // Kalau hanya 1 provinsi
            if (requests.length === 1) {
                allCities = arguments[0];
            } else {
                // Kalau lebih dari 1 provinsi → gabungkan semua
                for (let i = 0; i < arguments.length; i++) {
                    allCities = allCities.concat(arguments[i][0]);
                }
            }

            // Init Select2 dengan data semua kota/kabupaten
            $('#domisili').select2({
                placeholder: "Pilih Kota/Kabupaten",
                dropdownParent: $('#modal-formulir'),
                data: $.map(allCities, function(item) {
                    return {
                        id: item.name.toUpperCase(),
                        text: item.name
                    };
                })
            });
        });
    });
});
</script>