<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Progres_pembangunan extends AUTH_Controller
{

    var $template = 'templates/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Progres_model');
        $this->load->model('M_admin');
    }

    public function index()

    {
        $id                     = $this->session->userdata('userdata')->id;
        $role                   = $this->session->userdata('userdata')->role;
        $data['perumahan']      = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan']  = $this->M_admin->m_area_siteplan();
        $data['bread']          = 'Data Unit ';
        $data['content']        = 'page/progres/progres_bangunan';
        $data['script']         = 'page/progres/progres_js';
        $this->load->view($this->template, $data);
    }

    public function fetch_unit()
    {
        $output = '';

        // ===============================
        // Ambil Input
        // ===============================
        $limit  = (int)$this->input->post('limit');
        $start  = (int)$this->input->post('start');
        $search = $this->input->post('search');

        // ===============================
        // Validasi Pagination
        // ===============================
        if ($limit <= 0) {
            $limit = 12;
        }

        if ($start < 0) {
            $start = 0;
        }

        // ===============================
        // Ambil Data
        // ===============================
        $data = $this->Progres_model->get_unit_pro($limit, $start, $search);
        $total_data = $this->Progres_model->count_unit($search);
        $total_pages = ceil($total_data / $limit);

        // ===============================
        // loop Data
        // ===============================
        if (!empty($data)) {

            foreach ($data as $unt) {

                // ===============================
                // PROGRESS DARI tbl_progress_unit.persen
                // ===============================
                $progress = (!empty($unt->persen)) ? (int)$unt->persen : 0;

                    if ($progress < 0)  $progress = 0;
                    if ($progress > 100) $progress = 100;

                    // ===============================
                    // WARNA PROGRESS BAR
                    // ===============================
                    if ($progress >= 1 && $progress <= 30) {
                        $color = 'bg-danger';
                    } elseif ($progress >= 31 && $progress <= 50) {
                        $color = 'bg-warning';
                    } elseif ($progress >= 51 && $progress <= 89) {
                        $color = 'bg-success';
                    } else { // 90 - 100
                        $color = 'bg-primary';
                    }

                // ===============================
                // TAMPILKAN UKURAN JIKA > 0
                // ==============================
                $ukuran_html = '';
                if (isset($unt->ukuran_denah) && $unt->ukuran_denah != 0 && $unt->ukuran_denah != '') {
                    $ukuran_html = '<span class="text-white text-xs mb-0">'.$unt->ukuran_denah.' m²</span>';
                }



                // ===============================
                // OUTPUT HTML
                // ===============================
                $output .= '
                <div class="col-md-2 mb-3">
                    <div class="card border-0 shadow-lg rounded-4 card-hover">

                        <div class="card-header mx-4 p-3 d-flex justify-content-center">
                            <div class="icon icon-shape icon-lg bg-primary shadow
                                text-center border-radius-lg d-flex flex-column
                                justify-content-center lh-1">

                                <span class="text-white fw-bold fs-4 mb-1">'.$unt->code.'</span>
                                <span class="text-white text-xs mb-0">Type: '.$unt->type_unit.'</span>
                                '.$ukuran_html.'

                            </div>
                        </div>

                        <div class="card-body pt-0 p-3 text-center">
                            <h6 class="mb-2">Progress</h6>
                                <div class="progress" style="height:12px;">
                                    <div class="progress-bar '.$color.'"
                                        role="progressbar"
                                        style="width: '.$progress.'%; height:100%;"
                                        aria-valuenow="'.$progress.'"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                        '.$progress.'%
                                    </div>
                                </div>
                        </div>
                            <a href="'.site_url('Progres_pembangunan/detail/'.$unt->id_unit_progres).'"
                            class="btn btn-detail-hover w-100 rounded-0 rounded-bottom-4 mb-0">
                            Detail
                            </a>
                        </div>
                    </div>
                </div>';
            }

            echo json_encode([
                'data' => $output,
                'total_pages' => $total_pages
            ]);

        } else {

            echo json_encode([
                'data' => '',
                'total_pages' => $total_pages
            ]);
        }
    }

    public function reload_timeline($id_unit)
    {
        $data['id_unit']  = $id_unit;
        $data['timeline'] = $this->Progres_model->getTimelineUnit($id_unit);

        $this->load->view('page/progres/_timeline', $data);
    }

    public function detail($id_unit)
    {
        $id   = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data['area_siteplan']  = $this->M_admin->m_area_siteplan();
        $data['perumahan'] = $this->M_admin->m_perumahan($id, $role);
        $data['id_unit']   = $id_unit;

        // 🔥 FIRST LOAD
        $data['timeline'] = $this->Progres_model->getTimelineUnit($id_unit);
        $data['bread'] = 'Progress timeline ';
        $data['content'] = 'page/progres/progres_view';
        $data['script']  = 'page/progres/progres_js';

        $this->load->view($this->template, $data);
    }

    public function simpan_progress()
    {
        $id_pembuat  = $this->session->userdata('userdata')->id;
        // ================= AMBIL INPUT =================
        $id_unit     = $this->input->post('id_unit', true);
        $id_tahap    = $this->input->post('id_tahap', true);
        $deskripsi   = $this->input->post('deskripsi', true);
        $minggu      = $this->input->post('pekan', true);

        // ================= VALIDASI INPUT =================
        if (!$id_unit || !$id_tahap || !$minggu) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak lengkap'
            ]);
            return;
        }

        // ================= VALIDASI FILE =================
        if (empty($_FILES['foto_progres']['name'])) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Foto progres wajib diupload'
            ]);
            return;
        }

        // ================= CEK TAHAP =================
        $tahap = $this->db
            ->get_where('tbl_tahap', ['id_tahap' => $id_tahap])
            ->row();

        if (!$tahap) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Tahap tidak ditemukan'
            ]);
            return;
        }

        // ================= UPLOAD FOTO =================
        $uploadPath = FCPATH . 'upload/foto_progres/';

        // 🔥 auto create folder
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // ================= TRANSAKSI =================
        $this->db->trans_begin();

        // ================= INSERT PROGRESS =================
        $progressData = [
            'id_unit'    => $id_unit,
            'id_tahap'   => $id_tahap,
            'deskripsi'  => $deskripsi,
            'persen'     => $tahap->persen_target,
            'minggu_ke'  => $minggu,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $id_pembuat

        ];

        $this->db->insert('tbl_progress_unit', $progressData);
        $id_progress = $this->db->insert_id();

        if (!$id_progress) {
            $this->db->trans_rollback();
            unlink($uploadPath . $nama_foto);

            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menyimpan progres'
            ]);
            return;
        }

        // ================= UPLOAD MULTI FILE =================
        $this->load->library('upload');

        $files = $_FILES['foto_progres'];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {

            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];

            $config = [
                'upload_path'   => $uploadPath,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size'      => 1024,
                'encrypt_name'  => true
            ];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $this->db->trans_rollback();
                echo json_encode([
                    'status'=>'error',
                    'message'=>$this->upload->display_errors()
                ]);
                return;
            }

            $uploadData = $this->upload->data();

            $this->db->insert('tbl_progress_foto', [
                'id_progres' => $id_progress,
                'file_foto'  => $uploadData['file_name']
            ]);
        }

        // ================= COMMIT / ROLLBACK =================
        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            if (file_exists($uploadPath . $nama_foto)) {
                unlink($uploadPath . $nama_foto);
            }

            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menyimpan progres'
            ]);
            return;
        }

        $this->db->trans_commit();

        echo json_encode([
            'status'  => 'success',
            'message' => 'Progres berhasil disimpan'
        ]);
    }
}