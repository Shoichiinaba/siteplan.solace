<!-- Load jQuery & Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* info unit */
.unit-box {
    position: relative;
    border: 2px solid #064d41;
    border-radius: 10px;
    padding: 15px 10px 10px 10px;
    background-color: #f9f9f9;
}

.unit-title {
    position: absolute;
    top: -14px;
    left: 50%;
    padding-left: 1px !important;
    padding-right: 1px !important;
    transform: translateX(-50%);
    background: #f9f9f9;
    padding: 0 15px;
    color: #5c8f2b;
    font-weight: 600;
    font-size: 16px;
}

.unit-content {
    color: #333;
    font-size: 15px;
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
}

.progress-custom {
    height: 28px;
    background: #e9ecef;
    border-radius: 50px;
    overflow: hidden;
    position: relative;
}

.progress-bar-custom {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    /* default center */
    color: #fff;
    font-weight: 600;
    transition: 0.6s;
    white-space: nowrap;
}

/* Tampilan mobile */
@media (max-width: 576px) {
    .progress-bar-custom {
        justify-content: center;
        text-align: center;
    }

    .progress-text {
        width: 100%;
        text-align: center;
        font-size: 13px;
    }
}


.card {
    border-radius: 15px;
}

.nav-tabs .nav-link.active {
    background-color: #0d6efd;
    color: #fff;
    border-radius: 10px;
}

/* =========================
   LIQUID GLASS NAV TABS
========================= */

/* =========================
   WRAPPER GLASS
========================= */

.glass-tab-wrapper {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    padding: 6px;
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}


/* =========================
   NAV STYLE
========================= */
.glass-tabs {
    border: none;
    display: flex;
    gap: 5px;
    position: relative;
    z-index: 2;
}

.glass-tabs .nav-link {
    border: none !important;
    padding: 8px 22px;
    border-radius: 12px;
    color: #064d41;
    font-weight: 500;
    background: transparent;
    position: relative;
    z-index: 2;
    transition: 0.3s;
}

.glass-tabs .nav-link.active {
    color: #fff;
}

/* =========================
   SLIDING INDICATOR
========================= */
.tab-indicator {
    position: absolute;
    top: 6px;
    left: 6px;
    height: calc(100% - 12px);
    width: 0;
    border-radius: 12px;
    transition: all 0.4s cubic-bezier(.68, -0.55, .27, 1.55);
    z-index: 1;

    /* LIQUID GLASS EFFECT */
    background: rgba(6, 107, 90, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    box-shadow:
        0 4px 20px rgba(6, 77, 65, 0.35),
        inset 0 1px 2px rgba(255, 255, 255, 0.4),
        inset 0 -2px 6px rgba(0, 0, 0, 0.2);
}

.tab-indicator::before {
    content: "";
    position: absolute;
    top: 8%;
    left: 10%;
    width: 80%;
    height: 40%;
    background: linear-gradient(to bottom,
            rgba(255, 255, 255, 0.6),
            rgba(255, 255, 255, 0.1));
    border-radius: 10px;
    pointer-events: none;
}

@media (max-width: 768px) {

    .glass-tabs {
        width: 100%;
    }

    .glass-tabs .nav-item {
        flex: 1;
        text-align: center;
    }

    .glass-tabs .nav-link {
        width: 100%;
        font-size: 14px;
        padding: 8px 6px;
        white-space: nowrap;
    }

}

/* ===============================
   TIMELINE PREMIUM ACCORDION
================================ */

.timeline-wrapper {
    position: relative;
    padding-left: 70px;
}

/* Garis utama */
.timeline-wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 36px;
    width: 4px;
    height: 100%;
    background: #064d41;
}


/* Item */
.timeline-item {
    position: relative;
}

/* Icon bulat */

.timeline-icon {
    position: absolute;
    left: -55px;
    top: 50%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #064d41;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #fff;
    z-index: 2;
}


/* Icon aktif */
.timeline-item .timeline-icon {
    background: #064d41 !important;
    color: #fff !important;
    box-shadow: 0 6px 18px rgba(6, 77, 65, 0.4);
}

/* Garis aktif */
.timeline-item.active::before {
    content: "";
    position: absolute;
    left: -34px;
    top: 20px;
    width: 4px;
    height: 103%;
    background: #064d41;
    z-index: 1;
}

/* Accordion header */
.timeline-wrapper .accordion-button {
    background: #f9fafb;
    border-radius: 14px !important;
    font-weight: 600;
    padding: 18px 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.timeline-wrapper .accordion-button:not(.collapsed) {
    background: #e6f4f1;
    color: #064d41;
}

/* Hilangkan arrow */
.accordion-button::after {
    display: none;
}

/* Card progress */
.progress-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    border-left: 4px solid #064d41;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
}

