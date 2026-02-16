<style>
.flatpickr-calendar {
    z-index: 9999 !important;
}

.timeline-wrapper {
    width: 90%;
    margin: auto;
}

/* ======================
   GRID
====================== */

.timeline-row {
    display: grid;
    grid-template-columns: 1fr 120px 1fr;
    align-items: stretch;
    margin-bottom: 3px;
}

/* ======================
   TENGAH
====================== */

.timeline-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.circle {
    background: #3f6fd8;
    color: #fff;
    width: 120px;
    padding: 10px 0;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    z-index: 3;

    /* ⬇️ INI KUNCI */
    margin-bottom: -2px;
    /* jarak ke garis */
    transform: none;
    /* pastikan tidak geser */
    position: relative;
    left: 0;
}

.circle:hover {
    transform: scale(1.05);
    transition: 0.2s;
}

.tahap-click {
    cursor: pointer;
    transition: all 0.2s ease;
}

.tahap-click:hover {
    background: #2f5ed7;
    transform: scale(1.05);
}

.date {
    font-size: 12px;
    margin: 6px 0;
    color: #555;
}

/* garis vertikal */
.line {
    width: 2px;
    height: 140px;
    background: #3f6fd8;
    flex-grow: 1;
    margin-top: 0px;
}

/* ================================
   CONNECTOR DARI LABEL KE TAHAP
================================ */

/* STEP KIRI */
.left-step .timeline-left::after {
    content: "";
    position: absolute;
    top: 26px;
    right: -4%;
    width: 15%;
    border-top: 2px dashed #3f6fd8;
}

/* STEP KANAN */
.right-step .timeline-right::before {
    content: "";
    position: absolute;
    top: 26px;
    left: -4%;
    width: 15%;
    border-top: 2px dashed #3f6fd8;
}

.left-step .timeline-left {
    text-align: right;
}

.right-step .timeline-right {
    text-align: left;
}


/* ======================
   KIRI & KANAN
====================== */

.timeline-left,
.timeline-right {
    position: relative;
}

.step-title {
    background: #3f6fd8;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 6px;
    font-size: 14px;

    text-align: center;
}

.step-title-kanan {
    background: #3f6fd8;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 6px;
    font-size: 14px;

    text-align: center;
}

/* LIST PROGRESS STEP KIRI */
.left-step .timeline-left ul {
    padding-left: 0px;
    padding-right: 0px;
}

/* LIST PROGRESS STEP KANAN (tetap normal) */
.right-step .timeline-right ul {
    padding-left: 0px;
    padding-right: 0;
}

.step-box {
    /* display: flex;*/
    flex-direction: column;
    align-items: center;
    padding-top: 11px;
    padding-right: 46px;
}

.step-box-kanan {
    /* display: flex;*/
    flex-direction: column;
    align-items: center;
    padding-top: 11px;
    padding-left: 46px;
}

.no-progress {
    font-style: italic;
    margin-top: 6px;
    color: #777;
}

.timeline-list {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
}

.timeline-item-kiri {
    display: grid;
    grid-template-columns: 1fr 14px;
    /* content | bullet */
    column-gap: 10px;
    align-items: start;
    width: 100%;
    padding: 4px 0;
    text-align: right;
}

.timeline-date {
    font-size: 12px;
    color: #6c757d;
    white-space: nowrap;
    flex-shrink: 0;
    line-height: 1.4;
}

.line {
    width: 3px;
    background: #3f6fd8;
    flex-grow: 1;
    margin-top: 8px;
}

/* PROGRESS TERBARU */
.progress-new {
    color: #198754;
    /* hijau bootstrap */
    font-weight: 600;
}

/* PROGRESS LAMA */
.progress-old {
    color: #dc3545;
    /* merah bootstrap */
    opacity: 0.85;
}

/* =====================================
   ITEM KIRI (MIRROR SISI KANAN)
===================================== */

/* CONTENT */
.progress-content-kiri {
    max-width: 100%;
}

/* BULLET DI KANAN */
.bullet-kiri {
    grid-column: 2;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-top: 6px;
}

/* =============================
   MINGGU
============================= */
.progress-content-kiri .minggu {

    font-weight: 600;
    font-size: 14px;
    text-align: center;
    margin-bottom: 4px;
}

