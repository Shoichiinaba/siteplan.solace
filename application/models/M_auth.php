<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function login($user, $pass) {

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $user);
		$this->db->where('password', md5($pass)
	);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}

	}

	public function login_cus($user, $pass)
	{
		$user = trim($user);

		$query = $this->db
			->select('id, username, password')
			->from('customer_account')
			->where('username', $user)
			->limit(1)
			->get();

		if ($query->num_rows() !== 1) {
			return false;
		}

		$row = $query->row();

		// Cek jika akun nonaktif (opsional kalau ada field status)
		if (isset($row->status) && $row->status != 'active') {
			return false;
		}

		// Verifikasi password
		if (!password_verify($pass, $row->password)) {
			return false;
		}

		// Jika hash lama perlu di-upgrade
		if (password_needs_rehash($row->password, PASSWORD_BCRYPT)) {

			$newHash = password_hash($pass, PASSWORD_BCRYPT);

			$this->db->where('id_customer', $row->id_customer);
			$this->db->update('customer_account', [
				'password' => $newHash
			]);
		}

		return $row;
	}


}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */