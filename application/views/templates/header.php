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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
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
    .async-hide {
        opacity: 0 !important
    }

    /* body {
        padding-top: 70px;
        padding-bottom: 30px;
    } */

    svg {
        /* border: 1px solid purple; */
        display: block;
        margin-left: auto;
        margin-right: auto;
        height: auto;
        width: -webkit-fill-available;
        max-height: 22rem;

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
        /* margin-left: 188px; */
    }

    div.controls-zoom,
    div.controls-pan {
        display: inline-block;
        /* margin-left: 280px; */
    }

    div.controls-zoom {
        margin-left: 20px;
    }

    #svg-container {
        position: relative;
        margin-bottom: 12px;
        margin-top: 8px;
        margin-right: 220px
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
    <script type="text/javascript"
        src="https://rawgit.com/DanielHoffmann/jquery-svg-pan-zoom/master/compiled/jquery.svg.pan.zoom.js">
    </script>
    <script>
    var example1, example2;
    $(function() {
        // "use strict";
        var examples = $("#svg").svgPanZoom();

        var callback = function(example) {
            return function(event) {
                if ($(event.target).hasClass("fa-arrow-down"))
                    example.panUp()
                if ($(event.target).hasClass("fa-arrow-up"))
                    example.panDown()
                if ($(event.target).hasClass("fa-arrow-right"))
                    example.panLeft()
                if ($(event.target).hasClass("fa-arrow-left"))
                    example.panRight()
                if ($(event.target).hasClass("fa-plus"))
                    example.zoomIn()
                if ($(event.target).hasClass("fa-minus"))
                    example.zoomOut()
                if ($(event.target).hasClass("fa-refresh"))
                    example.reset()
            }
        };


        $("#example2 i").click(callback(examples));
        setTimeout(function() {
            var perum = '<?= $this->uri->segment(3) ?>'
            var denah = $('.cls-2');
            var data = new FormData();
            var param = [];
            for (var i = 0; i < denah.length; i++) {
                if (denah[i].id) {
                    param[i] = denah[i].id;
                    data.append('id[]', denah[i].id);
                }
            }
            // alert('<?= $this->uri->segment(3) ?>');
            $.ajax({
                url: "<?php echo base_url('index.php/home/allDenahColor/'); ?>" + perum,
                data: [],
                type: 'GET',
                success: function(data) {
                    for (var i = 0; i < data.results.length; i++) {
                        var path = data.results[i]
                        $(`#${path.code}`).css('fill', path.color);
                    }
                    // alert(data);
                }
            });
        }, 2000);
    });
    </script>
</head>