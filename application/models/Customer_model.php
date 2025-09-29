<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
 {
        // start datatables
        var $column_order = array(null, 'nama', 'email', 'telepon', 'jml_input');
        var $column_search = array('customer.nama', 'email', 'telepon', 'jml_input','perumahan.nama');
        var $order = array('id_customer' => 'asc');

    private function _get_datatables_query($role, $id) {

    if ($role == 'Admin') {

        $this->db->select('customer.*, customer.nama AS nama_cus, perumahan.nama AS nama_perum');
        $this->db->from('customer');
        $this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = customer.id_perum');
        $this->db->join('perumahan', 'perumahan.id_perum = customer.id_perum');
        $this->db->order_by('id_customer', 'desc');

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

        $this->db->select('customer.*, customer.nama AS nama_cus, perumahan.nama AS nama_perum');
        $this->db->from('customer');
        $this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = customer.id_perum');
        $this->db->join('perumahan', 'perumahan.id_perum = customer.id_perum');
        $this->db->where('marketing_perum.id_admin_marketing', $id);
        $this->db->order_by('id_customer', 'desc');

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

    function get_datatables($role, $id) {
        $this->_get_datatables_query($role, $id);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($role, $id) {
        $this->_get_datatables_query($role, $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($role, $id) {
        $this->_get_datatables_query($role, $id);
        return $this->db->count_all_results();
    }
    // end datatables

}