/* conten seskripsi & gambar */
.progress-content {
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

.progress-text {
    flex: 1;
}

.progress-images {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: flex-end;
}

.progress-images img {
    width: 160px;
    height: auto;
    border-radius: 10px;
    transition: 0.3s;
}

.progress-images img:hover {
    transform: scale(1.05);
}

/* Gallery Image */
.gallery-img {
    max-height: 85vh;
    transition: 0.4s ease;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
}

/* Navigation Buttons */
.gallery-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 50px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    transition: 0.3s;
    border-radius: 8px;
}

.gallery-nav:hover {
    background: rgba(255, 255, 255, 0.3);
}

.prev-btn {
    left: 40px;
}

.next-btn {
    right: 40px;
}

/* Hover zoom effect */
.preview-img {
    transition: 0.3s;
}

.preview-img:hover {
    transform: scale(1.07);
}

/* timeline */
.timeline-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
    position: relative;
}

.timeline-steps::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    height: 3px;
    background: #ddd;
    z-index: 0;
}

.step {
    text-align: center;
    position: relative;
    z-index: 1;
}

.step .circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #ccc;
    margin: auto;
}

.step.active .circle {
    background: #0d6efd;
}

.step span {
    display: block;
    margin-top: 8px;
    font-size: 14px;
}

.tahap-card {
    border: 2px solid #eee;
    transition: 0.3s;
}

.tahap-active {
    border-color: #198754;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.top-timeline-wrapper {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 40px;
    flex-wrap: nowrap;
}

.top-step {
    position: relative;
    flex: 1;
    text-align: center;
}

.top-step-header {
    background: linear-gradient(90deg, #3e9b8f, #2d7f76);
    color: white;
    padding: 10px;
    border-radius: 12px;
    font-weight: 600;
    margin-bottom: 15px;
}

.top-step-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    min-height: 160px;
    position: relative;
}

.top-step-card h6 {
    font-weight: 600;
    margin-bottom: 10px;
}

.top-step-card ul {
    padding-left: 18px;
    text-align: left;
    font-size: 13px;
}

.top-step-card ul li {
    margin-bottom: 4px;
}

.arrow-line {
    position: absolute;
    top: 25px;
    right: -20px;
    font-size: 18px;
    color: #2d7f76;
}