/* =============================
   TANGGAL (beri jarak)
============================= */
.tanggal-inline-kiri {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 6px;
    font-size: 13px;
}

/* =============================
   DESKRIPSI (perlebar kanan)
============================= */

.timeline-item-kiri .progress-row-kiri.deskripsi-kiri {
    font-size: 13px;
    line-height: 1.6;
    font-weight: 600;
}

/* WARNA BULLET */
.timeline-item-kiri.progress-new .bullet-kiri {
    background: #198754;
}

.timeline-item-kiri.progress-old .bullet-kiri {
    background: #dc3545;
}

/* BULLET */
.progress-new::before {
    background: #198754;
}

.progress-old::before {
    background: #dc3545;
}

/* === LIST ITEM KANAN === */

.timeline-item-kanan {
    display: grid;
    grid-template-columns: 10px 1fr;
    /* bullet | konten */
    column-gap: 8px;
    align-items: start;
    padding: 2px 0;
}

/* BULLET */
.timeline-item-kanan .bullet {
    width: 8px;
    height: 8px;
    background: #198754;
    border-radius: 50%;
    margin-top: 6px;
}

/* CONTENT */
.progress-content {
    width: 100%;
}

/* BARIS UMUM */
.progress-row {
    font-size: 13px;
    line-height: 1.4;
}

/* MINGGU */
.progress-row.minggu {
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    margin-bottom: 4px;
}

/* MULAI + SELESAI SEJAJAR */
.progress-row.tanggal-inline {
    display: flex;
    justify-content: space-between;
    /* 🔥 kiri & kanan */
    align-items: center;
    width: 100%;
    margin-bottom: 6px;
    font-size: 13px;
}


/* DESKRIPSI */
.progress-row.deskripsi {
    font-size: 13px;
    margin-top: 2px;
}

.progress-info-green {
    background: rgba(40, 167, 69, 0.12);
    border-left: 5px solid #28a745;
    backdrop-filter: blur(4px);
    border-radius: 12px;
    padding: 1.5rem;
}

.timeline-item-kanan.progress-new .bullet {
    background: #198754;
}

.timeline-item-kanan.progress-old .bullet {
    background: #dc3545;
}

/* akhir data progres */

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: 0 5px;
    display: grid;
}

