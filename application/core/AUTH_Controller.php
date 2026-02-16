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
        // HITUNG JUMLAH AKUN CUSTOMER KOSONG
        // ===============================
        if (!empty($this->userdata)) {

            $role = $this->userdata->role;
            $id   = $this->userdata->id;

            $jumlah_akun_kosong =
                $this->Customer_acount_model
                     ->count_account_kosong($role, $id);

            // Kirim ke semua view (sidebar, header, dll)
            $this->load->vars([
                'userdata' => $this->userdata,
                'jumlah_akun_kosong' => $jumlah_akun_kosong
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