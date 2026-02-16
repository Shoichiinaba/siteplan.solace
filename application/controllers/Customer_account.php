<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Customer_account extends AUTH_Controller
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
        $this->load->model('Customer_acount_model');
        $this->load->model('M_admin');
    }

    public function index()

    {
        $data['userdata'] = $this->session->userdata('userdata');
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data['perumahan'] = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan'] = $this->M_admin->m_area_siteplan();
        $data['bread']      = 'Data Akun Customer';
        $data['content']    = 'page/customer_account/data_akun_customer';
        $this->load->view($this->template, $data);
    }

    function get_customer_account() {
        $role = $this->session->userdata('userdata')->role;
        $id = $this->session->userdata('userdata')->id;

        $list = $this->Customer_acount_model->get_datatables($role, $id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cus) {

            $editButton = '
                            <button type="button"
                                class="btn bg-gradient-info btn-xs rounded-4 btn-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#edit-customer"
                                data-id="' . $cus->id .'"
                                data-id_visit="'. $cus->id_visit_account.'"
                                data-nama="'. htmlspecialchars($cus->nama_cus, ENT_QUOTES, 'UTF-8') .'"
                                data-email="'. htmlspecialchars($cus->email, ENT_QUOTES, 'UTF-8') .'"
                                data-domisili="'. htmlspecialchars($cus->domisili, ENT_QUOTES, 'UTF-8') .'"
                                data-username="'. htmlspecialchars($cus->username, ENT_QUOTES, 'UTF-8') .'"
                                data-telepon="'. htmlspecialchars($cus->telepon, ENT_QUOTES, 'UTF-8') .'"
                                data-dibuat="'. htmlspecialchars($cus->dibuat, ENT_QUOTES, 'UTF-8') .'"
                                data-perum="'. htmlspecialchars($cus->nama_perum, ENT_QUOTES, 'UTF-8') .'"
                                data-foto="'. $cus->foto_profil .'">
                                <i class="fa fa-pencil"></i>
                            </button>
                        ';

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $cus->nama_cus;
            $row[] = $cus->email;
            $row[] = $cus->domisili;
            $row[] = $cus->telepon;
            $row[] = date("d-m-Y", strtotime($cus->dibuat));
            $row[] = $cus->nama_perum;
            $row[] = $editButton;


            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Customer_acount_model->count_all($role, $id),
                    "recordsFiltered" => $this->Customer_acount_model->count_filtered($role, $id),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    public function update_customer()
    {
        $id_customer = $this->input->post('id');

        $current_customer = $this->Customer_acount_model->get_customer_by_id($id_customer);
        $old_foto_profil  = !empty($current_customer->foto_profil) ? $current_customer->foto_profil : '';

        $data = array(
            'nama'     => $this->input->post('nama_customer'),
            'email'    => $this->input->post('email'),
            'telepon'  => $this->input->post('no_tlp'),
            'username' => $this->input->post('username'),
            'domisili' => $this->input->post('domisili'),
            'diubah'   => date('Y-m-d H:i:s')
        );

        // Password opsional
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }

        // =============================
        // UPLOAD FOTO (JIKA ADA)
        // =============================
        if (!empty($_FILES['foto_profil']['name'])) {

            $config['upload_path']   = './upload/foto_customer/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name']     = 'profile_' . time();
            $config['max_size']      = 5120;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_profil')) {

                $upload_data = $this->upload->data();
                $full_path   = $upload_data['full_path'];
                $new_file    = $upload_data['file_name'];

                // Compress
                $this->load->library('image_lib');

                $compress['image_library']  = 'gd2';
                $compress['source_image']   = $full_path;
                $compress['maintain_ratio'] = TRUE;
                $compress['quality']        = '70%';
                $compress['width']          = 800;
                $compress['height']         = 800;

                $this->image_lib->initialize($compress);
                $this->image_lib->resize();
                $this->image_lib->clear();

                // Hapus foto lama
                if ($old_foto_profil && file_exists('./upload/foto_customer/' . $old_foto_profil)) {
                    unlink('./upload/foto_customer/' . $old_foto_profil);
                }

                $data['foto_profil'] = $new_file;

            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }

        } else {
            // Jika tidak upload baru → tetap pakai lama
            $data['foto_profil'] = $old_foto_profil;
        }

        $this->Customer_acount_model->update_customer($id_customer, $data);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Data berhasil diperbarui'
        ]);
    }


}