.top-step.active .top-step-header {
    background: linear-gradient(90deg, #3fbf9b, #2e8e80);
}

.top-step.active .icon-circle {
    background: #e6f7f3;
    color: #1c7c6e;
}

.premium-timeline {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 30px;
    margin-bottom: -41px;
    flex-wrap: wrap;
}

.premium-step {
    flex: 1;
    min-width: 220px;
    position: relative;
    text-align: center;
}

.premium-step::after {
    content: '';
    position: absolute;
    top: 19px;
    right: -25px;
    width: 25px;
    height: 3px;
    background: #e5e5e5;
}

.premium-step::before {
    content: '';
    position: absolute;
    top: 13px;
    right: -31px;
    width: 0;
    height: 0;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    border-left: 12px solid #e5e5e5;
}

.premium-step.done::after {
    background: #2e8e80;
}

.premium-step.done::before {
    border-left-color: #2e8e80;
}

.premium-step:last-child::after,
.premium-step:last-child::before {
    display: none;
}

.step-badge {
    padding: 8px 14px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 25px;
}

.green {
    background: linear-gradient(90deg, #3fbf9b, #2e8e80);
}

.blue {
    background: linear-gradient(90deg, #4da3ff, #2563eb);
}

.dark {
    background: linear-gradient(90deg, #444, #111);
}

.orange {
    background: linear-gradient(90deg, #ff914d, #ff6a00);
}

.step-content {
    background: #fff;
    border-radius: 20px;
    padding: 12px 14px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    min-height: auto;
    transition: 0.3s;
}

.step-content {
    padding: 10px 12px;
}

.step-content h5 {
    font-size: 16px;
    margin-bottom: 3px;
}

.step-content p {
    font-size: 13px;
    margin-bottom: 2px;
}

.step-content:hover {
    transform: translateY(-5px);
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin: -42px auto 2px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #fff;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.bg-green {
    background: #2e8e80;
}

.bg-blue {
    background: #2563eb;
}

.bg-dark {
    background: #111;
}

.bg-orange {
    background: #ff6a00;
}

.premium-step.done .step-content {
    border: 2px solid #2e8e80;
}

.tahap-card {
    border-radius: 15px;
    border: 1px solid #eee;
    transition: 0.3s;
}

.tahap-active {
    border-color: #198754;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}

/* access progress */

.akses-outer {
    position: relative;
    width: 280px;
    margin: 40px auto;
}

.akses-card {
    background: #f7f1e8;
    border-radius: 18px;
    padding: -1px 15px 20px 15px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 2px solid #d8cfc2;
    overflow: hidden;
    /* tetap aman */
}

.akses-icon {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: #f39c12;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    border: 4px solid #fff;
    z-index: 99;
}

.akses-image {
    width: 100%;
}

.akses-image img {
    width: 115%;
    margin-left: -7.5%;
}

.akses-title {
    font-weight: 630;
    margin-top: -2px;
    margin-bottom: 2px;
    letter-spacing: 1px;
}

.akses-body {
    font-size: 15px;
}

/* progres lanjutan */
.tahap-horizontal-wrapper {
    display: flex;
    flex-direction: row-reverse;
    gap: 0;
    border-radius: 14px;
    overflow: hidden;
    width: 100%;
    margin-top: -210px;
}

.tahap-item {
    flex: 1;
    background: #f6efe5;
    border: 1px solid #d8cfc2;
    text-align: left;
    transition: 0.3s;
}

.tahap-item:not(:last-child) {
    border-right: none;
}

.tahap-header {
    padding: 8px;
    font-weight: 700;
    color: #fff;
    text-align: center;
    font-size: 14px;
}

.tahap-body {
    padding: 12px;
    font-size: 13px;
    min-height: 80px;
}

.tahap-body ul {
    padding-left: 18px;
    margin-bottom: 6px;
}

.tahap-body ul li {
    margin-bottom: 3px;
}

.progress-note {
    background: rgba(0, 0, 0, 0.05);
    padding: -1px;
    border-radius: 6px;
    font-size: 11px;
    text-align: center;
}

/* warna header */
.bg-blue {
    background: #2c6fbb;
}

.bg-orange {
    background: #f05a28;
}

.bg-yellow {
    background: #f39c12;
}

.bg-green {
    background: #5e8d3e;
}

.bg-dark {
    background: #444;
}

/* aktif */
.tahap-item.active {
    background: #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transform: translateY(-5px);
}

/* panah tahap */
.tahap-arrow {
    text-align: center;
    margin-top: -3px;
    font-size: 28px;
    color: #2e8e80;
}

/* wrapper utama */
.tahap-with-serah {
    position: relative;
    padding-top: 171px;
    /* ruang untuk tahap 7 */
}

/* posisi floating tahap 7 */
.tahap7-floating {
    position: absolute;
    top: 0;
    left: 0;
    /* tepat di atas tahap 6 */
    width: 200px;
    text-align: center;
    z-index: 999;
}

/* lingkaran tahap 7 */
.tahap7-circle {
    width: 130px;
    height: 130px;
    margin: 0 auto;
    background: radial-gradient(circle at top, #3a4d63, #1f2b38);
    border-radius: 50%;
    color: #fff;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* icon */
.tahap7-circle i {
    font-size: 26px;
    margin-bottom: 1px;
}

/* text di dalam lingkaran */
.tahap7-text strong {
    display: block;
    font-size: 14px;
    letter-spacing: .5px;
    margin-bottom: -3px;
}

.tahap7-text span {
    font-size: 12px;
    display: block;
    margin-bottom: 1px;

}

.tahap7-text small {
    font-size: 11px;
    opacity: .85;
    margin-bottom: 31px;

}

/* Default: Desktop */
.tahap7-desktop {
    display: block;
}

.tahap7-mobile {
    display: none;
}

/* panah ke bawah */
.arrow-up {
    width: 2px;
    height: 29px;
    background: #2e8e80;
    margin: 10px auto 8px;
    position: relative;
}

.arrow-up::before {
    content: '';
    position: absolute;
    top: -8px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    border-bottom: 9px solid #2e8e80;
}

/* ================= MOBILE LAYOUT ================= */
/* tampilan tahap mobile */


/* ================= MOBILE ONLY ================= */
@media (max-width: 767px) {

    /* Jika panah berupa div */
    .premium-step .step-arrow,
    .premium-step .arrow,
    .premium-step .premium-arrow,
    .premium-step [class*="arrow"] {
        display: none !important;
    }

    /* Jika panah dibuat pakai ::after */
    .premium-step::after,
    .premium-step::before {
        display: none !important;
        content: none !important;
    }

}

@media (max-width: 767px) {

    /* Wrapper timeline geser ke kiri */
    .timeline-wrapper {
        padding-left: 15px !important;
    }

    /* Garis vertical */
    .timeline-wrapper::before {
        left: 4px !important;
        top: 18px !important;
        width: 2px !important;
    }

    /* Icon bulat */
    .timeline-icon {
        width: 28px !important;
        height: 28px !important;
        font-size: 11px !important;
        left: -24px !important;
        /* ini yang bikin mepet */
    }

    /* Kurangi padding header */
    .accordion-button {
        padding: 12px !important;
    }

    /* Header supaya lebih mepet */
    .accordion-header {
        padding-left: 10px !important;
    }

    /* Konten body lebih lega */
    .accordion-body {
        padding-left: 13px !important;
        padding-right: 13px !important;
    }

    /* Card progress supaya lebih lega */
    .progress-card {
        margin-left: 5px !important;
        margin-right: 5px !important;
    }

    .progress-content {
        display: flex !important;
        flex-direction: column !important;
    }

    .progress-text {
        width: 100% !important;
    }

    .progress-text p {
        font-size: 13px !important;
        line-height: 1.6 !important;
    }

    .progress-images {
        width: 100% !important;
        margin-top: 10px;
    }

    .progress-images img {
        width: 100% !important;
        height: auto !important;
        margin-bottom: 8px;
    }

    /* Tulisan "Tahap 1" */
    .accordion-button strong {
        font-size: 13px !important;
    }

    /* Nama tahap */
    .accordion-button {
        font-size: 13px !important;
        line-height: 1.4 !important;
        padding-right: 3px !important;
        padding-left: 3px !important;
    }

    /* Badge target */
    .accordion-button .badge {
        font-size: 11px !important;
        padding: 4px 8px !important;
    }

}

@media (max-width: 768px) {

    .tahap-horizontal-wrapper {
        display: flex;
        flex-direction: column;
        gap: 23px;
        margin-top: 0px;
        padding-top: 23px;
    }

    .tahap-item {
        width: 100%;
        position: relative;
    }

    .tahap-item::after {
        content: "";
        position: absolute;
        bottom: -18px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 18px;
        background: #2e8e80;
    }

    .tahap-item::before {
        content: "";
        position: absolute;
        bottom: -22px;
        left: 50%;
        transform: translateX(-50%) rotate(45deg);
        width: 8px;
        height: 8px;
        border-right: 2px solid #2e8e80;
        ;
        border-bottom: 2px solid #2e8e80;
        ;
        background: transparent;
    }

    /* HILANGKAN PANAH DI TAHAP TERAKHIR (6) */
    .tahap-item:last-child::after,
    .tahap-item:last-child::before {
        display: none;
    }

    /* RESET FLOATING TAHAP 7 */

    .tahap7-floating {
        position: static !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        z-index: auto !important;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tahap7-circle {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: #2f3e4e;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: 0 auto;
        text-align: center;
        padding: 10px;
    }

    .tahap7-circle i {
        font-size: 22px;
        margin-bottom: 6px;
    }

    .tahap7-circle strong {
        font-size: 13px;
    }

    .tahap7-circle span {
        font-size: 12px;
        line-height: 1.2;
    }

    .tahap7-circle small {
        font-size: 11px;
        opacity: 0.9;
        margin-top: 4px;
    }

    .tahap-item:last-child {
        position: relative;
    }

    .tahap-item:last-child::after {
        content: '';
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 24px;
        background: #2a9d8f;
    }

    .tahap-item:last-child::before {
        content: '';
        position: absolute;
        bottom: -38px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 8px solid #2a9d8f;
    }

    .tahap-item:last-child {
        position: relative;
    }

    .tahap-item:last-child::after {
        content: '';
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 24px;
        background: #2a9d8f;
    }

    .tahap-item:last-child::before {
        content: '';
        position: absolute;
        bottom: -38px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 8px solid #2a9d8f;
    }

    /* Saat Mobile */
    .tahap7-desktop {
        display: none !important;
    }

    .tahap7-mobile {
        display: flex !important;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin-top: 2px;
        position: relative;
    }
}
</style>

<main class="main-content  mt-0">
    <div class="container py-4">

        <!-- HEADER -->
        <div class="row mb-4 mt-5">
            <div class="col-lg-8">

                <h4 class="fw-bold">
                    Selamat datang, <?= $customer->nama ?>
                </h4>

                <div class="unit-box mb-3">
                    <div class="unit-title">Unit Anda</div>

                    <div class="unit-content">
                        <?php if(!empty($properti)) : ?>
                        Blok: <b><?= $properti->code ?></b>,
                        Type: <b><?= $properti->type ?> m<sup>2</sup></b>,
                        Luas: <b><?= $properti->ukuran ?> m<sup>2</sup></b>,
                        Perumahan: <b><?= $properti->nama_perumahan ?></b>
                        <?php else: ?>
                        Data properti belum tersedia
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                    $persen = (!empty($progress)) ? $progress->persen : 0;

                    if ($persen < 30) {
                        $warna = '#dc3545'; // merah
                    } elseif ($persen < 70) {
                        $warna = '#ffc107'; // kuning
                    } elseif ($persen < 85) {
                        $warna = '#198754'; // hijau
                    } else {
                        $warna = '#cc0c9f'; //ungu
                    }
                ?>
                <div class="mb-3">
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: <?= $persen ?>%; background: <?= $warna ?>;">
                            <span class="progress-text">
                                Progres Bangunan : <?= $persen ?>%
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- PROFILE MARKETING CARD -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">

                        <h6 class="mb-3 text-center"><b>Marketing</b></h6>

                        <div class="d-flex align-items-center">

                            <!-- FOTO -->
                            <div class="me-3">
                                <?php if(!empty($marketing->foto)) : ?>
                                <img src="<?= base_url('upload/foto_marketing/'.$marketing->foto) ?>"
                                    class="rounded-circle shadow" width="80" height="80" style="object-fit:cover;">
                                <?php else: ?>
                                <img src="<?= base_url('assets/img/default-user.png') ?>" class="rounded-circle shadow"
                                    width="80" height="80">
                                <?php endif; ?>
                            </div>

                            <!-- INFO -->
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold text-dark">
                                    <?= !empty($marketing->nama) ? $marketing->nama : 'Belum ada marketing' ?>
                                </h6>

                                <small class="text-muted d-block">
                                    <i class="fa-solid fa-circle-plus me-1"></i>
                                    <?= !empty($marketing->email) ? $marketing->email : '-' ?>
                                </small>

                                <?php if(!empty($marketing->no_tlp)) : ?>
                                <div class="mt-1 text-success fw-semibold">
                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    +62<?= $marketing->no_tlp ?>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <?php if(!empty($marketing->email)) : ?>
                        <div class="row mt-2 mb-0">

                            <!-- EMAIL -->
                            <div class="col-6">
                                <a href="mailto:<?= $marketing->email ?>"
                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-1 m-0 p-0">
                                    <i class="fa-solid fa-envelope"></i>
                                    Email
                                </a>
                            </div>

                            <!-- WHATSAPP -->
                            <div class="col-6">
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $marketing->no_tlp) ?>"
                                    target="_blank"
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-1 m-0 p-0">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    WhatsApp
                                </a>
                            </div>

                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="glass-tab-wrapper position-relative mb-3">

            <div class="tab-indicator"></div>

            <ul class="nav glass-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tahap">Tahap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#timeline">Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#dokumen">Profil Unit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kontak">Kontak</a>
                </li>
            </ul>

        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tahap">
                <div class="accordion timeline-wrapper" id="accordionTahap">

                    <?php if(!empty($tahap)) : ?>
                    <?php foreach($tahap as $i => $t) : ?>

                    <div class="accordion-item timeline-item active mb-3 border-0">
                        <h2 class="accordion-header position-relative">

                            <!-- ICON -->
                            <div class="timeline-icon <?= $i == 0 ? 'active' : '' ?>">
                                <i class="fa-solid fa-helmet-safety"></i>
                            </div>

                            <button class="accordion-button <?= $i != 0 ? 'collapsed' : '' ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $t->id_tahap ?>">

                                <strong class="me-2">Tahap <?= $t->urutan ?></strong>
                                <?= $t->nama_tahap ?>

                                <span class="badge bg-success ms-auto">
                                    TARGET <?= $t->persen_target ?>%
                                </span>
                            </button>
                        </h2>

                        <div id="collapse<?= $t->id_tahap ?>"
                            class="accordion-collapse collapse <?= $i == 0 ? 'show' : '' ?>"
                            data-bs-parent="#accordionTahap">

                            <div class="accordion-body pt-4">

                                <?php if(!empty($t->progress)) : ?>
                                <?php foreach($t->progress as $p) : ?>

                                <div class="progress-card mb-4">

                                    <p class="mb-2">
                                        <strong>Periode:</strong>
                                        <?= date('d/m/Y', strtotime($p->start_date)) ?>
                                        -
                                        <?= date('d/m/Y', strtotime($p->end_date)) ?>
                                    </p>
                                    <div class="progress-content">
                                        <!-- KIRI -->
                                        <div class="progress-text">
                                            <p><?= $p->deskripsi ?></p>
                                        </div>

                                        <!-- KANAN -->
                                        <div class="progress-images">
                                            <?php foreach($p->foto as $f) : ?>
                                            <img src="<?= base_url('upload/foto_progres/'.$f->file_foto) ?>"
                                                class="img-fluid rounded shadow-sm preview-img" style="cursor:pointer;">
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                                <?php else : ?>

                                <div class="text-muted">
                                    Belum ada progress pada tahap ini.
                                </div>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                    <?php endforeach; ?>
                    <?php else : ?>

                    <div class="card shadow-sm">
                        <div class="card-body text-muted">
                            Data tahap belum tersedia.
                        </div>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
            <div class="tab-pane fade" id="timeline">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <!-- ================= PREMIUM TOP TIMELINE ================= -->
                        <div class="premium-timeline">

                            <!-- STEP 1 : BOOKING / UTJ -->
                            <div class="premium-step <?= $utj ? 'done' : '' ?>">
                                <div class="step-badge green">Booking Unit</div>

                                <div class="step-content">
                                    <div class="step-icon bg-green">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>

                                    <h5>Booking Unit</h5>

                                    <?php if($utj): ?>
                                    <p class="small text-muted mb-1">
                                        <?= date('d F Y', strtotime($utj->tgl_trans)) ?>
                                    </p>
                                    <p class="fw-bold text-success">
                                        Rp <?= number_format($utj->nominal,0,',','.') ?>
                                    </p>
                                    <?php else: ?>
                                    <p class="text-muted">Menunggu Booking</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- STEP 2 : DP -->
                            <div class="premium-step <?= $data_dp ? 'done' : '' ?>">
                                <div class="step-badge blue">Pembayaran DP</div>

                                <div class="step-content">
                                    <div class="step-icon bg-blue">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>

                                    <h5>Pembayaran DP</h5>

                                    <?php if($data_dp): ?>
                                    <p class="small text-muted mb-1">
                                        <?= date('d F Y', strtotime($data_dp->tgl_terakhir)) ?>
                                    </p>
                                    <p class="fw-bold text-primary">
                                        Rp <?= number_format($data_dp->total_dp,0,',','.') ?>
                                    </p>
                                    <?php else: ?>
                                    <p class="text-muted">Belum DP</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- STEP 3 : AKUN LOGIN -->
                            <div class="premium-step <?= $customer ? 'done' : '' ?>">
                                <div class="step-badge dark">Akun Login Pemilik</div>

                                <div class="step-content">
                                    <div class="step-icon bg-dark">
                                        <i class="fas fa-user-check"></i>
                                    </div>

                                    <h5>Akun Aktif</h5>

                                    <?php if($customer): ?>
                                    <p class="small text-muted">
                                        Dibuat <?= date('d F Y', strtotime($customer->dibuat)) ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- STEP 4 : AKSES PROGRES -->
                            <div class="premium-step <?= !empty($progress_unit) ? 'done' : '' ?>">
                                <div class="step-badge orange">Akses Progres</div>

                                <?php if(!empty($master_tahap)): ?>
                                <?php
                                    $tahap1 = $master_tahap[0];
                                ?>

                                <?php
                                    $tahap1 = null;

                                    foreach ($master_tahap as $mt) {
                                        if ($mt->urutan == 1) {
                                            $tahap1 = $mt;
                                            break;
                                        }
                                    }

                                    $progress_tahap1 = isset($progress_by_tahap[$tahap1->id_tahap])
                                        ? $progress_by_tahap[$tahap1->id_tahap]
                                        : null;
                                    ?>
                                <div class="akses-outer">
                                    <div class="akses-card">
                                        <!-- ICON ATAS -->
                                        <div class="akses-icon">
                                            <i class="fas fa-hard-hat"></i>
                                        </div>
                                        <!-- GAMBAR RUMAH -->
                                        <div class="akses-image">
                                            <img src="<?= base_url('assets/img/rumah.png') ?>" alt="Rumah">
                                        </div>
                                        <!-- CONTENT -->
                                        <div class="akses-content">
                                            <h6 class="akses-title">
                                                TAHAP <?= $tahap1->urutan ?>
                                            </h6>
                                            <div class="akses-body">
                                                <p class="fw-bold mb-1">
                                                    <?= $tahap1->nama_tahap ?>
                                                </p>
                                                <?php if($progress_tahap1 && $progress_tahap1->start_date && $progress_tahap1->end_date): ?>
                                                <p class="small text-muted mb-1">
                                                    <?= date('d M Y', strtotime($progress_tahap1->start_date)) ?>
                                                    -
                                                    <?= date('d M Y', strtotime($progress_tahap1->end_date)) ?>
                                                </p>
                                                <?php else: ?>
                                                <p class="small text-muted">
                                                    Belum dimulai
                                                </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- PANAH KE BAWAH -->
                                    <div class="tahap-arrow">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ================= TAHAP PEMBANGUNAN ================= -->

                        <div class="tahap-area">
                            <?php
                            // ================= AMBIL TAHAP 7 =================
                            $tahap7 = null;

                            if (!empty($master_tahap)) {
                                foreach ($master_tahap as $mt) {
                                    if ((int)$mt->urutan === 7) {
                                        $tahap7 = $mt;
                                        break;
                                    }
                                }
                            }

                            // tanggal serah terima (created_ad)
                                $progress7 = null;

                                if ($tahap7 && isset($progress_by_tahap[$tahap7->id_tahap])) {
                                    $progress7 = $progress_by_tahap[$tahap7->id_tahap];
                                }

                                $tanggal_serah = ($progress7 && $progress7->created_at)
                                    ? date('d M Y', strtotime($progress7->created_at))
                                    : null;
                            ?>

                            <div class="tahap-horizontal-wrapper tahap-with-serah">

                                <!-- TAHAP 7 (SERAH TERIMA) -->

                                <!-- TAHAP 7 DESKTOP -->
                                <?php if($tahap7): ?>
                                <div class="tahap7-floating tahap7-desktop">

                                    <div class="tahap7-circle">
                                        <i class="fas fa-key"></i>

                                        <div class="tahap7-text">
                                            <strong>TAHAP 7</strong>
                                            <span>Serah Terima Kunci</span>
                                            <?php if($tanggal_serah): ?>
                                            <small><?= $tanggal_serah ?></small>
                                            <?php else: ?>
                                            <div class="progress-note text-gray">
                                                Belum dijadwalkan
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="arrow-up"></div>
                                </div>
                                <?php endif; ?>

                                <!-- ================= TAHAP 2–6 ================= -->
                                <?php foreach ($master_tahap as $t): ?>
                                <?php if ($t->urutan == 1 || $t->urutan == 7) continue; ?>

                                <?php
                                    $progress = $progress_by_tahap[$t->id_tahap] ?? null;

                                    if (!$progress) {
                                        $warna = 'bg-gray';
                                        $textClass = 'text-dark';
                                    } else {
                                        $textClass = 'text-white';
                                        switch ($t->urutan) {
                                            case 2: $warna = 'bg-blue'; break;
                                            case 3: $warna = 'bg-orange'; break;
                                            case 4: $warna = 'bg-yellow'; break;
                                            case 5: $warna = 'bg-green'; break;
                                            case 6: $warna = 'bg-dark'; break;
                                            default: $warna = 'bg-gray';
                                        }
                                    }
                                ?>

                                <div class="tahap-item <?= $progress ? 'active' : '' ?>">
                                    <div class="tahap-header <?= $warna ?> <?= $textClass ?>">
                                        TAHAP <?= $t->urutan ?>
                                    </div>
                                    <div class="tahap-body">
                                        <ul>
                                            <li><?= $t->nama_tahap ?></li>
                                        </ul>

                                        <?php if($progress && $progress->start_date && $progress->end_date): ?>
                                        <div class="progress-note">
                                            <?= date('d M Y', strtotime($progress->start_date)) ?>
                                            -
                                            <?= date('d M Y', strtotime($progress->end_date)) ?>
                                        </div>
                                        <?php else: ?>
                                        <div class="progress-note text-muted">
                                            Belum dijadwalkan
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php endforeach; ?>

                                <!-- TAHAP 7 (SERAH TERIMA) -->

                                <!-- TAHAP 7 MOBILE -->
                                <?php if($tahap7): ?>
                                <div class="tahap7-floating tahap7-mobile">

                                    <div class="arrow-down"></div>

                                    <div class="tahap7-circle">
                                        <i class="fas fa-key"></i>

                                        <div class="tahap7-text">
                                            <strong>TAHAP 7</strong>
                                            <span>Serah Terima Kunci</span>
                                            <?php if($tanggal_serah): ?>
                                            <small><?= $tanggal_serah ?></small>
                                            <?php else: ?>
                                            <div class="progress-note text-gray">
                                                Belum dijadwalkan
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="dokumen">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <?php if (!empty($foto_unit)): ?>

                        <div id="lightgallery" class="row g-3">

                            <?php foreach ($foto_unit as $f): ?>

                            <?php
                                $img = base_url('upload/foto_unit/'.$f->foto);
                            ?>

                            <div class="col-md-3 col-6">
                                <a href="<?= $img ?>" data-lg-size="1400-900">

                                    <img src="<?= $img ?>" class="img-fluid rounded shadow-sm"
                                        style="height:150px; object-fit:cover; width:100%;">
                                </a>
                            </div>

                            <?php endforeach; ?>

                        </div>

                        <?php else: ?>

                        <div class="text-muted text-center py-3">
                            Belum ada foto unit
                        </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="kontak">
                <div class="card shadow-sm">
                    <div class="card-body p-1">
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                            <div class="avatar me-3">
                                <?php if(!empty($customer->foto_profil)) : ?> <img
                                    src="<?= base_url('upload/foto_customer/'.$customer->foto_profil) ?>" alt="kal"
                                    class="border-radius-lg shadow">
                                <?php else: ?> <img src="<?= base_url('assets/img/default-user.png') ?>" alt="kal"
                                    class="border-radius-lg shadow" width="80"> <?php endif; ?>

                                <!-- <img src="../assets/img/kal-visuals-square.jpg" > -->
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm mb-1 text-success fw-semibold"><b><?= $customer->nama ?></b>
                                </h6>
                                <p class="mb-0 text-xs mb-1">
                                    <i class="fa-solid fa-envelope me-2 text-primary"></i>
                                    <?= $customer->email ?>
                                </p>

                                <p class="mb-0 text-xs mb-1">
                                    <i class="fa-solid fa-phone me-2 text-success"></i>
                                    <?= $customer->telepon ?>
                                </p>

                                <p class="mb-0 text-xs mb-1">
                                    <i class="fa-solid fa-location-dot me-2 text-danger"></i>
                                    <?= $customer->domisili ?>
                                </p>

                                <p class="mb-0 text-xs mb-1">
                                    <i class="fa-solid fa-calendar-days me-2 text-warning"></i>
                                    <?= date('d/m/Y', strtotime($customer->dibuat)) ?>
                                </p>
                            </div>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $customer->telepon) ?>"
                                target="_blank" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                <i class="fa-brands fa-whatsapp fa-xl"></i>
                            </a>

                        </li>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
</main>

<!-- PREMIUM GALLERY MODAL -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark border-0">

            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body d-flex align-items-center justify-content-center position-relative">

                <!-- Prev Button -->
                <button class="gallery-nav prev-btn">&#10094;</button>

                <!-- Image -->
                <img id="galleryImage" class="img-fluid gallery-img">

                <!-- Next Button -->
                <button class="gallery-nav next-btn">&#10095;</button>

            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {

    const tabs = document.querySelectorAll(".glass-tabs .nav-link");
    const indicator = document.querySelector(".tab-indicator");

    function moveIndicator(el) {
        indicator.style.width = el.offsetWidth + "px";
        indicator.style.left = el.offsetLeft + "px";
    }

    // Set posisi awal
    const activeTab = document.querySelector(".glass-tabs .nav-link.active");
    if (activeTab) moveIndicator(activeTab);

    tabs.forEach(tab => {
        tab.addEventListener("click", function() {
            setTimeout(() => {
                moveIndicator(this);
            }, 50);
        });
    });

    // Responsive support
    window.addEventListener("resize", function() {
        const active = document.querySelector(".glass-tabs .nav-link.active");
        if (active) moveIndicator(active);
    });

});

// preview gambar

document.addEventListener("DOMContentLoaded", function() {

    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    const galleryImage = document.getElementById('galleryImage');

    let currentImages = [];
    let currentIndex = 0;

    function showImage(index) {
        galleryImage.style.opacity = 0;
        setTimeout(() => {
            galleryImage.src = currentImages[index].src;
            galleryImage.style.opacity = 1;
        }, 150);
    }

    document.querySelectorAll('.preview-img').forEach(img => {

        img.addEventListener('click', function() {

            const container = this.closest('.progress-images');

            currentImages = container.querySelectorAll('.preview-img');

            currentIndex = Array.from(currentImages).indexOf(this);

            showImage(currentIndex);
            modal.show();
        });

    });

    document.querySelector('.next-btn').addEventListener('click', function() {
        if (currentImages.length === 0) return;
        currentIndex = (currentIndex + 1) % currentImages.length;
        showImage(currentIndex);
    });

    document.querySelector('.prev-btn').addEventListener('click', function() {
        if (currentImages.length === 0) return;
        currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
        showImage(currentIndex);
    });

});

document.addEventListener("DOMContentLoaded", function() {

    const gallery = document.getElementById("lightgallery");

    if (gallery) {
        lightGallery(gallery, {
            selector: 'a',
            plugins: [lgZoom, lgThumbnail],
            speed: 500
        });
    }

});
</script>