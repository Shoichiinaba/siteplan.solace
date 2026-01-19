<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets_adm/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets_adm/img/logo/logo1.png">
    <title>
        Site Plan Selatan
    </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="<?= base_url(); ?>assets_adm/css/soft-ui-dashboard.min.css?v=1.1.1" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- date range picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- datatable css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- datatables js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?php echo base_url('assets/js/datatables.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#edit-data').on('shown.bs.modal', function() {
            $('.js-example-basic-single').select2();
        });

    });
    </script>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- akhir sweetalert -->
    <style>
    /* ===== SVG AREA ===== */
    </style>

    <style>
    svg {
        display: block;
        margin-left: auto;
        margin-right: auto;
        height: auto;
        width: -webkit-fill-available;
        max-height: 22rem !important;

    }

    #svg-container {
        position: relative;
        margin-bottom: 12px;
        margin-top: 8px;
        margin-right: 220px z-index: 1;
    }

    #data-siteplan {
        width: 100%;
        height: 100%;
        position: relative;
    }

    /* SVG jangan makan klik */
    #data-siteplan svg {
        width: 100% !important;
        height: auto !important;
        pointer-events: none !important;
        display: block;
    }

    /* Tapi shape SVG tetap bisa diklik */
    #data-siteplan svg path,
    #data-siteplan svg polygon,
    #data-siteplan svg rect {
        pointer-events: all !important;
        cursor: pointer;
    }

    /* ===== CONTROL PANEL ===== */
    #example2 {
        position: relative;
        z-index: 99999;
        /* PENTING */
        text-align: center;
    }

    #example2 .btn {
        pointer-events: auto !important;
        cursor: pointer;
        margin: 3px;
    }

    /* Layout */
    .controls-pan,
    .controls-zoom,
    .controls-keterangan {
        display: inline-block;
        vertical-align: top;
        margin: 5px;
    }

    div.controls {
        text-align: center;
    }

    div.controls i {
        margin: 3px;
    }

    div.controls p {
        margin: 2px;
    }

    div.controls-keterangan {
        display: inline-block;
        text-align: right;
        margin-bottom: 1px;
    }

    div.controls-zoom,
    div.controls-pan {
        display: inline-block;
        /* margin-left: 280px; */
    }

    div.controls-zoom {
        margin-left: 20px;
    }


    .panel-table {
        padding: 0px 20px 0px 20px;
    }

    .pup {
        height: 10px;
        width: 12px;
        display: inline-flex;
        padding-right: 12px;
        border-radius: 5px;
    }

    @media screen and (max-width: 700px) {
        svg {
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: 250px;
            width: 350px;
        }

        h4 {
            font-weight: 500px;
            ;
        }

    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom@3.6.1/dist/svg-pan-zoom.min.js"></script>
    <script>
    let panZoomInstance = null;

    $(document).ready(function() {

        const container = document.getElementById('data-siteplan');

        if (!container) {
            console.error('Container #data-siteplan tidak ditemukan');
            return;
        }

        /* ===============================
         * INIT PANZOOM (AMAN UNTUK SVG STATIS & DINAMIS)
         * =============================== */
        function initPanZoom(svg) {
            if (panZoomInstance) return;

            // console.log('Init svgPanZoom');

            panZoomInstance = svgPanZoom(svg, {
                zoomEnabled: true,
                fit: true,
                center: true,
                minZoom: 0.5,
                maxZoom: 10
            });

            setTimeout(() => {
                panZoomInstance.resize();
                panZoomInstance.fit();
                panZoomInstance.center();
            }, 100);
        }

        /* ===============================
         * CEK LANGSUNG (SVG DARI PHP)
         * =============================== */
        const svgNow = container.querySelector('svg');
        if (svgNow) {
            initPanZoom(svgNow);
        } else {
            /* ===============================
             * OBSERVER (SVG DARI AJAX)
             * =============================== */
            const observer = new MutationObserver(() => {
                const svg = container.querySelector('svg');
                if (svg) {
                    initPanZoom(svg);
                    observer.disconnect();
                }
            });

            observer.observe(container, {
                childList: true,
                subtree: true
            });
        }

        /* ===============================
         * BUTTON PAN & ZOOM
         * =============================== */
        $('#example2').on('click', '.btn', function() {

            if (!panZoomInstance) {
                console.warn('panZoom belum siap');
                return;
            }

            const step = 80;

            if ($(this).hasClass('fa-arrow-up')) {
                panZoomInstance.panBy({
                    x: 0,
                    y: step
                });
            } else if ($(this).hasClass('fa-arrow-down')) {
                panZoomInstance.panBy({
                    x: 0,
                    y: -step
                });
            } else if ($(this).hasClass('fa-arrow-left')) {
                panZoomInstance.panBy({
                    x: step,
                    y: 0
                });
            } else if ($(this).hasClass('fa-arrow-right')) {
                panZoomInstance.panBy({
                    x: -step,
                    y: 0
                });
            } else if ($(this).hasClass('fa-plus')) {
                panZoomInstance.zoomIn();
            } else if ($(this).hasClass('fa-minus')) {
                panZoomInstance.zoomOut();
            } else if ($(this).hasClass('fa-refresh')) {
                panZoomInstance.resetZoom();
                panZoomInstance.center();
            }
        });

        /* ===============================
         * AJAX WARNA DENAH
         * =============================== */
        setTimeout(function() {
            var perum = '<?= $this->uri->segment(3) ?>';

            $.ajax({
                url: "<?= base_url('index.php/home/allDenahColor/'); ?>" + perum,
                type: 'GET',
                success: function(data) {
                    if (!data.results) return;

                    data.results.forEach(item => {
                        $('#' + item.code).css('fill', item.color);
                    });
                }
            });
        }, 300);

    });
    </script>


</head>