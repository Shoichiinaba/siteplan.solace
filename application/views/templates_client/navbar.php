<style>
.min-heig-nav {
    height: 28rem;
}

.blur.blur-rounded {
    border-radius: 9px;
}

/* CSS khusus untuk navbar */
.navbar-custom {
    background: rgba(6, 77, 65, 0.6);
    /* hijau transparan */
    backdrop-filter: blur(12px);
    /* efek blur kaca */
    -webkit-backdrop-filter: blur(12px);
    /* Safari/iOS support */
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    /* garis tipis biar mirip glass */
    padding-bottom: 0px !important;
    min-height: 35px !important;
}

.navbar-custom {
    background: rgba(6, 77, 65, 0.6);
    /* hijau transparan */
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    /* Safari/iOS support */
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);

    display: flex;
    /* aktifkan flex */
    align-items: center;
    /* konten vertikal rata tengah */
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    min-height: 50px !important;
}



/* Warna teks dan link */
.navbar-custom .nav-link,
.navbar-custom .navbar-brand {
    color: #ffffff !important;
}

.navbar-custom .nav-link:hover {
    color: #d1e7e2 !important;
}

/* default putih */
.navbar-custom .nav-link,
.navbar-custom .nav-link i {
    color: #ffffff !important;
    transition: color 0.3s ease;
    /* animasi halus */
}

/* saat hover jadi #fac989 */
.navbar-custom .nav-link:hover,
.navbar-custom .nav-link:hover i {
    color: #fac989 !important;
}



@media only screen and (max-width: 992px) and (orientation: portrait) {
    .p-nav {
        padding: 0px 0px !important;
        margin: 0px 5px !important;
    }

    .m-h {
        height: 13rem !important;
        margin: 0 !important;
    }

    .top-padd-mar {
        top: -56px;
        padding: 7px;
        margin: 0px 7px !important;
    }
}

@media only screen and (max-width: 1024px) and (orientation: landscape) {
    .min-heig-nav {
        height: 21rem;
    }

    .top-padd-mar {
        top: -76px;
        padding: 7px;
        margin: 0px 7px !important;
    }
}

/* Tombol default */
.nav-pills .nav-link {
    background-color: #064d41;
    /* hijau */
    color: #ffffff;
    /* teks putih */
    border-radius: 8px;
    /* biar lebih halus */
    transition: all 0.3s ease;
}

/* Saat hover */
.nav-pills .nav-link:hover {
    background-color: #04695b;
    /* sedikit lebih terang */
    color: #fac989;
    /* teks berubah */
}

/* Saat aktif (yang sedang dipilih) */
.nav-pills .nav-link.active {
    background-color: #04695b !important;
    color: #ffffff !important;
}
</style>
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <nav class="navbar navbar-expand-lg shadow position-absolute py-2 start-0 end-0 mx-2 p-nav navbar-custom">
            <div class="container-fluid pe-0">
                <a class="navbar-brand font-weight-bolder ms-lg-0 p-0 m-0" href="">
                    <?php
                        $tittle = $this->uri->segment(3);
                        $perum = preg_replace("![^a-z0-9]+!i", " ", $tittle);

                        if (isset($_title)) {
                            echo $perum;
                        } else {
                            ?>
                    <img src="<?= base_url('assets_adm/img/logo/logo2.png'); ?>" class="navbar-brand-img p-0 m-0"
                        alt="main_logo" style="height:30px; width:auto;">
                    <?php
                        }
                        ?>
                </a>

                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation" style="border: none;">
                    <span class="navbar-toggler-icon" style="margin-top: 14px !important;">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                href="https://solaceproperti.com/">
                                <i class="fa fa-home opacity-6 me-1"></i>
                                Solace Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" href="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="<?php echo site_url(''); ?> ">
                                <i class="ni ni-square-pin"></i>
                                Home
                            </a>
                        </li>
                    </ul>
                    <li class=" nav-item d-flex align-items-center">
                    </li>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>