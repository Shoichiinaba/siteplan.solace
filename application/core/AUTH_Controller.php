<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AUTH_Controller extends CI_Controller {

    public $userdata;

    public function __construct() {
        parent::__construct();

        // ===============================
        // LOAD MODEL
        // ===============================
        $this->load->model('M_admin');
        $this->load->model('Customer_acount_model');
        $this->load->model('Visit_model'); // TAMBAHAN

        // ===============================
        // CEK LOGIN
        // ===============================
        if ($this->session->userdata('status') == '') {
            redirect('Auth');
        }

        // ===============================
        // AMBIL USERDATA
        // ===============================
        $this->userdata = $this->session->userdata('userdata');

        // Simpan segment (jika dipakai di template)
        $this->session->set_flashdata(
            'segment',
            explode('/', $this->uri->uri_string())
        );

        // ===============================
        // PROSES DATA GLOBAL (SIDEBAR DLL)
        // ===============================
        if (!empty($this->userdata)) {

            $role = $this->userdata->role;
            $id   = $this->userdata->id;

            // ===============================
            // HITUNG AKUN CUSTOMER KOSONG
            // ===============================
            $jumlah_akun_kosong =
                $this->Customer_acount_model
                     ->count_account_kosong($role, $id);

            // ===============================
            // HITUNG DATA LEAD (visit)
            // ===============================
            if ($role == 'admin') {

                // Admin lihat semua
                $this->db->from('visit');
                $this->db->where_in('kategori', ['LEAD', 'FU', 'Minat Survey']);
                $jumlah_lead = $this->db->count_all_results();

            } else {

                // Marketing hanya lihat miliknya
                $this->db->from('visit');
                $this->db->where('id_marketing', $id);
                $this->db->where_in('kategori', ['LEAD', 'FU', 'Minat Survey']);
                $jumlah_lead = $this->db->count_all_results();
            }

            // ===============================
            // HITUNG DATA SURVEY
            // ===============================
            if ($role == 'admin') {

                // Admin lihat semua
                $this->db->from('visit');
                $this->db->where_in('kategori', ['Sudah Survey', 'Tidak Prospek', 'Prospek']);
                $jumlah_visit = $this->db->count_all_results();

            } else {

                // Marketing hanya lihat miliknya
                $this->db->from('visit');
                $this->db->where('id_marketing', $id);
                $this->db->where_in('kategori', ['Sudah Survey', 'Tidak Prospek', 'Prospek']);
                $jumlah_visit = $this->db->count_all_results();
            }

            // ===============================
            // KIRIM KE SEMUA VIEW
            // ===============================
            $this->load->vars([
                'userdata' => $this->userdata,
                'jumlah_akun_kosong' => $jumlah_akun_kosong,
                'jumlah_lead' => $jumlah_lead,
                'jumlah_visit' => $jumlah_visit
            ]);
        }
    }

    // ===============================
    // UPDATE PROFIL SESSION
    // ===============================
    public function updateProfil() {
        if ($this->userdata != '') {

            $data = $this->M_admin->select($this->userdata->id);

            $this->session->set_userdata('userdata', $data);
            $this->userdata = $this->session->userdata('userdata');
        }
    }
}


// class AUTH_Controller extends CI_Controller {
// 	public function __construct() {
// 		parent::__construct();
// 		$this->load->model('M_admin');

// 		$this->userdata = $this->session->userdata('userdata');

// 		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

// 		if ($this->session->userdata('status') == '') {
// 			redirect('Auth');
// 		}
// 	}

// 	public function updateProfil() {
// 		if ($this->userdata != '') {
// 			$data = $this->M_admin->select($this->userdata->id);

// 			$this->session->set_userdata('userdata', $data);
// 			$this->userdata = $this->session->userdata('userdata');
// 		}
// 	}
// }