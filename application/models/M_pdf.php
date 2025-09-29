<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pdf extends CI_Model
{

    function m_data_laporan($id_map, $str_data)
    {
        $this->db->select('*');
        $this->db->from('denahs');
        $this->db->where('map', $id_map);
        $this->db->where_in('code', explode(",", $str_data));
        $query = $this->db->get();
        return $query->result();
    }
    function m_group_type($id_map, $str_data)
    {
        $this->db->select('*');
        $this->db->from('denahs');
        $this->db->where('map', $id_map);
        $this->db->where_in('code', explode(",", $str_data));
        $this->db->group_by('type_unit');
        $this->db->group_by('status_pembayaran');
        $query = $this->db->get();
        return $query->result();
    }
    function m_group_payout($id_map, $str_data)
    {
        $this->db->select('*');
        $this->db->from('denahs');
        $this->db->where('map', $id_map);
        $this->db->where_in('code', explode(",", $str_data));
        $this->db->group_by('status_pembayaran');
        $query = $this->db->get();
        return $query->result();
    }
}