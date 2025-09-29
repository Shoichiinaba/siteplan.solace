<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pdf extends CI_Controller
{
    public $pdfgenerator;
    public $input;
    public $M_pdf;
    public $uri;
    public $db;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pdf');
    }
    public function data()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        $seg_perum = $this->uri->segment(3);
        $area = $this->uri->segment(4);
        $code_unit = $this->uri->segment(5);
        $perum = preg_replace("![^a-z0-9]+!i", " ", $seg_perum);
        $sql = "SELECT *FROM perumahan, site_plan WHERE perumahan.id_perum = site_plan.id_perum_siteplan AND perumahan.nama = '$perum' AND site_plan.area = '$area'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id_map = $row->id_siteplan;
            }
        }
        $str_data = preg_replace("![^a-z0-9]+!i", ",", $code_unit);
        $id_denahs = ["'" . $str_data . "'"];
        $data['data_denahs'] = $this->M_pdf->m_data_laporan($id_map, $str_data);
        $data['group_type'] = $this->M_pdf->m_group_type($id_map, $str_data);
        $data['group_payout'] = $this->M_pdf->m_group_payout($id_map, $str_data);
        $data['data_test'] = explode(",", $str_data);
        // title dari pdf
        $data['_tittle'] = 'Laporan Penjualan Toko Kita';
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_penjualan_toko_kita';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('page/laporan_pdf', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
http://localhost/site_map/Laporan_pdf/data/6/Subsidi/A1-A10-A12/