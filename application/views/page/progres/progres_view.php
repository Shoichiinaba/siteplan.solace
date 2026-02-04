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
                        <div class="col-md-6 mb-0">
                            <div class="input-wrapper">
                                <textarea type="text" id="deskripsi" class="col-lg-12"></textarea>
                                <label class="label-in">Deskripsi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label class="label-select">Minggu Ke</label>
                                <select type="text" id="minggu-ke" class="col-lg-12">
                                    <option value="">Pilih Minggu Ke</option>
                                    <option value="1">Minggu Ke-1</option>
                                    <option value="2">Minggu Ke-2</option>
                                    <option value="3">Minggu Ke-3</option>
                                    <option value="4">Minggu Ke-4</option>
                                    <option value="5">Minggu Ke-5</option>
                                </select>
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
            <div class="modal-body" id="modalImageBody"></div>
        </div>
    </div>
</div>



<script>
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
    form.reset();

    // ================= SET HIDDEN INPUT =================
    $('#id-tahap').val($(this).data('idTahap'));
    $('#id-unit').val($(this).data('idUnit'));

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

// dataprogres klik
$(document).on('click', '.progress-click', function() {

    const images = $(this).data('images');

    if (!images || images.length === 0) {
        Swal.fire('Info', 'Progres ini tidak memiliki foto', 'info');
        return;
    }

    let html = '';
    images.forEach(img => {
        html += `<img src="${img}" class="img-fluid rounded mb-2">`;
    });

    $('#modalImageBody').html(html);

    new bootstrap.Modal(
        document.getElementById('modalPreviewImage')
    ).show();
});
</script>