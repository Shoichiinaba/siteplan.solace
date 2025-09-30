<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets_adm/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets_adm/img/logo/logo1.png">
    <title>
        <?php echo $_tittle; ?>
    </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="<?= base_url(); ?>assets_adm/css/soft-ui-dashboard.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.min.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
    .async-hide {
        opacity: 0 !important
    }

    svg {
        /* border: 1px solid gray; */
        display: block;
        height: 30rem;
        width: -webkit-fill-available;
    }

    div.controls {
        text-align: center;
        margin-top: 3px;
    }

    div.controls i {
        margin: 3px;
    }

    div.controls-zoom,
    div.controls-pan {
        display: inline-block;
    }

    div.controls-zoom i {
        margin-left: 10px;
        margin-right: 10px;

    }

    div.controls-zoom {
        margin-left: 40px;
    }

    div.controls-pan i {
        margin-left: 10px;
        margin-right: 10px;

    }

    div.keterangan {
        text-align: center;
        margin-bottom: 1px;
    }

    div.keterangan span {
        margin-left: 4px;
        margin-bottom: 3px;
    }

    #svg-container {
        position: relative;
        margin-bottom: 12px;
        margin-top: 8px;
    }

    .pup {
        height: 12px;
        width: 12px;
        display: inline-flex;
        padding-right: 12px;
        border: 1px solid gray;
    }

    @media screen and (max-width: 700px) {
        svg {
            /* border: 1px solid purple; */
            display: block;
            margin-left: -15px;
            /* margin-right: auto; */
            height: 370px;
            width: 290px;

        }

        div.controls-pan i {
            margin-left: 10px;
            margin-right: 12px;
        }

        div.controls-zoom i {
            margin-left: 1px;
            margin-right: 18px;
            margin-top: 8px
        }

        div.keterangan {
            text-align: center;
            margin-top: 1px;
            margin-bottom: -20px;
        }
    }
    </style>

    <script type="text/javascript"
        src="https://rawgit.com/DanielHoffmann/jquery-svg-pan-zoom/master/compiled/jquery.svg.pan.zoom.js"></script>

</head>