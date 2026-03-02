<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Customer extends AUTH_Controller
{
    public $input;
    public $output;
    public $FormDataModel;
    public $M_admin;
    public $session;

    var $template = 'templates/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Visit_model');
        $this->load->model('Lead_model');
        $this->load->model('M_admin');
    }

    public function index()

    {
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data['perumahan'] = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan'] = $this->M_admin->m_area_siteplan();
        $data['bread']      = 'Data Customer';
        $data['content']    = 'page/customer/form_customer';
        $this->load->view($this->template, $data);
    }

    function get_customer_web() {
        $role = $this->session->userdata('userdata')->role;
        $id = $this->session->userdata('userdata')->id;

        $list = $this->Customer_model->get_datatables($role, $id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cus) {

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $cus->nama_cus;
            $row[] = $cus->email;
            $row[] = $cus->domisili;
            $row[] = $cus->telepon;
            $row[] = date("d-m-Y", strtotime($cus->tanggal));
            $row[] = $cus->jam;
            $row[] = $cus->nama_perum;
            $row[] = $cus->jml_input;

            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Customer_model->count_all($role, $id),
                    "recordsFiltered" => $this->Customer_model->count_filtered($role, $id),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    function customer_visit()
    {
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;

        $data['userdata'] 		= $this->userdata;
        $data['perumahan']      = $this->M_admin->m_perumahan($id, $role);
        $data['marketing']      = $this->M_admin->get_data_admin();
        $data['area_siteplan']  = $this->M_admin->m_area_siteplan();
        $data['bread']          = 'Data Surve';
        // var_dump($data['kapling']);
        $data['content']        = 'page/customer/form_surve';
        $this->load->view($this->template, $data);
    }

    function customer_lead()

    {
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;

        $data['userdata'] 		= $this->userdata;
        $data['perumahan']      = $this->M_admin->m_perumahan($id, $role);
        $data['marketing']      = $this->M_admin->get_data_admin();
        $data['area_siteplan']  = $this->M_admin->m_area_siteplan();
        $data['bread']          = 'Data Surve';
        $data['content']        = 'page/customer/form_lead';
        $this->load->view($this->template, $data);
    }

    public function get_kapling_options()
    {
        $id_perum = $this->input->post('unit');
        $kaplingOptions = $this->Visit_model->get_kapling($id_perum);

        foreach ($kaplingOptions as $kapling) {
            echo '<option value="'.$kapling->id_denahs.'">'.$kapling->code.'</option>';
        }
    }

    function get_customer_lead() {
        $role = $this->session->userdata('userdata')->role;
        $id = $this->session->userdata('userdata')->id;
        $fil_unit = $this->input->post('fil_unit');
        $fil_kategori = $this->input->post('fil_kategori');
        $fil_sumber = $this->input->post('fil_sumber');
        $fil_daterange = $this->input->post('fil_daterange');
        $fil_marketing = $this->input->post('fil_marketing');

        // ambil SEMUA baris (tanpa pagination) agar grouping/filter di PHP bekerja terhadap seluruh set
        $list = $this->Lead_model->get_datatableslead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing, false);


        // 1️⃣ Kelompokkan berdasarkan nama
        $grouped = [];
        foreach ($list as $cus) {
            $key = strtolower(trim($cus->nama_visit));
            if (!isset($grouped[$key])) {
                $grouped[$key] = [];
            }
            $grouped[$key][] = $cus;
        }

        // 2️⃣ Filter logika: jika ada kategori "Sudah Survey" → skip nama tsb
        $filtered = [];
        foreach ($grouped as $nama => $rows) {
            $hasSudahSurvey = false;

            foreach ($rows as $r) {

                // Normalisasi kategori: hilangkan karakter tak terlihat dan buat lowercase
                $kategori = strtolower($r->kategori ?? '');
                $kategori = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $kategori);
                $kategori = trim(preg_replace('/\s+/', ' ', $kategori)); // ubah semua spasi jadi 1 spasi

                // Gunakan "contains" agar lebih toleran
                if (strpos($kategori, 'sudah survey') !== false) {
                    $hasSudahSurvey = true;
                    break;
                }
            }

            // Jika ada data "Sudah Survey", lewati semua nama ini
            if ($hasSudahSurvey) continue;

            // Ambil id_visit terbesar (data terakhir)
            usort($rows, fn($a, $b) => (int)$b->id_visit <=> (int)$a->id_visit);
            $filtered[] = $rows[0];
        }

        // 3️⃣ Bangun data untuk output
        $data = [];
        $no = @$_POST['start'];
        foreach ($filtered as $cus) {
            $no++;

            $text = 'Halo Kak ' . $cus->nama_visit . ', Mengenai Hasil ' . $cus->hasil_fu .
                    ', Pada Tanggal ' . $cus->tanggal .
                    ', Apakah ada rencana lagi untuk Survey?';
            $wa = 'https://api.whatsapp.com/send?phone=62' . $cus->no_tlp . '&text=' . rawurlencode($text);
            $whatsappBtn = '<a href="' . $wa . '" class="btn bg-gradient-success btn-xs rounded-4" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>';

            $editBtn = '&nbsp;<button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit"
                data-bs-toggle="modal" data-bs-target="#edit-data"
                data-id="' . $cus->id_visit . '"
                data-nama="' . htmlentities($cus->nama_visit) . '"
                data-tanggal="' . $cus->tanggal . '"
                data-no_tlp="' . $cus->no_tlp . '"
                data-unit="' . $cus->unit . '"
                data-kategori="' . $cus->kategori . '"
                data-keterangan="' . $cus->keterangan . '"
                data-sumber="' . $cus->sumber . '"
                data-hasil_fu="' . $cus->hasil_fu . '"
                onclick="sendUnitToController(\'' . $cus->unit . '\')"><i class="fa fa-pencil"></i></button>';

            $row = [];
            $row[] = $no . '.';
            if ($role !== 'Marketing') $row[] = $cus->nama_marketing;
            $row[] = $cus->nama_visit;
            $row[] = $cus->tanggal;
            $row[] = $cus->no_tlp;
            $row[] = $cus->nama_perum;
            $row[] = $cus->kategori;
            $row[] = $cus->keterangan;
            $row[] = $cus->sumber;
            $row[] = $cus->hasil_fu;
            $row[] = $whatsappBtn . $editBtn;
            $data[] = $row;
        }

        // 4️⃣ Output ke DataTables
        $output = [
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Lead_model->count_alllead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing),
            "recordsFiltered" => $this->Lead_model->count_filteredlead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing),
            "data" => $data
        ];

        echo json_encode($output);
    }

    function get_customer_visit() {
        $role = $this->session->userdata('userdata')->role;
        $id = $this->session->userdata('userdata')->id;
        $fil_unit = $this->input->post('fil_unit');
        $fil_kategori = $this->input->post('fil_kategori');
        $fil_sumber = $this->input->post('fil_sumber');
        $fil_daterange = $this->input->post('fil_daterange');
        $fil_marketing = $this->input->post('fil_marketing');

        $list = $this->Visit_model->get_datatablesvisit($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $cus) {
            // tombol WA
            $whatsappUrl = 'https://api.whatsapp.com/send?phone=62' . $cus->no_tlp .
                '&text=Halo%20Kak%20' . $cus->nama_visit .
                ',%20Mengenai%20hasil%20' . $cus->hasil_fu .
                ',%20pada%20tanggal%20' . $cus->tanggal .
                ',%20apakah%20ada%20rencana%20lagi%20untuk%20survey%3F%0A';

            $whatsappButton = '<a href="' . $whatsappUrl . '" class="btn bg-gradient-success btn-xs rounded-4" data-bs-toggle="tooltip" title="Chat via WhatsApp" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i>
                            </a>';

            // tombol edit hanya muncul jika kategori BUKAN UTJ
            $editButton = '';
            if (strtoupper($cus->kategori) != 'UTJ') {
                $editButton = '&nbsp; <button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit-data"
                                    data-id="' . $cus->id_visit . '"
                                    data-nama="' . $cus->nama_visit . '"
                                    data-tanggal="' . $cus->tanggal . '"
                                    data-no_tlp="' . $cus->no_tlp . '"
                                    data-unit="' . $cus->unit . '"
                                    data-kategori="' . $cus->kategori . '"
                                    data-keterangan="' . $cus->keterangan . '"
                                    data-sumber="' . $cus->sumber . '"
                                    data-hasil_fu="' . $cus->hasil_fu . '"
                                    onclick="sendUnitToController(\'' . $cus->unit . '\')">
                                    <i class="fa fa-pencil"></i>
                                </button>';
            }

            $no++;
            $row = array();
            $row[] = $no . ".";

            if ($role !== 'Marketing') {
                $row[] = $cus->nama_marketing;
            }

            $row[] = $cus->nama_visit;
            $row[] = $cus->tanggal;
            $row[] = $cus->no_tlp;
            $row[] = $cus->nama_perum;
            $row[] = $cus->kategori;
            $row[] = $cus->keterangan;
            $row[] = $cus->sumber;
            $row[] = $cus->hasil_fu;
            $row[] = $whatsappButton . $editButton;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Visit_model->count_allvisit($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing),
            "recordsFiltered" => $this->Visit_model->count_filteredvisit($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing),
            "data" => $data,
        );

        echo json_encode($output);
    }

    function input_lead()
    {
        $data = array(
            'id_marketing' => $this->input->post('id_marketing'),
            'nama' => $this->input->post('nama'),
            'tanggal' => $this->input->post('tanggal'),
            'no_tlp' => $this->input->post('no_tlp'),
            'unit' => $this->input->post('unit'),
            'kategori' => $this->input->post('kategori'),
            'keterangan' => $this->input->post('keterangan'),
            'sumber' => $this->input->post('sumber'),
            'hasil_fu' => $this->input->post('hasil_fu')
        );

        $result = $this->Lead_model->save_lead($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function edit_data()
    {
        $id = $this->input->post('id');

        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid. Data tidak dapat diperbarui.'
            ]);
            return;
        }

        $data = [
            'id_marketing' => $this->input->post('id_marketing'),
            'nama'        => $this->input->post('nama'),
            'tanggal'     => $this->input->post('tanggal'),
            'no_tlp'      => $this->input->post('no_tlp'),
            'unit'        => $this->input->post('unit'),
            'kategori'    => $this->input->post('kategori'),
            'keterangan'  => $this->input->post('keterangan'),
            'sumber'      => $this->input->post('sumber'),
            'hasil_fu'    => $this->input->post('hasil_fu')
        ];

        $update_status = $this->Lead_model->update_data('visit', $data, $id);

        if ($update_status) {
            $response = [
                'status'  => true,
                'message' => 'Data berhasil diperbarui.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Gagal memperbarui data di database.'
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    // update data kunjungan

    public function edit_kunjungan()
    {
        $id         = $this->input->post('id'); // id visit
        $id_denahs  = $this->input->post('code');
        $nominal    = $this->input->post('nominal');

        if (!empty($id)) {

            // ===============================
            // DATA VISIT
            // ===============================
            $data = [
                'id_marketing' => $this->input->post('id_marketing'),
                'id_blok'      => $this->input->post('code'),
                'nama'         => $this->input->post('nama'),
                'tanggal'      => $this->input->post('tanggal'),
                'no_tlp'       => $this->input->post('no_tlp'),
                'unit'         => $this->input->post('unit'),
                'kategori'     => $this->input->post('kategori'),
                'keterangan'   => $this->input->post('keterangan'),
                'sumber'       => $this->input->post('sumber'),
                'hasil_fu'     => $this->input->post('hasil_fu')
            ];

            // ===============================
            // DATA DENAH
            // ===============================
            $data_denah = [
                'type_unit'  => $this->input->post('type_unit'),
                'type'       => 'Dipesan',
                'color'      => 'red',
                'user_admin' => $this->input->post('nama_marketing'),
            ];

            // ===============================
            // DATA TRANSAKSI
            // ===============================
            $data_trans = [
                'id_trans_denahs' => $id_denahs,
                'nama_cus'        => $this->input->post('nama'),
                'tgl_trans'       => $this->input->post('tanggal'),
                'status_trans'    => $this->input->post('kategori'),
                'no_wa'           => $this->input->post('no_tlp'),
                'nominal'         => $nominal,
            ];

            // ===============================
            // DATA UNIT PROGRES
            // ===============================
            $data_unitpro = [
                'id_denahs' => $id_denahs,
                'id_agent'  => $this->input->post('id_marketing'),
            ];

            // ===============================
            // DATA CUSTOMER ACCOUNT
            // ===============================
            $data_account_cus = [
                'id_visit_account' => $id,
                'nama'             => $this->input->post('nama'),
                'telepon'          => $this->input->post('no_tlp'),
                'foto_profil'             => 'default.png',
                'role'             => 'customer',
                'dibuat'           => date('Y-m-d H:i:s'),
            ];

            // ===============================
            // UPDATE VISIT
            // ===============================
            $update_visit = $this->Visit_model->update_data('visit', $data, $id);

            if ($update_visit) {

                // ===============================
                // INSERT / UPDATE UNIT PROGRES
                // ===============================
                $unit_progres = $this->Visit_model->get_unit_progres($id_denahs);

                if ($unit_progres) {
                    $this->Visit_model->update_unit_progres($data_unitpro, $id_denahs);
                } else {
                    $this->Visit_model->insert_unit_progres($data_unitpro);
                }

                // ===============================
                // UPDATE DENAH
                // ===============================
                if (!empty($id_denahs)) {
                    $this->Visit_model->update_denah('denahs', $data_denah, $id_denahs);
                }

                // ===============================
                // INSERT TRANSAKSI
                // ===============================
                $this->Visit_model->save_trans($data_trans);

                // ===============================
                // INSERT / UPDATE CUSTOMER ACCOUNT
                // ===============================
                $cek_account = $this->Visit_model->get_customer_by_visit($id);

                if ($cek_account) {
                    // UPDATE
                    $this->Visit_model->update_customer_account($data_account_cus, $id);
                } else {
                    // INSERT
                    $this->Visit_model->insert_customer_account($data_account_cus);
                }

                $response = [
                    'status'  => true,
                    'message' => 'Data berhasil diperbarui.'
                ];

            } else {
                $response = [
                    'status'  => false,
                    'message' => 'Gagal memperbarui data visit.'
                ];
            }

        } else {
            $response = [
                'status'  => false,
                'message' => 'ID tidak valid. Data tidak dapat diperbarui.'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

}