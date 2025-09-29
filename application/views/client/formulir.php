<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets_adm/img/logo/logo1.png">
    <title>
        Formulir
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="<?= base_url(); ?>assets_adm/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('<?= base_url(); ?>assets_adm/img/gbr_header/header_login.png');">
                <span class="mask bg-gradient-info opacity-5"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h2 class="text-white mb-2 mt-5">Selamat Datang Di Kanzu Permai Abadi!</h2>
                            <p class="text-lead text-white">Terima kasih Atas Kunjungannya Di Web Kanpa.co.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Mohon Mengisikan Data Diri Anda</h5>
                            </div>
                            <div class="card">
                                <div class="card-body login-card-body">
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
                                            <input type="text" class="form-control" name="nama" required="" autocomplete="off" placeholder="Ketikan Nama Anda...">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" autocomplete="off" required="" placeholder="Email" name="email" aria-describedby="email-addon">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" autocomplete="off" required="" placeholder="No. telp 62" name="telepon" aria-describedby="email-addon">
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-select" id="select-perum" name="perum">
                                                <option value="">Pilih Perumahan </option>
                                                <?php
                                                foreach ($perumahan as $data) :
                                                    $nama = preg_replace("![^a-z0-9]+!i", "-", $data->nama);
                                                ?>
                                                    <option value="<?= $nama; ?>"><?= $data->nama; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">
                                                    Kirim</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- awal footer -->
        <style>
            .title-h4 {
                color: orange;
                font-family: ui-serif;
                font-weight: bold;
            }

            .text-h6 {
                color: white;
                font-family: sans-serif;
            }

            .icon-info-kontak {
                display: inline-flex;
                flex-direction: column;
                align-items: center;
                padding: 5px;
                font-size: 28px;
                color: white;
                border: 2px solid white;
                border-radius: 10px;
            }
        </style>
        <footer class="footer py-5 mt-1" style="background: #033b6c;">
            <div class="container">
                <div>
                    <h4 class="font-weight-bolder text-warning text-gradient">Kanzu Permai Abadi</h4>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 ">
                        <h4 class="title-h4">Jam Kerja</h4>
                        <h6 class="text-h6">Senin - Minggu</h6>
                        <h6 class="text-h6">08AM - 16PM</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <h4 class="title-h4">Kantor Penjualan</h4>
                        <h6 class="text-h6">Jl. Pattimura Raya, Komplek Masjid Baitut Taqwa, Mapagan, Lerep, Kec.
                            Ungaran
                            Bar.,
                            Kabupaten Semarang, Jawa Tengah 50518</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <h4 class="title-h4">Info Kontak</h4>
                        <h6 class="text-h6"><i class="fa-solid fa fa-phone"></i> (024) 7590 1139</h6>
                        <h6 class="text-h6"><i class="fa-brands fab fa-whatsapp"></i> 0823-3350-7931</h6>
                        <h6 class="text-h6"><i class="fa-regular fa fa-envelope"></i> Kanzugroupindonesia@gamail.com
                        </h6>
                        <hr class="horizontal light">
                        <div class="mb-2" style="text-align-last: justify;">
                            <a href="" class="icon-info-kontak"><i class="fa-brands fab fa-whatsapp"></i></a>
                            <a href="" class="icon-info-kontak"><i class="fa-brands fab fa-instagram"></i></a>
                            <a href="" class="icon-info-kontak"><i class="fa-brands fab fa-facebook"></i></a>
                            <a href="" class="icon-info-kontak"><i class="fa-regular fab fa-tiktok"></i></a>
                            <a href="" class="icon-info-kontak"><i class="fa-brands fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mx-auto text-center mt-0">
                        <p class="mb-0 text-white">
                            &copy; <script>
                                document.write(new Date().getFullYear())
                            </script> PT KANPA
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- akhir footer -->
    </main>
    <!--   Core JS Files   -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/core/popper.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/core/bootstrap.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/plugins/smooth-scrollbar.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

    <script>
        $(document).ready(function() {
            <?php
            $tittle = $this->uri->segment(3);
            $perum = preg_replace("![^a-z0-9]+!i", "-", $tittle);
            ?>
            if('<?= $perum; ?>' == ''){

                $('#select-perum').val('<?= $perum; ?>');
                $('#select-perum').trigger('change').removeAttr('disabled', true);
            }else{

                $('#select-perum').val('<?= $perum; ?>');
                $('#select-perum').trigger('change').attr('disabled', true);
            }
            // alert('<?= $perum; ?>')
        });
    </script>
</body>

</html>