<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function update($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("admin", $data);

		return $this->db->affected_rows();
	}
	// Update Profil
	public function select($id = '')
	{
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get('admin');

		return $data->row();
	}

	function hapus($params = '')
	{
		$sql = "DELETE  FROM admin WHERE id = ? ";
		return $this->db->query($sql, $params);
	}

	function get_data_admin()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('role', 'Marketing');
		$query = $this->db->get();
		return $query->result();
	}

	function m_perumahan($id, $role)
	{
		if ($role == 'Admin') {
			$this->db->select('*');
			$this->db->from('perumahan');
			$query = $this->db->get();
			return $query->result();
		} else if ($role == 'Marketing') {

			$this->db->select('*');
			$this->db->from('marketing_perum');
			$this->db->Join('admin', 'admin.id = marketing_perum.id_admin_marketing');
			$this->db->Join('perumahan', 'perumahan.id_perum = marketing_perum.id_perum_marketing');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}
	}
	function m_area_siteplan()
	{
		$this->db->select('*');
		$this->db->from('site_plan');
		// $this->db->Join('site_plan', 'site_plan.id_perum_siteplan = perumahan.id_perum');
		// $this->db->where('admin.id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	function m_siteplan($perum, $area)
	{
		$this->db->select('*');
		$this->db->from('site_plan');
		$this->db->Join('perumahan', ' perumahan.id_perum = site_plan.id_perum_siteplan');
		$this->db->where('nama', $perum);
		$this->db->where('area', $area);
		$query = $this->db->get();
		return $query->result();
	}
	function m_type_unit($perum, $area)
	{
		$this->db->select('*');
		$this->db->from('site_plan');
		$this->db->Join('perumahan', ' perumahan.id_perum = site_plan.id_perum_siteplan');
		$this->db->Join('denahs', ' denahs.map = site_plan.id_siteplan');
		$this->db->where_in('type_unit', array('Komersil', 'Subsidi'));
		$this->db->where('nama', $perum);
		$this->db->where('area', $area);
		$this->db->group_by('type_unit');
		$query = $this->db->get();
		return $query->result();
	}

	function m_update_status_pembayaran($id_denahs, $status_pembayaran)
	{
		$update = $this->db->set('status_pembayaran', $status_pembayaran)
			->where('id_denahs', $id_denahs)
			->update('denahs');
		return $update;
	}

	function m_upload_document($data)
	{
		$result = $this->db->insert('upload', $data);
		return $result;
	}

	function m_update_document($id_doc_kapling, $select_document, $file_document, $user_admin, $tgl_update)
	{
		$update = $this->db->set($select_document, $file_document)
			->set('user_admin', $user_admin)
			->set('tgl_update', $tgl_update)
			->where('id_doc_kapling', $id_doc_kapling)
			->update('upload');
		return $update;
	}
	function m_update_progres($id_doc_kapling, $progres)
	{
		$update = $this->db->set('progres_berkas', $progres)
			->where('id_denahs', $id_doc_kapling)
			->update('denahs');
		return $update;
	}

	function m_delete_all_document($id_upload)
	{
		$delete = $this->db->where('id_upload', $id_upload)
			->delete('upload');
		return $delete;
	}
	function m_update_nama_cus($id, $nama_cus, $no_wa)
	{

		$update = $this->db->set('nama_cus', $nama_cus)
			->set('no_wa', $no_wa)
			->where('id_trans_denahs', $id)
			->update('transaksi');
		return $update;
	}

	function m_insert_sold_out($data)
	{
		$result = $this->db->insert('transaksi', $data);
		return $result;
	}
	function m_update_sold_out($id_trans, $tgl_trans, $user_admin, $tgl_update)
	{
		$update = $this->db->set('tgl_trans', $tgl_trans)
			->set('user_admin', $user_admin)
			->set('tgl_update', $tgl_update)
			->where('id_trans', $id_trans)
			->update('transaksi');
		return $update;
	}
	function m_upload_transaksi($data)
	{
		$result = $this->db->insert('transaksi', $data);
		return $result;
	}
	function m_update_transaksi($id_trans, $tgl_trans, $nominal, $user_admin, $tgl_update)
	{

		$update = $this->db->set('tgl_trans', $tgl_trans)
			->set('nominal', $nominal)
			->set('user_admin', $user_admin)
			->set('tgl_update', $tgl_update)
			->where('id_trans', $id_trans)
			->update('transaksi');
		return $update;
	}
	function m_delete_data_transaksi($id_trans)
	{
		$delete = $this->db->where('id_trans', $id_trans)
			->delete('transaksi');
		return $delete;
	}
}



/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */