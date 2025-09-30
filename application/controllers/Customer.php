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

        $list = $this->Lead_model->get_datatablesvisit($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cus) {

            // tombol WA
            $whatsappUrl = 'https://api.whatsapp.com/send?phone=62' . $cus->no_tlp . '&text=Halo%20Kak%20' . $cus->nama_visit . ',%20Mengenai Hasil%20' . $cus->hasil_fu . ',%20Pada Tanggal%20' . $cus->tanggal . ',%20Apakah%20ada%20rencana%20lagi%20untuk%20Survey%3F%0A';
            $whatsappButton = '<a href="' . $whatsappUrl . '" class="btn bg-gradient-success btn-xs rounded-4" data-bs-toggle="tooltip" title="Chat via WhatsApp" target="_blank"><i class="fa fa-whatsapp"></i></a>';

            // tombol edit
            // $editButton = '&nbsp; <button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit" data-bs-toggle="modal" data-bs-target="#edit-data" data-id="'.$cus->id_visit.'" data-nama="'.$cus->nama_visit.'" data-tanggal="'.$cus->tanggal.'" data-no_tlp="'.$cus->no_tlp.'" data-unit="'.$cus->unit.'" data-kategori="'.$cus->kategori.'"  data-keterangan="'.$cus->keterangan.'" data-sumber="'.$cus->sumber.'" data-hasil_fu="'.$cus->hasil_fu.'"><i class="fa fa-pencil"></i></button>';
            $editButton = '&nbsp; <button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit" data-bs-toggle="modal" data-bs-target="#edit-data" data-id="'.$cus->id_visit.'" data-nama="'.$cus->nama_visit.'" data-tanggal="'.$cus->tanggal.'" data-no_tlp="'.$cus->no_tlp.'" data-unit="'.$cus->unit.'" data-kategori="'.$cus->kategori.'"  data-keterangan="'.$cus->keterangan.'" data-sumber="'.$cus->sumber.'" data-hasil_fu="'.$cus->hasil_fu.'" onclick="sendUnitToController(\''.$cus->unit.'\')"><i class="fa fa-pencil"></i></button>';

            $no++;
            $row = array();
            $row[] = $no.".";

            if ($role !== 'Marketing') {
                $row[] = $cus->nama_marketing;
            } else {

            }

            $row[] = $cus->nama_visit;
            $row[] = $cus->tanggal;
            $row[] = $cus->no_tlp;
            $row[] = $cus->nama_perum;
            $row[] = $cus->kategori;
            $row[] = $cus->keterangan;
            $row[] = $cus->sumber;
            $row[] = $cus->hasil_fu;
            $row[] = $whatsappButton. $editButton ;

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
            $whatsappUrl = 'https://api.whatsapp.com/send?phone=62' . $cus->no_tlp . '&text=Halo%20Kak%20' . $cus->nama_visit . ',%20Mengenai Hasil%20' . $cus->hasil_fu . ',%20Pada Tanggal%20' . $cus->tanggal . ',%20Apakah%20ada%20rencana%20lagi%20untuk%20Survey%3F%0A';
            $whatsappButton = '<a href="' . $whatsappUrl . '" class="btn bg-gradient-success btn-xs rounded-4" data-bs-toggle="tooltip" title="Chat via WhatsApp" target="_blank"><i class="fa fa-whatsapp"></i></a>';

            // tombol edit
            // $editButton = '&nbsp; <button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit" data-bs-toggle="modal" data-bs-target="#edit-data" data-id="'.$cus->id_visit.'" data-nama="'.$cus->nama_visit.'" data-tanggal="'.$cus->tanggal.'" data-no_tlp="'.$cus->no_tlp.'" data-unit="'.$cus->unit.'" data-kategori="'.$cus->kategori.'"  data-keterangan="'.$cus->keterangan.'" data-sumber="'.$cus->sumber.'" data-hasil_fu="'.$cus->hasil_fu.'"><i class="fa fa-pencil"></i></button>';
            $editButton = '&nbsp; <button type="button" class="btn bg-gradient-info btn-xs rounded-4 btn-edit" data-bs-toggle="modal" data-bs-target="#edit-data" data-id="'.$cus->id_visit.'" data-nama="'.$cus->nama_visit.'" data-tanggal="'.$cus->tanggal.'" data-no_tlp="'.$cus->no_tlp.'" data-unit="'.$cus->unit.'" data-kategori="'.$cus->kategori.'"  data-keterangan="'.$cus->keterangan.'" data-sumber="'.$cus->sumber.'" data-hasil_fu="'.$cus->hasil_fu.'" onclick="sendUnitToController(\''.$cus->unit.'\')"><i class="fa fa-pencil"></i></button>';

            $no++;
            $row = array();
            $row[] = $no.".";

            if ($role !== 'Marketing') {
                $row[] = $cus->nama_marketing;
            } else {

            }

            $row[] = $cus->nama_visit;
            $row[] = $cus->tanggal;
            $row[] = $cus->no_tlp;
            $row[] = $cus->nama_perum;
            $row[] = $cus->kategori;
            $row[] = $cus->keterangan;
            $row[] = $cus->sumber;
            $row[] = $cus->hasil_fu;
            $row[] = $whatsappButton. $editButton ;

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

        $result = $this->Visit_model->save_data($data);

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
        $id_denahs = $this->input->post('code');
        $nominal = $this->input->post('nominal');

        if (!empty($id)) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'tanggal' => $this->input->post('tanggal'),
                'no_tlp' => $this->input->post('no_tlp'),
                'unit' => $this->input->post('unit'),
                'kategori' => $this->input->post('kategori'),
                'keterangan' => $this->input->post('keterangan'),
                'sumber' => $this->input->post('sumber'),
                'hasil_fu' => $this->input->post('hasil_fu')
            );

            $data_denah = array(
                'type_unit' => $this->input->post('type_unit'),
                'type' => 'Dipesan',
                'color' => 'red',
            );

            $data_trans = array(
                'id_trans_denahs' => $id_denahs,
                'nama_cus' => $this->input->post('nama'),
                'tgl_trans' => $this->input->post('tanggal'),
                'status_trans' => $this->input->post('kategori'),
                'no_wa' => $this->input->post('no_tlp'),
                'nominal' => $this->input->post('nominal'),
            );


            $update_status = $this->Visit_model->update_data('visit', $data, $id);
            $update_denah = true;

            if ($update_status) {
                if (!empty($id_denahs)) {
                    $update_denah = $this->Visit_model->update_denah('denahs', $data_denah, $id_denahs);
                }

                $result = $this->Visit_model->save_trans($data_trans);

                if ($result) {
                    $response['status'] = true;
                    $response['message'] = 'Data berhasil diperbarui.';
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Gagal menyimpan transaksi.';
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'Gagal memperbarui data di database.';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'ID tidak valid. Data tidak dapat diperbarui.';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }



}