<style>
.timeline-wrapper {
    width: 90%;
    margin: auto;
}

/* ======================
   GRID
====================== */

.timeline-row {
    display: grid;
    grid-template-columns: 42% 16% 42%;
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
    right: -120px;
    width: calc(50% - 20px);
    border-top: 2px dashed #3f6fd8;
}

/* STEP KANAN */
.right-step .timeline-right::before {
    content: "";
    position: absolute;
    top: 26px;
    left: -120px;
    width: calc(50% - 20px);
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
    min-height: 60px;
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
    padding-left: 93px;
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

.timeline-item {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    /* 🔥 PENTING */
    gap: 12px;
    padding: 1px 0 1px 18px;
    width: 100%;
}

.timeline-item::before {
    content: "";
    position: absolute;
    left: 0;
    top: 6px;
    /* sejajar baris pertama */
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.timeline-date {
    font-size: 12px;
    color: #6c757d;
    white-space: nowrap;
    flex-shrink: 0;
    line-height: 1.4;
}

.desc {
    font-size: 13px;
    flex: 1;
    text-align: right;
    font-weight: 500;
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
    grid-template-columns: 14px auto 1fr;
    align-items: start;
    column-gap: 10px;
    padding: 1px 0;
    width: 100%;
    box-sizing: border-box;
    position: relative;
}

.timeline-item-kanan::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    /* background: #3f6fd8; */
    /* default */
    margin-top: 2px;
}


/* TANGGAL */
.timeline-item-kanan .timeline-date-kanan {
    font-size: 12px;
    color: #6c757d;
    white-space: nowrap;
    /* tanggal tidak turun */
    flex-shrink: 0;
    /* jangan mengecil */
    text-align: left;
}

/* DESKRIPSI */
.timeline-item-kanan .desc-kanan {
    font-weight: 500;
    font-size: 13px;
    text-align: left;
    /* PENTING */
    line-height: 1.4;
    flex: 1;
    /* ambil sisa ruang */
    word-break: break-word;
    /* aman kalau panjang */
}

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
<?php foreach ($timeline as $i => $t): ?>
<?php $isLeft = $i % 2 != 0; ?>

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


                <li class="timeline-item progress-click <?= $progressClass; ?>" data-images='<?= json_encode(array_map(function($f){
                        return base_url("upload/foto_progres/".$f["file_foto"]);
                    }, $p["foto"] ?? [])); ?>'>
                    <span class="timeline-date">
                        <?= date('d M Y', strtotime($p['created_at'])); ?>
                    </span>
                    <span class="desc"><?= $p['deskripsi']; ?></span>
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
                    }, $p["foto"] ?? [])); ?>'>

                    <span class="timeline-date-kanan">
                        <?= date('d M Y', strtotime($p['created_at'])); ?>
                    </span>
                    <span class="desc-kanan"><?= $p['deskripsi']; ?></span>
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
<?php else: ?>
<div class="text-center text-muted mt-3">
    Belum ada progres
</div>
<?php endif; ?>