.label-select {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.label-select2 {
    color: #4B49AC;
    font-size: 8px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 63px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transform: translateY(-25px);
}

.label-select {
    color: #CB0C9F;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.label-select2 {
    color: #CB0C9F;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 25px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.label-in {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

input,
select,
textarea {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

input:invalid+label,
select:invalid+label,
textarea:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

input:focus,
select:focus,
textarea:focus {
    border-color: #21A8FD;
}

input:focus+label,
select:focus+label,
textarea:focus+label {
    color: #CB0C9F;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.select2-container {
    z-index: 10000
}

.select2-container--default .select2-selection--single {
    height: 40px;
    border: 1px solid #ced4da;
    border-radius: 9px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.flash-animation {
    animation: fadeIn 0.5s ease-in-out;
}

.progress-click {
    cursor: pointer;
}

.progress-click:hover {
    opacity: 0.8;
    text-decoration: underline;
}

.modal-body img {
    cursor: zoom-in;
}

.modal-body img {
    height: 220px;
    object-fit: cover;
}

/* =========================
   RESPONSIVE SCALE TIMELINE
========================= */

.timeline-wrapper {
    width: 98%;
    max-width: 1200px;
    font-size: clamp(12px, 1vw, 14px);
    margin: 0 auto;
    transform-origin: top center;
}

@media (max-width: 1400px) {
    .timeline-wrapper {
        transform: scale(calc(100vw / 1400));
    }
}

body {
    overflow-x: hidden;
}

@media (max-width: 1200px) {
    .timeline-wrapper {
        transform: scale(0.8);
        transform-origin: top center;
    }
}

@media (max-width: 992px) {
    .timeline-wrapper {
        transform: scale(0.7);
        transform-origin: top center;
    }
}

/* =========================
   MOBILE STABLE VERSION
========================= */

@media (max-width: 768px) {

    .timeline-item-kanan,
    .timeline-item-kiri {
        gap: 6px;
    }

}

@media (max-width: 768px) {

    .timeline-wrapper {
        width: 100%;
        /* max-width: 1700px; */
        max-width: 100vw;
        margin-left: calc(-50vw + 50%);
        padding-left: 0;
        padding-right: 0;

    }

    .timeline-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;

    }

    .step-box {
        width: 100%;
        padding-right: 30px !important;
        padding-top: 0px !important;
        flex-direction: column;
        align-items: center;
    }

    .step-box-kanan {
        width: 100%;
        flex-direction: column;
        align-items: center;
        padding-left: 30px !important;
        padding-top: 0px !important;
    }

    .timeline-row {
        display: grid;
        grid-template-columns: 1fr 40px 1fr;
        align-items: stretch;
    }

    .timeline-left,
    .timeline-right {
        min-width: 0;
    }

    .circle {
        width: 80px;
        font-size: 12px;
        padding: 2px 0;
    }

    .date {
        font-size: 9px;
        text-align: center;
    }

    .step-title,
    .step-title-kanan {
        font-size: 11px;
        padding: 0px 0px;
    }

    .progress-row,
    .progress-row-kiri {
        font-size: 9px;
    }

    .progress-row.minggu,
    .minggu {
        font-size: 10px;
        line-height: 1.3;
    }

    .progress-content-kiri {
        width: 100%;
    }

    .progress-content {
        width: 246%;
    }

    .bullet,
    .bullet-kiri {
        width: 6px;
        height: 6px;
    }

    .timeline-item-kiri {
        display: flex;
        justify-content: flex-start !important;
        /* bukan flex-end */

    }

    .timeline-item-kanan {
        padding-right: 0;
        gap: 2px;
    }

    .timeline-left {
        padding-left: 0;
        position: relative;
        min-width: 0;
    }

    .timeline-right {
        padding-right: 0;
        position: relative;
        min-width: 0;
    }

    .line {
        width: 2px;
        height: 140px;
        background: #3f6fd8;
        flex-grow: 1;
        margin-top: 0px;
    }

    .circle {
        margin-bottom: 8px;
    }

    .right-step .timeline-right::before {
        content: "";
        position: absolute;
        top: 11px;
        left: 1%;
        width: 15%;
        border-top: 2px dashed #3f6fd8;
    }

    .left-step .timeline-left::after {
        content: "";
        position: absolute;
        top: 10px;
        right: 1%;
        width: 15%;
        border-top: 2px dashed #3f6fd8;
    }

    /* LIST PROGRESS STEP KIRI */
    .left-step .timeline-left ul {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    /* LIST PROGRESS STEP KANAN (tetap normal) */
    .right-step .timeline-right ul {
        padding-left: 0px;
        padding-right: 0;
    }
}
</style>

<?php
$lastActiveTahap = 0;
foreach ($timeline as $row) {
    if (!empty($row['progress'])) {
        $lastActiveTahap = max($lastActiveTahap, $row['urutan']);
    }
}
?>

<?php if (!empty($timeline)): ?>
<div class="timeline-wrapper">
    <?php foreach ($timeline as $i => $t): ?>
    <?php $isLeft = $i % 2 !== 0; ?>

    <div class="timeline-row <?= $isLeft ? 'left-step' : 'right-step'; ?>">

        <!-- KIRI -->
        <div class="timeline-left">
            <?php if ($isLeft): ?>
            <div class="step-box">
                <div class="step-title"><?= $t['nama_tahap']; ?></div>

                <?php if (!empty($t['progress'])): ?>
                <ul class="timeline-list">
                    <?php foreach ($t['progress'] as $p): ?>
                    <!-- KODE MERUBAH WARNA PROGRES YANG SUDAH SELESAI MAUPUN BELUM -->
                    <?php
                    $isFinishedTahap = $t['urutan'] < $lastActiveTahap;

                    if ($isFinishedTahap) {
                        $progressClass = 'progress-old';
                    } else {
                        $progressClass = ($p['id_progress'] == $t['last_progress_id'])
                            ? 'progress-new'
                            : 'progress-old';
                    }
                ?>

                    <!-- KODE PREVIEW GAMBAR -->
                    <?php
                    $hasFoto = !empty($p['foto']);
                    $fotoUtama = $hasFoto
                        ? base_url('upload/foto_progres/' . $p['foto'][0]['file_foto'])
                        : '';
                ?>

                    <li class="timeline-item-kiri progress-click <?= $progressClass; ?>" data-images='<?= json_encode(array_map(function($f){
                    return base_url("upload/foto_progres/".$f["file_foto"]);
                    }, $p["foto"] ?? []), JSON_HEX_APOS | JSON_HEX_QUOT); ?>'
                        data-minggu="Minggu Ke : <?= $p['minggu_ke']; ?>"
                        data-mulai="<?= date('d/m/Y', strtotime($p['start_date'])); ?>"
                        data-selesai="<?= date('d/m/Y', strtotime($p['end_date'])); ?>"
                        data-deskripsi="<?= htmlspecialchars($p['deskripsi'], ENT_QUOTES); ?>">


                        <div class="progress-content-kiri">
                            <div class="progress-row-kiri minggu">
                                Minggu Ke : <?= $p['minggu_ke']; ?>
                            </div>

                            <div class="progress-row-kiri tanggal-inline-kiri">
                                <span>Mulai : <?= date('d/m/Y', strtotime($p['start_date'])); ?></span>
                                <span>Selesai : <?= date('d/m/Y', strtotime($p['end_date'])); ?></span>
                            </div>

                            <div class="progress-row-kiri deskripsi-kiri">
                                <?= $p['deskripsi']; ?>
                            </div>
                        </div>

                        <div class="bullet-kiri"></div>

                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="no-progress">Belum ada progres</div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- TENGAH -->
        <div class="timeline-center">
            <div class="circle tahap-click" data-id-tahap="<?= $t['id_tahap']; ?>" data-id-unit="<?= $id_unit; ?>">
                Tahap <?= $t['urutan']; ?>
            </div>

            <?php if (!empty($t['created_at'])): ?>
            <span class="date"><?= date('d F Y', strtotime($t['created_at'])); ?></span>
            <?php endif; ?>

            <?php if ($i < count($timeline) - 1): ?>
            <div class="line"></div>
            <?php endif; ?>
        </div>

        <!-- KANAN -->
        <div class="timeline-right">
            <?php if (!$isLeft): ?>
            <div class="step-box-kanan">
                <div class="step-title-kanan"><?= $t['nama_tahap']; ?></div>

                <?php if (!empty($t['progress'])): ?>
                <ul class="timeline-list">
                    <?php foreach ($t['progress'] as $p): ?>
                    <?php
                    $isFinishedTahap = $t['urutan'] < $lastActiveTahap;

                    if ($isFinishedTahap) {
                        $progressClass = 'progress-old';
                    } else {
                        $progressClass = ($p['id_progress'] == $t['last_progress_id'])
                            ? 'progress-new'
                            : 'progress-old';
                    }
                ?>

                    <!-- KODE PREVIEW GAMBAR -->
                    <?php
                    $hasFoto = !empty($p['foto']);
                    $fotoUtama = $hasFoto
                        ? base_url('upload/foto_progres/' . $p['foto'][0]['file_foto'])
                        : '';
                ?>

                    <li class="timeline-item-kanan progress-click <?= $progressClass; ?>" data-images='<?= json_encode(array_map(function($f){
                    return base_url("upload/foto_progres/".$f["file_foto"]);
                    }, $p["foto"] ?? []), JSON_HEX_APOS | JSON_HEX_QUOT); ?>'
                        data-minggu="Minggu Ke : <?= $p['minggu_ke']; ?>"
                        data-mulai="<?= date('d/m/Y', strtotime($p['start_date'])); ?>"
                        data-selesai="<?= date('d/m/Y', strtotime($p['end_date'])); ?>"
                        data-deskripsi="<?= htmlspecialchars($p['deskripsi'], ENT_QUOTES); ?>">

                        <div class="bullet"></div>

                        <div class="progress-content">
                            <div class="progress-row minggu">
                                Minggu Ke : <?= $p['minggu_ke']; ?>
                            </div>

                            <div class="progress-row tanggal-inline">
                                <span>Mulai : <?= date('d/m/Y', strtotime($p['start_date'])); ?></span>
                                <span>Selesai : <?= date('d/m/Y', strtotime($p['end_date'])); ?></span>
                            </div>

                            <div class="progress-row deskripsi">
                                <?= $p['deskripsi']; ?>
                            </div>
                        </div>

                    </li>

                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="no-progress">Belum ada progres</div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>

    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="text-center text-muted mt-3">
    Belum ada progres
</div>
<?php endif; ?>