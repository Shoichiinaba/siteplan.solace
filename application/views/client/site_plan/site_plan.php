<style>
.table-sm th,
.table-sm td {
    font-size: 13px;
    /* perkecil teks */
    padding: 4px;
    /* perkecil padding */
}


/* svg {
    width: 100%;
    height: auto;
} */

#svg polygon,
#svg rect {
    cursor: pointer;
    pointer-events: all !important;
    /* pakai all saja */
    fill-opacity: 1;
}

.mask {
    pointer-events: none !important;
    /* sudah oke */
}

#svg-container {
    position: relative;
    width: 100%;
    height: 70vh;
    /* FIX tinggi */
    min-height: 500px;
    max-height: 800px;
}

#data-site-plan {
    width: 100%;
    height: 100%;
}

#data-site-plan svg {
    width: 100% !important;
    height: 100% !important;
    display: block;
}

#svg-container svg {
    width: 100%;
    height: auto;
    max-height: 80vh;
    /* supaya tidak kepanjangan */
}

.progress {
    height: 15px;
}

.progress-container {
    position: relative;
}

.progress-bar {
    display: flex;
    height: 100px;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
    color: #fff;
}

.progress-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 12px;
    font-weight: bold;
    color: #000;
    /* biar selalu kelihatan */
}
</style>

<main class="main-content  mt-0">
    <div class="container">
        <div class="page-header min-heig-nav border-radius-xl m-h">
            <?php
            $no = 1;
            foreach ($perum as $data) :
             ?>
            <img class="img-fluid" src="<?= base_url('upload'); ?>/<?= $data->foto_hed; ?>" alt=""
                style="border-radius: 9px;">
            <?php
            endforeach;
            ?>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden top-padd-mar">
            <div class="row gx-4">
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <?php
                            $no = 1;
                            foreach ($area_siteplan as $data) :
                            ?>
                            <li class="nav-item">
                                <div id="area-<?= $no++; ?>" class="nav-link mb-0 px-0 py-1 btn-area"
                                    data-id-site-plan="<?= $data->id_siteplan; ?>" style="cursor: pointer;">
                                    <i class="fa fa-street-view" aria-hidden="true"></i>
                                    <?php
                                        if ($data->area == 'Siteplan') { ?>
                                    <span class="ms-1">Site Plan</span>
                                    <?php
                                        } else { ?>
                                    <span class="ms-1"><?php echo 'Site Plan ' . $data->area; ?></span>
                                    <?php
                                        }
                                        ?>
                                </div>
                            </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                        style="background-image: url('<?= base_url(); ?>assets_adm/img/map1.jpg');">
                        <span class="mask bg-gradient-light"></span>
                        <!-- <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3"> -->
                        <div class="card-body position-relative z-index-1 p-3">
                            <!-- tes menu tab-->
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show position-relative active" id="selatan" role="tabpanel"
                                    aria-labelledby="cam1">
                                    <div id="svg-container">
                                        <div class="position-absolute d-flex top-0 w-100">
                                            <p class="p-3 mb-0 fa fa-map-marker text-danger"><i
                                                    class="text-black text-sm-center"><?php echo ' Site Plan ' . $data->area; ?></i>
                                            </p>
                                        </div>
                                        <div id="data-site-plan" data-id_perum="<?= $perum[0]->id_perum; ?>"
                                            style="justify-content: center; display: flex;">
                                        </div>

                                        <div class="keterangan-fixed">
                                            <?php
                                                $sold = 0; $dipesan = 0; $ready = 0;
                                                if (!empty($status_count)) {
                                                    foreach ($status_count as $row) {
                                                        if (strtolower($row->type) == 'sold out') {
                                                            $sold = $row->total;
                                                        } elseif (strtolower($row->type) == 'dipesan') {
                                                            $dipesan = $row->total;
                                                        } elseif (strtolower($row->type) == 'rumah ready') {
                                                            $ready = $row->total;
                                                        } elseif (strtolower($row->type) == 'kosong') {
                                                            $kosong = $row->total;
                                                        }

                                                    }
                                                }
                                            ?>
                                            <span style="background-color: yellow" class="badge text-dark">
                                                <?= $sold ?> Sold Out
                                            </span>
                                            <span class="badge bg-gradient-danger">
                                                <?= $dipesan ?> Dipesan
                                            </span>
                                            <span class="badge bg-gradient-info">
                                                <?= $ready ?> Rumah Ready
                                            </span>
                                            <span class="badge bg-gradient-secondary">
                                                <?= $kosong ?> Kosong
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir tes menu tab -->
                </div>
            </div>
        </div>
        <div class="container">
            <div id="example2" class="controls">
                <div class="controls-pan">
                    <i class="btn btn-success fa fa-arrow-up"></i>
                    <i class="btn btn-success fa fa-arrow-down"></i>
                    <i class="btn btn-success fa fa-arrow-left"></i>
                    <i class="btn btn-success fa fa-arrow-right"></i>
                </div>
                <div class="controls-zoom">
                    <i class="btn btn-warning fa fa-refresh"></i>
                    <i class="btn btn-danger fa fa-plus"></i>
                    <i class="btn btn-danger fa fa-minus"></i>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="tampilModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Detail Blok</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6><b>Perumahan:</b> <span id="nama-perum"></span></h6>

                <!-- Perumahan table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>Nama</th>
                                <th>No WA</th>
                                <th>Blok</th>
                                <th>Type Unit</th>
                                <th>Status Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="nama-cus"></td>
                                <td id="no-wa"></td>
                                <td id="blok"></td>
                                <td id="type-unit"></td>
                                <td><span id="status-pembelian" class="badge"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Transaksi table -->
                <h6 class="mt-3"><b>Transaksi</b></h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle">
                        <thead class="table-info">
                            <tr>
                                <th>Status Transaksi</th>
                                <th>Tgl Transaksi</th>
                                <th>Nominal</th>
                                <th>Tahap</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-transaksi"></tbody>
                    </table>
                    <!-- Ringkasan DP -->
                    <div id="ringkasan-dp" class="mt-3"></div>
                </div>

                <!-- Progres + Marketing sejajar -->
                <h6 class="pt-0 pb-0"><b>Progres Berkas:</b></h6>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="progress-container w-50 position-relative">
                        <div class="progress">
                            <div id="progres-berkas" class="progress-bar bg-success" role="progressbar"
                                style="width: 0%;" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <span id="progres-text" class="progress-label">0%</span>
                    </div>
                    <div>
                        <b>Marketing:</b> <span id="marketing"></span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {
    var area = $('#area-1');
    area.trigger("click");
});
$('.btn-area').click(function(e) {
    $('.btn-area').removeClass('active');
    $(this).addClass('active');

    let formData = new FormData();
    // formData.append('id-perum', $(this).data('id-perum'));
    formData.append('id-siteplan', $(this).data('id-site-plan'));
    $.ajax({
        type: 'POST',
        url: "<?php echo site_url('Client/load_site_plan') ?>",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#data-site-plan').html(data);
            load_query_map();
        },
        error: function() {
            alert("Data Gagal Diupload");
        }
    });
});

