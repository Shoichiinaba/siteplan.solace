<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets_adm/img/logo/logo1.png">
    <title>
        Halaman Login
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url(); ?>assets_adm/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="<?= base_url(); ?>assets_adm/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>
<?php
if ($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
}
?>

<body class="">
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('<?= base_url('upload'); ?>/header.png');">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h2 class="text-white mb-2 mt-5"></h2>
                            <br><br><br>
                            <p class="text-lead text-white"></p>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <img src="<?= base_url(); ?>assets_adm/img/logo/logo1.png" alt="Logo" width="50"
                                    height="50">
                                <h5>Login</h5>
                            </div>
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <form action="<?= site_url('Auth/login') ?>" method="post">
                                        <!-- Alert -->
                                        <?php
                                        if (validation_errors() || $this->session->flashdata('result_login')) {
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <span class="alert-icon"><i class="fa fa-warning"></i></span>
                                            <strong>Warning!</strong>
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('result_login'); ?>
                                            <?php echo $this->session->flashdata('Habis'); ?>
                                        </div>
                                        <?php } ?>

                                        <?php
                                        $data = $this->session->flashdata('sukses');
                                        if ($data != "") { ?>
                                        <div class="alert alert-success"><strong>Sukses! </strong> <?= $data; ?></div>
                                        <?php } ?>
                                        <!-- akhir alert -->
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="username" id="username"
                                                required="" autocomplete="off" placeholder="Enter username Anda...">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" name="password" id="password"
                                                aria-describedby="email-addon">
                                        </div>
                                        <div class="row">
                                            <div class="form-check form-check-info text-left">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="customCheck">
                                                <label class="form-check-label" type="checkbox" for="flexCheckDefault">
                                                    Tampilkan
                                                    Password </label>
                                            </div>
                                            <!-- /.col -->
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign
                                                    in</button>
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
        .page-header {
            position: relative;
            padding-top: 0% !important;
            background-size: cover;
            background-position: center;
        }

        .footer {
            background-color: #002f2b;
            padding: 22px 0;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .footer .logo {
            font-size: 28px;
            font-weight: bold;
            color: #f6d76f;
            display: block;
            margin-bottom: 20px;
        }

        .footer .footer-column h5 {
            font-size: 16px;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
        }

        .footer .footer-column ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .footer .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer .footer-column ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer .footer-column ul li a:hover {
            color: #f6d76f;
        }

        #copyright {
            text-align: center;
            color: white;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 14px;
        }
        </style>
        <section id="footer" class="footer mt-3">
            <div class="container">
                <div class="row">
                    <!-- Logo dan nama -->
                    <div class="col-md-3 col-12 mb-4">
                        <img src="<?= base_url('assets/img/logo/solace_logo.png'); ?>" alt="solaceproperti.com"
                            style="height: 50px;">
                    </div>

                    <!-- Kolom 1 -->
                    <div class="col-md-3 col-6 footer-column">
                        <h5>Perusahaan</h5>
                        <ul>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Produk & Layanan</a></li>
                            <li><a
                                    href="https://wa.me/6283842901775?text=Hallo%20Solace Properti%2C%20Saya%20ingin%20Iklan%20%20properti%20saya%20...">Partner</a>
                            </li>
                            <li><a
                                    href="https://wa.me/6283842901775?text=Hallo%20Solace Properti%2C%20Saya%20ingin%20Mengetahui Info Lowongan%20%20Di Solace Properti%20%20...">Karir</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="col-md-3 col-6 footer-column">
                        <h5>Layanan</h5>
                        <ul>
                            <li><a
                                    href="https://wa.me/6283842901775?text=Hallo%20Solace Properti%2C%20Saya%20ingin%20Iklan%20%20properti%20saya%20...">Iklankan
                                    Properti</a></li>
                            <li><a href="">Simulasi KPR</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="col-md-3 col-12 footer-column">
                        <h5>Dukungan</h5>
                        <ul>
                            <li><a href="#">Kebijakan</a></li>
                            <li><a href="#">Syarat Penggunaan</a></li>
                            <li><a href="#">Syarat Penggunaan Agent</a></li>
                        </ul>
                    </div>
                </div>

                <div id="copyright">
                    &copy; 2025 Solace Properti. All Rights Reserved.
                </div>
            </div>
        </section>

        <!-- akhir footer -->
    </main>
    <!--   Core JS Files   -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
    $(document).ready(function() {
        $(' #customCheck').click(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
    });
    </script>

    <script src="<?= base_url('assets_adm/'); ?>js/core/popper.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/core/bootstrap.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>js/plugins/smooth-scrollbar.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="<?= base_url('assets_adm/'); ?>/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>