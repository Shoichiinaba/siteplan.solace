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
		// Ambil semua id_trans_denahs yang sudah DP atau Sold Out
		$this->db->select('DISTINCT(id_trans_denahs) as id_trans_denahs');
		$this->db->where_in('status_trans', ['DP', 'Sold Out']);
		$subquery = $this->db->get('transaksi')->result_array();
		$id_dilewati = array_column($subquery, 'id_trans_denahs');

		// Jika tidak ada DP/Sold Out, isi array kosong agar tidak error
		if (empty($id_dilewati)) {
			$id_dilewati = [0];
		}

		if ($role == 'Admin') {
			// Hitung hanya UTJ yang id_trans_denahs-nya belum ada di DP/Sold Out
			$this->db->where('status_trans', 'UTJ');
			$this->db->where_not_in('id_trans_denahs', $id_dilewati);
			$this->db->from('transaksi');
			return $this->db->count_all_results();

		} else if ($role == 'Marketing') {
			// Sama seperti Admin tapi join ke tabel marketing_perum
			$this->db->select('COUNT(DISTINCT transaksi.id_trans_denahs) as jumlah_record');
			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('transaksi.status_trans', 'UTJ');
			$this->db->where_not_in('transaksi.id_trans_denahs', $id_dilewati);
			$this->db->where('marketing_perum.id_admin_marketing', $id);

			$query = $this->db->get();
			$result = $query->row();
			return $result ? $result->jumlah_record : 0;
		}
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
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('transaksi.status_trans', 'Sold Out');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
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
			$this->db->where('mp.id_admin_marketing', $id);
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
			$this->db->where('mp.id_admin_marketing', $id);
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
			$this->db->where('mp.id_admin_marketing', $id);
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
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('transaksi.status_trans', 'Sold Out');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
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
			'Lead',
			'FU',
			'Minat Survey',
			'Sudah Survey',
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

			$this->db->select("*");
			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->where('transaksi.status_trans !=', 'Sold Out');
			$this->db->order_by('perumahan.id_perum', 'ASC');
			$this->db->order_by('transaksi.id_trans', 'DESC');
			// $this->db->limit($limit, $start);
			$query = $this->db->get();
			return $query->result();

		} else if ($role == 'Marketing') {
			$this->db->select("*");
			$this->db->from('transaksi');
			$this->db->join('denahs', 'denahs.id_denahs = transaksi.id_trans_denahs');
			$this->db->join('perumahan', 'perumahan.id_perum = denahs.id_perum');
			$this->db->join('marketing_perum', 'marketing_perum.id_perum_marketing = perumahan.id_perum');
			$this->db->where('marketing_perum.id_admin_marketing', $id);
			$this->db->where('transaksi.status_trans !=', 'Sold Out');
			$this->db->order_by('perumahan.id_perum', 'ASC');

			// $this->db->limit($limit, $start);
			$query = $this->db->get();
			return $query->result();
		}
	}
}