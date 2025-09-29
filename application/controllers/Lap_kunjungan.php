<?php
class Lap_kunjungan extends AUTH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Lap_model');
        $this->load->model('Lead_lap_model');
    }

    function index()
    {
        $this->load->library('pdfgenerator');

        $data['userdata'] 		= $this->userdata;
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $fil_unit = $this->input->get('fil_unit');
        $fil_kategori = $this->input->get('fil_kategori');
        $fil_sumber = $this->input->get('fil_sumber');
        $fil_daterange = $this->input->get('fil_daterange');
        $fil_marketing = $this->input->get('fil_marketing');

        $filteredData = $this->Lap_model->get_filtered_data($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);
        $data['title'] = "Laporan Data Customer";
        $data['filteredData'] = $filteredData;

        $file_pdf = 'laporan kunjungan customer';
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('page/customer/laporan_kunjungan', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function lead()
    {
        // $this->load->library('pdfgenerator');

        // $data['userdata'] 		= $this->userdata;
        // $id = $this->session->userdata('userdata')->id;
        // $role = $this->session->userdata('userdata')->role;
        // $fil_unit = $this->input->get('fil_unit');
        // $fil_kategori = $this->input->get('fil_kategori');
        // $fil_sumber = $this->input->get('fil_sumber');
        // $fil_daterange = $this->input->get('fil_daterange');
        // $fil_marketing = $this->input->get('fil_marketing');

        // $filteredData = $this->Lead_Lap_model->get_filtered_data($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);
        // $data['title'] = "Laporan Data Customer";
        // $data['filteredData'] = $filteredData;

        // $file_pdf = 'laporan kunjungan customer';
        // $paper = 'A4';
        // $orientation = "landscape";
        // $html = $this->load->view('page/customer/laporan_kunjungan', $data, true);
        // $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}