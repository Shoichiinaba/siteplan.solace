<div class="timeline-wrapper mt-3" id="timeline-container">
    <?php
    // 🔥 FIRST LOAD DARI PHP
    $this->load->view('page/progres/_timeline', [
        'timeline' => $timeline,
        'id_unit'  => $id_unit
    ]);
    ?>
</div>


<!-- Modal simpan-->
<div class=" modal fade" id="tambah-progres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Progres</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="input-survey">
                <div class="modal-body">
                    <input type="hidden" id="id-unit" name="id_unit">
                    <input type="hidden" id="id-tahap" name="id_tahap">
                    <div class="row mb-1 mt-3">
                        <div class="row mb-3 mt-3">
                            <div class="col-md-6 p-0 m-0">
                                <div class="input-wrapper">
                                    <label class="label-select">Minggu Ke</label>
                                    <select type="text" id="minggu-ke" class="col-lg-12">
                                        <option value="">Pilih Minggu Ke</option>
                                        <option value="1">Minggu Ke-1</option>
                                        <option value="2">Minggu Ke-2</option>
                                        <option value="3">Minggu Ke-3</option>
                                        <option value="4">Minggu Ke-4</option>
                                        <option value="5">Minggu Ke-5</option>
                                        <option value="1">Minggu Ke-6</option>
                                        <option value="2">Minggu Ke-7</option>
                                        <option value="3">Minggu Ke-8</option>
                                        <option value="4">Minggu Ke-9</option>
                                        <option value="5">Minggu Ke-10</option>
                                        <option value="1">Minggu Ke-11</option>
                                        <option value="2">Minggu Ke-12</option>
                                        <option value="3">Minggu Ke-13</option>
                                        <option value="4">Minggu Ke-14</option>
                                        <option value="5">Minggu Ke-15</option>
                                        <option value="1">Minggu Ke-16</option>
                                        <option value="2">Minggu Ke-17</option>
                                        <option value="3">Minggu Ke-18</option>
                                        <option value="4">Minggu Ke-19</option>
                                        <option value="5">Minggu Ke-20</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 p-0 m-0">
                                <div class="input-wrapper">
                                    <input type="text" id="start-date" name="start_date" class="col-lg-12">
                                    <label class="label-in">Start Date</label>
                                </div>
                            </div>

                            <div class="col-md-3 m-0 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="end-date" name="end_date" class="col-lg-12">
                                    <label class="label-in">End Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-0 p-0">
                            <div class="input-wrapper">
                                <textarea type="text" id="deskripsi" class="col-lg-12"></textarea>
                                <label class="label-in">Deskripsi</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-wrapper col-12 mt-4">
                        <div class="alert alert-info " role="alert">Upload Foto Progres
                            <div id="dropzone" class="dropzone mt-2"></div>
                            <div id="responseMessage" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-warning btn-sm rounded-3"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitprogres" class="btn bg-gradient-primary btn-sm rounded-3">
                        <span id="loadingIcon" class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                        <span id="loadingText" class="d-none">Menyimpan...</span>
                        <span id="submitText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal simpan-->

<!-- MODAL PREVIEW GAMBAR -->
<div class="modal fade" id="modalPreviewImage">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Foto Progres</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="card-body pt-4 p-3">
                <li class="list-group-item progress-info-green shadow-lg">
                    <div class="d-flex flex-column" id="modalProgressInfo"></div>
                </li>

                <div class="modal-body">
                    <h5 class="modal-title text-center mb-3">Foto Progres</h5>
                    <div class="row g-3" id="modalImageBody"></div>
                </div>
            </div>

        </div>
    </div>
</div>



<script>
$(function() {
    $('input[name="end_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
            format: 'DD-MM-YYYY'
        }

    });
});

$(function() {
    $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        locale: {
            format: 'DD-MM-YYYY'
        }

    });
});
// akhir datepicker

function filterMingguKe(idUnit) {
    const select = $('#minggu-ke');

    // simpan semua option awal
    if (!select.data('all-options')) {
        select.data('all-options', select.html());
    }

    // reset option
    select.html(select.data('all-options'));

    $.ajax({
        url: "<?= base_url('Progres_pembangunan/get_minggu_terpakai') ?>",
        type: "POST",
        dataType: "json",
        data: {
            id_unit: idUnit,
        },
        success: function(usedWeeks) {

            if (!Array.isArray(usedWeeks)) return;

            usedWeeks.forEach(function(week) {
                select.find(`option[value="${week}"]`).remove();
            });
        }
    });
}

Dropzone.autoDiscover = false;

let progresDropzone;

