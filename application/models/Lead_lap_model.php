<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lead_Lap_model extends CI_Model
{
    private $table = 'visit';
    private $column_search = array('visit.nama', 'visit.tanggal', 'visit.no_tlp', 'visit.unit', 'visit.kategori', 'visit.keterangan', 'visit.sumber', 'visit.hasil_fu');
    private $column_order = array(null, 'visit.nama', 'visit.tanggal', 'visit.no_tlp', 'visit.unit', 'visit.kategori', 'visit.keterangan', 'visit.sumber', 'visit.hasil_fu');

    public function get_filtered_data($role, $id, $fil_unit, $fil_kategori, $fil_sumber, $fil_daterange, $fil_marketing)
    {
        if ($role == 'Admin') {

            $this->db->select('visit.*, visit.nama AS nama_visit, perumahan.nama AS nama_perum, admin.nama AS nama_marketing');
            $this->db->from('visit');
            $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
            $this->db->join('admin', 'admin.id = visit.id_marketing');
            $this->db->where_not_in('visit.kategori', ['Sudah Survey', 'Tidak Prospek', 'Prospek', 'UTJ']);
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

            if ($fil_daterange !== '') {
                $dateRange = explode(' - ', $fil_daterange);
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
                $this->db->where('visit.tanggal >=', $startDate);
                $this->db->where('visit.tanggal <=', $endDate);
            }

            $i = 0;
            foreach ($this->column_search as $item) {
                if (isset($_POST['search']) && isset($_POST['search']['value'])) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }

        } else if ($role == 'Marketing') {

            $this->db->select('visit.*, visit.nama AS nama_visit, perumahan.nama AS nama_perum');
            $this->db->from($this->table);
            $this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = visit.unit');
            $this->db->join('perumahan', 'perumahan.id_perum = visit.unit');
            $this->db->where('marketing_perum.id_admin_marketing', $id);
            $this->db->where('visit.id_marketing', $id);
            $this->db->where_not_in('visit.kategori', ['Sudah Survey', 'Tidak Prospek', 'Prospek', 'UTJ']);
            $this->db->order_by('visit.id_visit', 'desc');

            if ($fil_unit) {
                $this->db->where('visit.unit', $fil_unit);
            }
            if ($fil_kategori !== '') {
                $this->db->where('visit.kategori', $fil_kategori);
            }
            if ($fil_sumber !== '') {
                $this->db->where('visit.sumber', $fil_sumber);
            }
            if ($fil_daterange !== '') {
                $dateRange = explode(' - ', $fil_daterange);
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
                $this->db->where('visit.tanggal >=', $startDate);
                $this->db->where('visit.tanggal <=', $endDate);
            }

            $i = 0;
            foreach ($this->column_search as $item) {
                if (isset($_POST['search']) && isset($_POST['search']['value'])) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }
}