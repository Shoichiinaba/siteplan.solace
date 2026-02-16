<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progres_model extends CI_Model
{
    public function get_unit_pro($limit = 12, $start = 0, $search = '', $id_agent)
    {
        if ($start < 0) $start = 0;

        $this->db->select('
            unit_progres.id_unit AS id_unit_progres,
            unit_progres.ukuran AS ukuran_denah,
            unit_progres.type AS type_unit,
            denahs.code,
            MAX(tbl_progress_unit.persen) AS persen
        ');

        $this->db->from('unit_progres');
        $this->db->join('denahs','denahs.id_denahs = unit_progres.id_denahs','left');
        $this->db->join(
            'tbl_progress_unit',
            'tbl_progress_unit.id_unit = unit_progres.id_unit',
            'left'
        );

        // 🔥 LOGIKA FINAL
        if ($id_agent !== 0) {
            $this->db->where('unit_progres.id_agent', $id_agent);
        }

        if (!empty($search)) {
            $this->db->like('denahs.code', $search);
        }

        $this->db->group_by('unit_progres.id_unit');
        $this->db->order_by('unit_progres.id_unit','ASC');
        $this->db->limit($limit,$start);

        return $this->db->get()->result();
    }

    // ===============================
    // HITUNG TOTAL DATA
    // ===============================
    public function count_unit($search = '', $id_agent)
    {
        $this->db->from('unit_progres');
        $this->db->join(
            'denahs',
            'denahs.id_denahs = unit_progres.id_denahs',
            'left'
        );

        // 🔒 FILTER AGENT
        $this->db->where('unit_progres.id_agent', $id_agent);

        if (!empty($search)) {
            $this->db->like('denahs.code', $search);
        }

        return $this->db->count_all_results();
    }

    public function get_tahap()
    {
        return $this->db->order_by('urutan','ASC')
                        ->get('tbl_tahap')->result();
    }

    public function insert_progress($data)
    {
        $this->db->insert('tbl_progress_unit',$data);
    }

   public function getTimelineUnit($id_unit)
    {
        // 1️⃣ Ambil semua tahap
        $tahap = $this->db
            ->order_by('urutan', 'ASC')
            ->get('tbl_tahap')
            ->result_array();

        foreach ($tahap as &$t) {

            // 2️⃣ Ambil progress per tahap
            $progress = $this->db
                ->where('id_unit', $id_unit)
                ->where('id_tahap', $t['id_tahap'])
                ->order_by('id_progress', 'ASC')
                ->get('tbl_progress_unit')
                ->result_array();

            // 3️⃣ Ambil foto untuk setiap progress
            foreach ($progress as &$p) {

                $p['foto'] = $this->db
                    ->where('id_progres', $p['id_progress'])
                    ->get('tbl_progress_foto')
                    ->result_array();
            }

            $t['progress'] = $progress;

            // 4️⃣ SIMPAN ID PROGRESS TERAKHIR
            if (!empty($progress)) {
                $last = end($progress);
                $t['last_progress_id'] = $last['id_progress'];
            } else {
                $t['last_progress_id'] = null;
            }
        }

        return $tahap;
    }

}