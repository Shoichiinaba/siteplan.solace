<?php
defined('BASEPATH') or exit('No direct script access allowed');


class FormDataModel extends CI_Model
{

    function m_perumahan()
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $query = $this->db->get();
        return $query->result();
    }
    function m_foto_perum($perum)
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $this->db->where('nama', $perum);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_status($perum)
    {
        $this->db->select('type, COUNT(*) as total');
        $this->db->from('denahs');
        $this->db->Join('perumahan', 'perumahan.id_perum = denahs.id_perum');
        $this->db->where('nama', $perum);
        $this->db->group_by('type');
        $query = $this->db->get();
        return $query->result();
    }

    public function simpanData($id_customer, $nama, $email, $domisili, $telepon, $tanggal_hari_ini, $jam_hari_ini, $id_perum)
    {
        // Periksa apakah data sudah ada dalam database
        $this->db->where('email', $email);
        $query = $this->db->get('customer');

        if ($query->num_rows() == 0) {
            // Data belum ada, simpan data ke tabel database
            $data = array(
                'id_customer' => $id_customer,
                'id_perum' => $id_perum,
                'nama' => $nama,
                'domisili' => $domisili,
                'telepon' => $telepon,
                'tanggal' => $tanggal_hari_ini,
                'jam' => $jam_hari_ini,
                'email' => $email,
                'jml_input' => 1 // Inisialisasi hitung dengan 1
            );
            $this->db->insert('customer', $data);

            return true; // Mengembalikan true jika data berhasil disimpan
        } else {
            // Data sudah ada, tambahkan hitung sebanyak 1
            $jml_input = $query->row()->jml_input + 1;

            $this->db->where('email', $email);
            $this->db->update('customer', array('jml_input' => $jml_input));

            return false; // Mengembalikan false karena data sudah ada
        }
    }

    function m_area_siteplan($perum)
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $this->db->Join('site_plan', 'site_plan.id_perum_siteplan = perumahan.id_perum');
        $this->db->where('nama', $perum);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDenahDetail($id_perum, $code)
    {
        $this->db->select('
            d.id_denahs, d.id_perum, d.code, d.type_unit, d.type, d.status_pembayaran, d.progres_berkas,
            p.nama AS nama_perumahan,
            t.id_trans, t.nama_cus, t.no_wa, t.status_trans,
            t.tgl_trans, t.nominal, t.nominal_dp, t.tahap, t.user_admin, t.tgl_update
        ');
        $this->db->from('denahs d');
        $this->db->join('perumahan p', 'p.id_perum = d.id_perum', 'left');
        $this->db->join('transaksi t', 't.id_trans_denahs = d.id_denahs', 'left');
        $this->db->where('d.id_perum', $id_perum);
        $this->db->where('d.code', $code);
        return $this->db->get()->result(); // ambil semua transaksi
    }


}