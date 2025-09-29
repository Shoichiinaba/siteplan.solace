<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SessionChecker
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function checkSession()
    {
        if (!$this->CI->session->userdata('logged_in')) {
            $this->CI->session->set_flashdata('Habis', 'Sesi Anda telah habis. Silakan login kembali.');
            redirect('Auth');
        }
    }
}