function load_query_map() {
    $(function() {
        "use strict";

        /* ===============================
         * INIT SVG PAN ZOOM (VANILLA)
         * =============================== */
        var panZoom = svgPanZoom('#svg', {
            zoomEnabled: true,
            controlIconsEnabled: false,
            fit: true,
            center: true,
            minZoom: 0.6,
            maxZoom: 10
        });

        /* ===============================
         * CALLBACK ICON PAN / ZOOM
         * =============================== */
        function callback(instance) {
            return function(event) {
                var $t = $(event.target);
                var step = 50; // jarak geser (px)

                if ($t.hasClass("fa-arrow-up")) {
                    instance.panBy({
                        x: 0,
                        y: step
                    });
                }
                if ($t.hasClass("fa-arrow-down")) {
                    instance.panBy({
                        x: 0,
                        y: -step
                    });
                }
                if ($t.hasClass("fa-arrow-left")) {
                    instance.panBy({
                        x: step,
                        y: 0
                    });
                }
                if ($t.hasClass("fa-arrow-right")) {
                    instance.panBy({
                        x: -step,
                        y: 0
                    });
                }
                if ($t.hasClass("fa-plus")) {
                    instance.zoomIn();
                }
                if ($t.hasClass("fa-minus")) {
                    instance.zoomOut();
                }
                if ($t.hasClass("fa-refresh")) {
                    instance.resetZoom();
                    instance.center();
                }
            };
        }

        $("#example2 i").off('click').on('click', callback(panZoom));

        /* ===============================
         * LOAD WARNA DENAH
         * =============================== */
        function loadDenahColor() {
            var perum = '<?= $this->uri->segment(3) ?>';

            $.ajax({
                url: "<?= base_url('index.php/home/allDenahColor/') ?>" + perum,
                type: 'GET',
                success: function(data) {
                    if (!data || !data.results) return;

                    for (var i = 0; i < data.results.length; i++) {
                        var path = data.results[i];
                        $('#' + path.code).css('fill', path.color);
                    }
                }
            });
        }

        // delay agar SVG benar-benar ter-load
        setTimeout(loadDenahColor, 1000);

        /* ===============================
         * EVENT KLIK / TAP POLYGON & RECT
         * =============================== */
        var base_url = "<?= base_url(); ?>";

        $(document).off('click touchstart pointerdown', '#svg polygon, #svg rect');
        $(document).on('click touchstart pointerdown', '#svg polygon, #svg rect', function(e) {
            e.preventDefault();

            var noKapling = this.id;
            var idPerum = $('#data-site-plan').data('id_perum');

            if (!noKapling || !idPerum) return;

            $.ajax({
                url: base_url + "Client/getDenahDetail",
                type: "POST",
                dataType: "json",
                data: {
                    id_perum: idPerum,
                    code: noKapling
                },
                success: function(res) {
                    if (!res.success) {
                        alert(res.message);
                        return;
                    }

                    let d = res.data;

                    // isi modal
                    $('#nama-perum').text(d.nama_perum || "-");
                    $('#nama-cus').text((d.transaksi?. [0]?.nama_cus) || "-");
                    $('#no-wa').text((d.transaksi?. [0]?.no_wa) || "-");
                    $('#blok').text(d.code || "-");
                    $('#type-unit').text(d.type_unit || "-");

                    // status pembelian
                    let statusPemb = d.status_pembayaran || "-";
                    let badgeClass = "badge bg-secondary";
                    if (statusPemb === "KPR") badgeClass = "badge bg-success";
                    if (statusPemb === "CASH") badgeClass = "badge bg-primary";

                    $('#status-pembelian')
                        .removeClass()
                        .addClass(badgeClass)
                        .text(statusPemb);

                    // tabel transaksi
                    let tbody = "";
                    if (d.transaksi && d.transaksi.length) {
                        d.transaksi.forEach(tr => {
                            tbody += `
                                <tr>
                                    <td>${tr.status_trans || "-"}</td>
                                    <td>${tr.tgl_trans || "-"}</td>
                                    <td>${tr.nominal ? "Rp. " + new Intl.NumberFormat('id-ID').format(tr.nominal) : "-"}</td>
                                    <td>${tr.tahap || "-"}</td>
                                </tr>`;
                        });
                    } else {
                        tbody = `
                            <tr>
                                <td colspan="4" class="text-center">-</td>
                            </tr>`;
                    }
                    $("#tbody-transaksi").html(tbody);

                    // hitung DP
                    let nominalDP = 0,
                        totalDPdibayar = 0;
                    d.transaksi?.forEach(tr => {
                        if (tr.status_trans === "DP") {
                            totalDPdibayar += parseInt(tr.nominal) || 0;
                            nominalDP = parseInt(tr.nominal_dp) || nominalDP;
                        }
                    });

                    let sisaDP = nominalDP ? nominalDP - totalDPdibayar : 0;
                    let formatRp = n => "Rp. " + new Intl.NumberFormat('id-ID').format(n ||
                        0);

                    $("#ringkasan-dp").html(`
                        <table class="table table-bordered table-sm mt-2">
                            <tr><td class="fw-bold">Nominal DP</td><td>${nominalDP ? formatRp(nominalDP) : "-"}</td></tr>
                            <tr><td class="fw-bold">DP Dibayar</td><td>${totalDPdibayar ? formatRp(totalDPdibayar) : "-"}</td></tr>
                            <tr><td class="fw-bold">Kekurangan</td>
                                <td>${sisaDP > 0 ? formatRp(sisaDP) : (nominalDP ? '<span class="badge bg-success">LUNAS</span>' : '-')}</td>
                            </tr>
                        </table>
                    `);

                    // marketing
                    $('#marketing').text(d.transaksi?.length ? d.transaksi[d.transaksi
                        .length - 1].user_admin : "-");

                    // progress
                    let progress = d.progres_berkas ?? 0;
                    $('#progres-berkas').css('width', progress + '%').attr('aria-valuenow',
                        progress);
                    $('#progres-text').text(progress + '%');

                    $('#tampilModal').modal('show');
                }
            });
        });
    });
}
</script>