// ================= RELOAD TIMELINE =================
function reloadTimeline() {
    const idUnit = <?= json_encode($id_unit) ?>;

    $('#timeline-container').load(
        "<?= base_url('Progres_pembangunan/reload_timeline/') ?>" + idUnit
    );
}

// ================= LOAD PERTAMA =================
document.addEventListener('DOMContentLoaded', function() {
    reloadTimeline();
});

$(document).on('click', '.tahap-click', function() {

    // ================= RESET FORM =================
    const form = document.querySelector('#tambah-progres form');
    if (form) form.reset();

    // ================= RESET DROPZONE =================
    if (progresDropzone) {
        progresDropzone.removeAllFiles(true);
    }

    const idTahap = $(this).data('idTahap');
    const idUnit = $(this).data('idUnit');

    // ================= SET HIDDEN INPUT =================
    $('#id-tahap').val(idTahap);
    $('#id-unit').val(idUnit);

    // 🔥 FILTER MINGGU KE BERDASARKAN UNIT + TAHAP
    filterMingguKe(idUnit, idTahap);

    // ================= BUKA MODAL =================
    const modalEl = document.getElementById('tambah-progres');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
});

// ================= DROPZONE =================
document.addEventListener('DOMContentLoaded', function() {

    progresDropzone = new Dropzone("#dropzone", {
        url: "<?= base_url('Progres_pembangunan/simpan_progress'); ?>",
        paramName: "foto_progres",
        uploadMultiple: true,
        parallelUploads: 10,
        autoProcessQueue: false,
        maxFiles: 10,
        maxFilesize: 10,
        acceptedFiles: "image/*",
        addRemoveLinks: true,

        init: function() {
            const dz = this;

            dz.on("sending", function(file, xhr, formData) {
                formData.append("id_unit", $('#id-unit').val());
                formData.append("id_tahap", $('#id-tahap').val());
                formData.append("deskripsi", $('#deskripsi').val());
                formData.append("pekan", $('#minggu-ke').val());
                formData.append("start_date", $('#start-date').val());
                formData.append("end_date", $('#end-date').val());
            });

            dz.on("success", function(file, response) {

                if (typeof response === "string") {
                    response = JSON.parse(response);
                }

                if (response.status === "success") {
                    dz.removeAllFiles(true);
                    bootstrap.Modal.getInstance(
                        document.getElementById('tambah-progres')
                    ).hide();

                    // 🔥 AUTO RELOAD
                    reloadTimeline();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1200,
                        showConfirmButton: false
                    });
                }
            });
        }
    });

    $('#submitprogres').on('click', function(e) {
        e.preventDefault();

        if (progresDropzone.getQueuedFiles().length === 0) {
            Swal.fire('Foto wajib', 'Upload foto dulu', 'warning');
            return;
        }

        progresDropzone.processQueue();
    });
});

function resetProgresModal() {

    // reset form biasa
    document.getElementById('deskripsi').value = '';
    document.getElementById('minggu-ke').value = '';

    // reset hidden
    document.getElementById('id-unit').value = '';
    document.getElementById('id-tahap').value = '';

    // reset dropzone
    if (progresDropzone) {
        progresDropzone.removeAllFiles(true);
    }

    // enable tombol
    document.getElementById('submitprogres').disabled = false;
}

$(document).on('click', '#modalImageBody img', function() {
    window.open(this.src, '_blank');
});

// dataprogres klik
$(document).on('click', '.progress-click', function() {

    const minggu = $(this).data('minggu');
    const mulai = $(this).data('mulai');
    const selesai = $(this).data('selesai');
    const deskripsi = $(this).data('deskripsi');
    const images = $(this).data('images');

    // TEXT INFO
    $('#modalProgressInfo').html(`
        <div class="text-center fw-bold mb-2">${minggu}</div>

        <div class="d-flex justify-content-between text-sm mb-2">
            <span><b>Mulai:</b> ${mulai}</span>
            <span><b>Selesai:</b> ${selesai}</span>
        </div>

        <div class="text-sm">
            ${deskripsi.replace(/\n/g, '<br>')}
        </div>
    `);

    // FOTO
    if (!images || images.length === 0) {
        $('#modalImageBody').html(
            '<p class="text-center text-muted">Tidak ada foto progres</p>'
        );
    } else {

        let html = '';

        images.forEach(img => {
            html += `
        <div class="col-12 col-md-6 shadow-lg">
            <div class="border rounded overflow-hidden">
                <img src="${img}" class="img-fluid w-100" style="object-fit: cover;">
            </div>
        </div>
    `;
        });

        $('#modalImageBody').html(html);
    }

    new bootstrap.Modal(
        document.getElementById('modalPreviewImage')
    ).show();
});
</script>