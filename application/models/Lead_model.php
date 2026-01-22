<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lead_model extends CI_Model
 {
        // start datatables
        var $column_order = array(null, 'nama_visit', 'tanggal', 'no_tlp', 'sumber','hasil_fu', 'keterangan','nama_perum');
        var $column_search = array('visit.nama', 'tanggal', 'no_tlp', 'sumber','perumahan.nama', 'keterangan', 'hasil_fu');
        var $order = array('id_visit' => 'asc');

     private function _get_datatables_query($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing) {

    if ($role == 'Admin') {

        $this->db->select('visit.*, visit.nama AS nama_visit, perumahan.nama AS nama_perum, admin.nama AS nama_marketing');
        $this->db->from('visit');
        $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
        $this->db->join('admin', 'admin.id = visit.id_marketing');
        $this->db->where_in('visit.kategori', ['Lead', 'FU', 'Minat Survey']);
        $this->db->order_by('id_visit', 'desc');

        if ($fil_unit) {
            $this->db->where('visit.unit', $fil_unit);
        }
        if ($fil_kategori !== '') {
            $this->db->where('visit.kategori', $fil_kategori);
        }
        if ($fil_sumber !== '') {
            $this->db->where('visit.sumber', $fil_sumber);
        }
        if ($fil_marketing !== '') {
            $this->db->where('visit.id_marketing', $fil_marketing);
        }
        if ($fil_daterange) {
            $dateRange = explode(' - ', $fil_daterange);
            $startDate = $dateRange[0];
            $endDate = $dateRange[1];
            $this->db->where('visit.tanggal >=', $startDate);
            $this->db->where('visit.tanggal <=', $endDate);
        }

            $i = 0;
            foreach ($this->column_search as $item) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }

    } else if ($role == 'Marketing') {

        $this->db->select('visit.*, visit.nama AS nama_visit, perumahan.nama AS nama_perum');
        $this->db->from('visit');
        $this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = visit.unit');
        $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
        $this->db->where('marketing_perum.id_admin_marketing', $id);
        $this->db->where('visit.id_marketing', $id);
        $this->db->where_in('visit.kategori', ['Lead', 'FU', 'Minat Survey']);
        $this->db->order_by('id_visit', 'desc');


        if ($fil_unit) {
            $this->db->where('visit.unit', $fil_unit);
        }
        if ($fil_kategori !== '') {
            $this->db->where('visit.kategori', $fil_kategori);
        }
        if ($fil_sumber !== '') {
            $this->db->where('visit.sumber', $fil_sumber);
        }

        if (!empty($fil_daterange) && strpos($fil_daterange, ' - ') !== false) {
            $dateRange = explode(' - ', $fil_daterange);

            if (count($dateRange) === 2) {
                $startDate = trim($dateRange[0]);
                $endDate   = trim($dateRange[1]);

                if ($startDate !== '' && $endDate !== '') {
                    $this->db->where('visit.tanggal >=', $startDate);
                    $this->db->where('visit.tanggal <=', $endDate);
                }
            }
        }

            $i = 0;
            foreach ($this->column_search as $item) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }

    // di dalam model (Lead_model.php)
    public function get_datatableslead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing, $no_limit = false )
    {
        // bangun query dasar (pakai function _get_datatables_query yang sudah ada)
        $this->_get_datatables_query($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);

        // Jangan apply limit jika $no_limit = true
        if (!$no_limit && isset($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filteredlead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing)
    {
        $this->_get_datatables_query($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // count_allvisit: hitung total (tanpa search), pastikan logika where sama seperti di _get_datatables_query
    public function count_alllead($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing)
    {
        $this->db->from('visit');

        if ($role == 'Admin') {

            $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
            $this->db->join('admin', 'admin.id = visit.id_marketing');
            $this->db->where_in('visit.kategori', ['Lead', 'FU', 'Minat Survey']);

            if (!empty($fil_unit)) {
                $this->db->where('visit.unit', $fil_unit);
            }

            if (!empty($fil_kategori)) {
                $this->db->where('visit.kategori', $fil_kategori);
            }

            if (!empty($fil_sumber)) {
                $this->db->where('visit.sumber', $fil_sumber);
            }

            if (!empty($fil_marketing)) {
                $this->db->where('visit.id_marketing', $fil_marketing);
            }

        } else if ($role == 'Marketing') {

            $this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = visit.unit');
            $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
            $this->db->where('marketing_perum.id_admin_marketing', $id);
            $this->db->where('visit.id_marketing', $id);
            $this->db->where_in('visit.kategori', ['Lead', 'FU', 'Minat Survey']);

            if (!empty($fil_unit)) {
                $this->db->where('visit.unit', $fil_unit);
            }

            if (!empty($fil_kategori)) {
                $this->db->where('visit.kategori', $fil_kategori);
            }

            if (!empty($fil_sumber)) {
                $this->db->where('visit.sumber', $fil_sumber);
            }
        }

        // ✅ FILTER TANGGAL (AMAN, ANTI OFFSET & SQL ERROR)
        if (!empty($fil_daterange) && strpos($fil_daterange, ' - ') !== false) {
            $dateRange = explode(' - ', $fil_daterange);

            if (count($dateRange) === 2) {
                $startDate = trim($dateRange[0]);
                $endDate   = trim($dateRange[1]);

                if ($startDate !== '' && $endDate !== '') {
                    $this->db->where('visit.tanggal >=', $startDate);
                    $this->db->where('visit.tanggal <=', $endDate);
                }
            }
        }

        return $this->db->count_all_results();
    }

    function save_lead($data)
    {
        return $this->db->insert('visit', $data);
    }

    function update_data($table,$data,$id)
	{
		$this->db->where('id_visit', $id);
		return $this->db->update($table, $data);
    }

    function update_denah($table, $data, $id_denahs)
    {
        $this->db->where('id_denahs', $id_denahs);

        if (!$this->db->update($table, $data)) {
            $error = $this->db->error();
            print_r($error);
        }

        return $this->db->affected_rows();
    }

    function save_trans($data)
    {
        return $this->db->insert('transaksi', $data);
    }


    public function get_kapling($id_perum)
    {
        $result = $this->db
            ->select('id_denahs, code')
            ->from('denahs')
            ->where('id_perum', $id_perum)
            ->where('type', 'Kosong')
            ->get()
            ->result();

        return $result;
    }

}