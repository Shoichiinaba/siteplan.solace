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

    public function get_properti_customer($id_visit)
    {
        return $this->db
            ->select('visit.id_blok,
                    unit_progres.id_unit,
                    unit_progres.type,
                    unit_progres.ukuran,
                    denahs.id_perum,
                    denahs.id_denahs,
                    denahs.code,
                    perumahan.nama AS nama_perumahan')

            ->from('visit')
            ->join('unit_progres', 'unit_progres.id_unit = visit.id_blok', 'left')
            ->join('denahs', 'denahs.id_denahs = unit_progres.id_denahs', 'left')
            ->join('perumahan', 'perumahan.id_perum = denahs.id_perum', 'left')
            ->where('visit.id_visit', $id_visit)
            ->get()
            ->row();
    }

    public function get_progress_terakhir($id_unit)
    {
        return $this->db
            ->where('id_unit', $id_unit)
            ->order_by('minggu_ke', 'DESC')
            ->limit(1)
            ->get('tbl_progress_unit')
            ->row();
    }

    public function get_marketing_by_visit($id_visit)
    {
        return $this->db
            ->select('admin.id,
                    admin.nama,
                    admin.email,
                    admin.no_tlp,
                    admin.foto')
            ->from('visit')
            ->join('admin', 'admin.id = visit.id_marketing', 'left')
            ->where('visit.id_visit', $id_visit)
            ->get()
            ->row();
    }

    public function get_tahap_progress($id_unit)
    {
        $this->db->order_by('urutan', 'ASC');
        $tahap = $this->db->get('tbl_tahap')->result();

        $result = [];

        foreach ($tahap as $t) {

            $progress = $this->db
                ->where('id_unit', $id_unit)
                ->where('id_tahap', $t->id_tahap)
                ->order_by('minggu_ke', 'ASC')
                ->get('tbl_progress_unit')
                ->result();

            // ❗ Jika tidak ada progress, skip tahap ini
            if (empty($progress)) {
                continue;
            }

            foreach ($progress as $p) {
                $p->foto = $this->db
                    ->where('id_progres', $p->id_progress)
                    ->get('tbl_progress_foto')
                    ->result();
            }

            $t->progress = $progress;
            $result[] = $t;
        }

        return $result;
    }

}