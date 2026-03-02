<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Client extends CI_Controller
{
    public $session;
    public $input;
    public $FormDataModel;
    public $db;
    public $uri;
    public $perum;

    var $template = 'templates_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormDataModel');
    }

    public function index()
    {
        // Cek apakah data sudah ada dalam sesion
        $data['_tittle'] = 'Cek ketersediaan unit';
        $data['perumahan'] = $this->FormDataModel->m_perumahan();
        $data['content']        = 'client/dash_client';
        $this->load->view($this->template, $data);
    }

    public function Dashboard_progres()
    {
        if (!$this->session->userdata('id_customer')) {
            redirect('Auth/customer');
        }

        $id = $this->session->userdata('id_customer');

        // ================= CUSTOMER =================
        $data['customer'] = $this->db
            ->where('id', $id)
            ->get('customer_account')
            ->row();

        // ================= PROPERTI =================
        $data['properti'] = $this->FormDataModel
            ->get_properti_customer($data['customer']->id_visit_account);

        // ================= PROGRESS TERAKHIR =================
        if (!empty($data['properti']->id_unit)) {
            $data['progress'] = $this->FormDataModel
                ->get_progress_terakhir($data['properti']->id_unit);
        } else {
            $data['progress'] = null;
        }

        // ================= TAHAP =================
        if (!empty($data['properti']->id_unit)) {
            $data['tahap'] = $this->FormDataModel
                ->get_tahap_progress($data['properti']->id_unit);
        } else {
            $data['tahap'] = [];
        }

        // ================= MARKETING =================
        $data['marketing'] = $this->FormDataModel
            ->get_marketing_by_visit($data['customer']->id_visit_account);

        /*
        ==========================================
        ====== PREMIUM TIMELINE SECTION ==========
        ==========================================
        */

        // Default null
        $data['utj'] = null;
        $data['data_dp'] = null;
        $data['progress_unit'] = [];

        if (!empty($data['properti'])) {

            // ================= UTJ =================
            $data['utj'] = $this->db
                ->where('id_trans_denahs', $data['properti']->id_denahs)
                ->where('status_trans', 'UTJ')
                ->order_by('tgl_trans', 'ASC')
                ->get('transaksi')
                ->row();

            // ================= DP =================

                $data['data_dp'] = null;
                if (!empty($data['properti']) && isset($data['properti']->id_denahs)) {

                    $id_denahs = $data['properti']->id_denahs;

                    $this->db->select('
                        SUM(nominal) as total_dp,
                        MIN(tgl_trans) as tgl_pertama,
                        MAX(tgl_trans) as tgl_terakhir
                    ');
                    $this->db->where('id_trans_denahs', $id_denahs);
                    $this->db->where('status_trans', 'DP');
                    $this->db->where('nominal >', 0);

                    $query = $this->db->get('transaksi');

                    $data['data_dp'] = $query->row();
                }

            // ================= PROGRESS UNIT =================
            if (!empty($data['properti']->id_unit)) {
                $data['progress_unit'] = $this->db
                    ->where('id_unit', $data['properti']->id_unit)
                    ->get('tbl_progress_unit')
                    ->result();
            }
        }

        // ================= MASTER TAHAP =================
        $data['master_tahap'] = $this->db
            ->order_by('urutan', 'ASC')
            ->get('tbl_tahap')
            ->result();

            $subquery = "
            SELECT MAX(start_date)
            FROM tbl_progress_unit t2
            WHERE t2.id_tahap = tbl_progress_unit.id_tahap
            AND t2.id_unit = ".$data['properti']->id_unit."
        ";

        $data['timeline_tahap'] = $this->db
            ->where('id_unit', $data['properti']->id_unit)
            ->where("start_date = ($subquery)", null, false)
            ->get('tbl_progress_unit')
            ->result();

            $progress_by_tahap = [];

        foreach ($data['progress_unit'] as $p) {
            $progress_by_tahap[$p->id_tahap] = $p;
        }

        if (!empty($data['properti']->id_unit)) {

            $subquery = "
                SELECT MAX(start_date)
                FROM tbl_progress_unit t2
                WHERE t2.id_tahap = tbl_progress_unit.id_tahap
                AND t2.id_unit = ".$this->db->escape($data['properti']->id_unit)."
            ";

            $data['serah_terima'] = $this->db
                ->where('id_unit', $data['properti']->id_unit)
                ->where("start_date = ($subquery)", null, false)
                ->get('tbl_progress_unit')
                ->result();
        } else {
            $data['serah_terima'] = [];
        }

        $data['progress_by_tahap'] = $progress_by_tahap;

        // ================= FOTO UNIT =================
        if (!empty($data['properti']) && !empty($data['properti']->id_unit)) {

            $data['foto_unit'] = $this->db
                ->where('id_unit', $data['properti']->id_unit)
                ->order_by('id_foto', 'ASC')
                ->get('foto_unit')
                ->result();

        } else {
            $data['foto_unit'] = [];
        }

        $data['_tittle']   = 'Dashboard Progres Rumah';
        $data['perumahan'] = $this->FormDataModel->m_perumahan();
        $data['content']   = 'client/progres_rumah/dashboard';

        $this->load->view($this->template, $data);
    }

    public function visit($nama = null, $id_perum = null)
    {
        if (!$this->session->userdata('form_data')) {
            redirect(base_url('Client'));
        } else {
            $this->session->set_flashdata('error_message', 'Anda sudah mengisi data sebelumnya.');

            $perum = preg_replace("![^a-z0-9]+!i", " ", $nama);

            $data['_tittle']       = 'Site Plan ' . $perum;
            $data['perum']         = $this->FormDataModel->m_foto_perum($perum);
            $data['status_count']  = $this->FormDataModel->count_status($perum);
            $data['area_siteplan'] = $this->FormDataModel->m_area_siteplan($perum);

            // simpan id_perum langsung ke view
            $data['id_perum']      = $id_perum;

            $data['content']       = 'client/site_plan/site_plan';
            $this->load->view($this->template, $data);
        }
    }

    public function submit()
    {
        // Tangkap data dari formulir
        $id_customer = $this->input->post('id_customer');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        $domisili = $this->input->post('domisili');
        $perum =  $this->input->post('perum');
        $id_perum =  $this->input->post('id_perum');

        // Buat tanggal dan jam hari ini
        date_default_timezone_set("Asia/Jakarta");
        $tanggal_hari_ini = date("Y-m-d");
        $jam_hari_ini     = date("H:i:s");

        // Simpan data ke dalam sesion
         $data = array(
            'id_customer' => $id_customer,
            'nama'        => $nama,
            'email'       => $email,
            'domisili'    => $domisili,
            'telepon'     => $telepon,
            'id_perum'    => $id_perum,
            'tanggal'     => $tanggal_hari_ini,
            'jam'         => $jam_hari_ini
        );
        $this->session->set_userdata('form_data', $data);

        // Simpan data ke database
        if ($this->FormDataModel->simpanData($id_customer, $nama, $email, $domisili, $telepon, $tanggal_hari_ini, $jam_hari_ini, $id_perum)) {
            // Data berhasil disimpan
            $this->session->set_flashdata('success_message', 'Terima Kasih Data anda sudah berhasil disimpan.');
        } else {
            // Data sudah ada
            $this->session->set_flashdata('error_message', 'Anda sSudah Pernah Mengisikan Data diri.');
        }

        redirect('Client/visit/' . $perum);
    }
    function load_site_plan()
    {
        $id_siteplan = $this->input->post('id-siteplan');

        $sql = "SELECT *FROM site_plan WHERE id_siteplan = '$id_siteplan'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                echo $data->file_siteplan;
            }
        }
    }

    public function getDenahDetail()
    {
        $id_perum = $this->input->post('id_perum');
        $code     = $this->input->post('code');

        $denah = $this->FormDataModel->getDenahDetail($id_perum, $code);

        if (!empty($denah)) {  // pastikan ada data
            $first = $denah[0]; // ambil baris pertama

            // Mapping status pembayaran
            if ($first->status_pembayaran == "kpr-sub" || $first->status_pembayaran == "kpr-kom") {
                $status_pembayaran = 'KPR';
            } elseif ($first->status_pembayaran == "cash") {
                $status_pembayaran = 'CASH';
            } else {
                $status_pembayaran = $first->status_pembayaran;
            }

            $response = [
                'success' => true,
                'data' => [
                    'id_perum'          => $first->id_perum,
                    'nama_perum'        => $first->nama_perumahan,
                    'code'              => $first->code,
                    'type_unit'         => $first->type_unit,
                    'status'            => $first->type,
                    'status_pembayaran' => $status_pembayaran,
                    'progres_berkas'    => $first->progres_berkas,

                    // kirim semua transaksi (bisa lebih dari 1)
                    'transaksi'         => $denah
                ]
            ];
        } else {
            $response = [
                'success' => false,
                'data' => [
                    'id_perum'   => $id_perum,
                    'code'       => $code,
                ],
                'message' => 'Blok tidak terdaftar'
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


}