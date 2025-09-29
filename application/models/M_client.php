<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_client extends CI_Model
{
    function m_save_customer($data)
    {
        $result = $this->db->insert('customer', $data);
		return $result;
    }
}
