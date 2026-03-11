<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{
	// jumlah dasboard utama
	public function jumlah_ready($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->where('type', 'Rumah Ready');
			$this->db->from('denahs');
			return $this->db->count_all_results();
		} else if ($role == 'Marketing') {
			$this->db->where('type', 'Rumah Ready');
			$this->db->from('denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
			return $this->db->count_all_results();
		}
	}

	public function jumlah_dipesan($role, $id)
	{
		if ($role == 'Admin') {

			$sql = "
			SELECT COUNT(*) jumlah
			FROM transaksi t
			WHERE t.status_trans = 'UTJ'
			AND t.id_trans = (
				SELECT MAX(t2.id_trans)
				FROM transaksi t2
				WHERE t2.id_trans_denahs = t.id_trans_denahs
			)
			";

		} else {

			$sql = "
			SELECT COUNT(*) jumlah
			FROM transaksi t
			WHERE t.status_trans = 'UTJ'
			AND t.id_marketing = '$id'
			AND t.id_trans = (
				SELECT MAX(t2.id_trans)
				FROM transaksi t2
				WHERE t2.id_trans_denahs = t.id_trans_denahs
			)
			";
		}

		return $this->db->query($sql)->row()->jumlah;
	}

	public function jumlah_sold($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->where('status_trans', 'Sold Out');
			$this->db->from('transaksi');
			return $this->db->count_all_results();
		} else if ($role == 'Marketing') {
			$this->db->select('transaksi.status_trans, COUNT(*) as jumlah_record');
			$this->db->from('transaksi');
			$this->db->where('transaksi.status_trans', 'Sold Out');
			$this->db->where('transaksi.id_marketing', $id);
			return $this->db->count_all_results();
		}
	}

	public function all_DP($role, $id)
	{
		if ($role == 'Admin') {
			// Hitung DP unik berdasarkan id_trans_denahs yang belum Sold Out
			$this->db->select('COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->where('t.status_trans', 'DP');
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans = "Sold Out")', null, false);
			$query = $this->db->get();
			$result = $query->row();
			return $result ? (int)$result->jumlah_record : 0;

		} else if ($role == 'Marketing') {
			// Hitung DP unik per marketing berdasarkan id_trans_denahs yang belum Sold Out
			$this->db->select('COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->join('denahs d', 'd.id_denahs = t.id_trans_denahs');
			$this->db->join('perumahan p', 'p.id_perum = d.id_perum');
			$this->db->join('marketing_perum mp', 'mp.id_perum_marketing = p.id_perum');
			$this->db->where('t.status_trans', 'DP');
			$this->db->where('t.id_marketing', $id);
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans = "Sold Out")', null, false);
			$query = $this->db->get();
			$result = $query->row();
			return $result ? (int)$result->jumlah_record : 0;
		}
	}

	// tooltip
	public function tooltip_ready($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->where('denahs.type', 'Rumah Ready');
			$this->db->group_by('perumahan.nama');
			return $this->db->get()->result();
		} else if ($role == 'Marketing') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('denahs.type', 'Rumah Ready');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
			$this->db->group_by('perumahan.nama');
			return $this->db->get()->result();
		}
	}

	public function tooltip_UTJ($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->select('p.nama, COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->join('denahs d', 'd.id_denahs = t.id_trans_denahs');
			$this->db->join('perumahan p', 'p.id_perum = d.id_perum');
			$this->db->where('t.status_trans', 'UTJ');
			// Jangan hitung kalau id_trans_denahs sudah punya DP atau Sold Out
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans IN ("DP", "Sold Out"))', null, false);
			$this->db->group_by('p.nama');
			$query = $this->db->get();
			return $query->result();

		} else if ($role == 'Marketing') {
			$this->db->select('p.nama, COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->join('denahs d', 'd.id_denahs = t.id_trans_denahs');
			$this->db->join('perumahan p', 'p.id_perum = d.id_perum');
			$this->db->join('marketing_perum mp', 'mp.id_perum_marketing = p.id_perum');
			$this->db->where('t.status_trans', 'UTJ');
			$this->db->where('t.id_marketing', $id);
			// Jangan hitung kalau id_trans_denahs sudah punya DP atau Sold Out
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans IN ("DP", "Sold Out"))', null, false);
			$this->db->group_by('p.nama');
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function tooltip_DP($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->select('p.nama, COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->join('denahs d', 'd.id_denahs = t.id_trans_denahs');
			$this->db->join('perumahan p', 'p.id_perum = d.id_perum');
			$this->db->where('t.status_trans', 'DP');
			// Jangan hitung jika sudah ada transaksi Sold Out
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans = "Sold Out")', null, false);
			$this->db->group_by('p.nama');
			$query = $this->db->get();
			return $query->result();

		} else if ($role == 'Marketing') {
			$this->db->select('p.nama, COUNT(DISTINCT t.id_trans_denahs) AS jumlah_record', false);
			$this->db->from('transaksi t');
			$this->db->join('denahs d', 'd.id_denahs = t.id_trans_denahs');
			$this->db->join('perumahan p', 'p.id_perum = d.id_perum');
			$this->db->join('marketing_perum mp', 'mp.id_perum_marketing = p.id_perum');
			$this->db->where('t.status_trans', 'DP');
			$this->db->where('t.id_marketing', $id);
			// Jangan hitung jika sudah ada transaksi Sold Out
			$this->db->where('t.id_trans_denahs NOT IN (SELECT id_trans_denahs FROM transaksi WHERE status_trans = "Sold Out")', null, false);
			$this->db->group_by('p.nama');
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function tooltip_sold($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->where('transaksi.status_trans', 'Sold Out');
			$this->db->group_by('perumahan.nama');
			return $this->db->get()->result();
		} else if ($role == 'Marketing') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->where('transaksi.status_trans', 'Sold Out');
			$this->db->where('transaksi.id_marketing', $id);
			$this->db->group_by('perumahan.nama');
			return $this->db->get()->result();
		}
	}
	// akrir tooltip
	// dasboard utama

	// dashboard atas detail
	public function jumlah_UTJ($perum)
	{
		$this->db->select('COUNT(DISTINCT t1.id_trans_denahs) AS jumlah_record', false);
		$this->db->from('transaksi t1');
		$this->db->join('denahs', 'denahs.id_denahs = t1.id_trans_denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');

		// hanya ambil transaksi UTJ
		$this->db->where('t1.status_trans', 'UTJ');
		// hanya denah yang bertipe 'dipesan'
		$this->db->where('denahs.type', 'dipesan');
		// nama perumahan sesuai parameter
		$this->db->where('perumahan.nama', $perum);

		//  exclude denah yang juga punya transaksi DP
		$this->db->where("t1.id_trans_denahs NOT IN (
			SELECT id_trans_denahs
			FROM transaksi
			WHERE status_trans = 'DP'
		)", null, false);

		$query = $this->db->get();
		$row = $query->row();
		return $row ? (int)$row->jumlah_record : 0;
	}

	public function jumlah_DP($perum)
	{
		$this->db->select('COUNT(DISTINCT transaksi.id_trans_denahs) AS jumlah_record', false);
		$this->db->from('transaksi');
		$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
		$this->db->where('transaksi.status_trans', 'DP');
		$this->db->where('denahs.type', 'dipesan');
		$this->db->where('perumahan.nama', $perum);

		$query = $this->db->get();
		$result = $query->row();
		return $result ? (int)$result->jumlah_record : 0;
	}

	public function jum_sold($perum)
	{
		$this->db->select('transaksi.status_trans, COUNT(*) as jumlah_record');
		$this->db->from('transaksi');
		$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
		$this->db->where('transaksi.status_trans', 'Sold Out');
		$this->db->where('perumahan.nama', $perum);
		return $this->db->count_all_results();
	}

	public function jum_ready($perum)
	{
		$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
		$this->db->from('denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
		$this->db->where('denahs.type', 'Rumah Ready');
		$this->db->where('perumahan.nama', $perum);
		return $this->db->count_all_results();
	}
	// akhir dashboard detail

	public function getChartData($role, $id)
	{
		if ($role == 'Admin') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->where('denahs.type', 'Rumah Ready');
			$this->db->group_by('perumahan.nama');
			$query = $this->db->get();

			$result = $query->result();

			$chartData = array();
			foreach ($result as $row) {
				$data = array(
					'label' => $row->nama,
					'value' => $row->jumlah_record
				);
				array_push($chartData, $data);
			}

			return $chartData;
		} else if ($role == 'Marketing') {
			$this->db->select('perumahan.nama, COUNT(*) as jumlah_record');
			$this->db->from('denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('denahs.type', 'Rumah Ready');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
			$this->db->group_by('perumahan.nama');
			$query = $this->db->get();

			$result = $query->result();

			$chartData = array();
			foreach ($result as $row) {
				$data = array(
					'label' => $row->nama,
					'value' => $row->jumlah_record
				);
				array_push($chartData, $data);
			}

			return $chartData;
		}
	}

	public function getTransaksiByBulan()
	{
		$this->db->select('
					MONTHNAME(STR_TO_DATE(tgl_trans, "%d/%m/%Y")) AS bulan,
					transaksi.status_trans,
					perumahan.id_perum,
					CASE
						WHEN transaksi.status_trans = "DP"
							THEN COUNT(DISTINCT transaksi.id_trans_denahs)
						ELSE COUNT(*)
					END AS jumlah
				', false);

			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->group_by('perumahan.id_perum, bulan, transaksi.status_trans');
			$this->db->where_in('transaksi.status_trans', [
			'UTJ',
			'DP',
			'Sold Out'
		]);

			$query = $this->db->get();
			return $query->result();
	}

	public function getperumByBulan($perum)
	{
		$this->db->select('
				MONTHNAME(STR_TO_DATE(tgl_trans, "%d/%m/%Y")) AS bulan,
				transaksi.status_trans,
				perumahan.id_perum,
				CASE
					WHEN transaksi.status_trans = "DP"
						THEN COUNT(DISTINCT transaksi.id_trans_denahs)
					ELSE COUNT(*)
				END AS jumlah
			', false);

		$this->db->from('transaksi');
		$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
		$this->db->where('perumahan.nama', $perum);
		$this->db->group_by('perumahan.id_perum, bulan, transaksi.status_trans');

		$query = $this->db->get();
		return $query->result();
	}

	public function readyByperum($perum)
	{
		$this->db->select('denahs.type, COUNT(*) as jumlah_record');
		$this->db->from('denahs');
		$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
		$this->db->where('denahs.type', 'Rumah Ready');
		$this->db->where('perumahan.nama', $perum);
		$this->db->group_by('denahs.type');
		$query = $this->db->get();

		$result = $query->result();

		$chartData = array();
		foreach ($result as $row) {
			$data = array(
				'label' => $row->type,
				'value' => $row->jumlah_record
			);
			array_push($chartData, $data);
		}

		return $chartData;
	}


	public function data_deadline($role, $id)
	{

		if ($role == 'Admin') {

			$sql = "
			SELECT t.*, d.*, p.nama
			FROM transaksi t
			JOIN denahs d ON d.id_denahs = t.id_trans_denahs
			JOIN perumahan p ON p.id_perum = d.id_perum
			WHERE t.id_trans = (
				SELECT MAX(t2.id_trans)
				FROM transaksi t2
				WHERE t2.id_trans_denahs = t.id_trans_denahs
			)
			AND t.status_trans != 'Sold Out'
			ORDER BY p.id_perum ASC
			";

			return $this->db->query($sql)->result();

		}
		else if ($role == 'Marketing') {

			$sql = "
			SELECT t.*, d.*, p.nama
			FROM transaksi t
			JOIN denahs d ON d.id_denahs = t.id_trans_denahs
			JOIN perumahan p ON p.id_perum = d.id_perum
			WHERE t.id_marketing = '$id'
			AND t.id_trans = (
				SELECT MAX(t2.id_trans)
				FROM transaksi t2
				WHERE t2.id_trans_denahs = t.id_trans_denahs
			)
			AND t.status_trans != 'Sold Out'
			ORDER BY p.id_perum ASC
			";

			return $this->db->query($sql)->result();
		}
	}
}