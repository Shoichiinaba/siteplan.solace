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
        $perum =  $this->input->post('perum');
        $id_perum =  $this->input->post('id_perum');

        // Simpan data ke dalam sesion
        $data = array(
            'id_customer' => $id_customer,
            'nama' => $nama,
            'email' => $email,
            'telepon' => $telepon,
            'id_perum' => $id_perum
        );
        $this->session->set_userdata('form_data', $data);

        // Simpan data ke database
        if ($this->FormDataModel->simpanData($id_customer, $nama, $email, $telepon, $id_perum)) {
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