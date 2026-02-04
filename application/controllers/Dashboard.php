<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Dashboard extends AUTH_Controller
{
    public $session;
    public $M_admin;
    public $Dashboard_Model;
    public $userdata;
    public $uri;
    public $input;
    public $db;
    public $output;

    var $template = 'templates/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->model('Dashboard_Model');
        $this->load->model('Denah_model');
    }

    public function index()
    {
        $id                         = $this->session->userdata('userdata')->id;
        $role                       = $this->session->userdata('userdata')->role;
        $data['perumahan']          = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan']      = $this->M_admin->m_area_siteplan();
        $data['bread']              = 'Dashboard';
        $data['jum_ready']          = $this->Dashboard_Model->jumlah_ready($role, $id);
        $data['jum_dipesan']        = $this->Dashboard_Model->jumlah_dipesan($role, $id);
        $data['jum_sold']           = $this->Dashboard_Model->jumlah_sold($role, $id);
        $data['jum_null']           = $this->Dashboard_Model->all_DP($role, $id);
        $data['tolp_ready']         = $this->Dashboard_Model->tooltip_ready($role, $id);
        $data['tolp_UTJ']           = $this->Dashboard_Model->tooltip_UTJ($role, $id);
        $data['tolp_DP']            = $this->Dashboard_Model->tooltip_DP($role, $id);
        $data['tolp_Sold']          = $this->Dashboard_Model->tooltip_sold($role, $id);
        $data['content']            = 'page/Dashboard_v';
        $data['script']             = 'page/dashboard/dashboard_js';
        $data['ambil']              = $this->userdata;
        $data['ChartData']          = $this->Dashboard_Model->getChartData($role, $id);
        $data['transaksi']          = $this->Dashboard_Model->getTransaksiByBulan();

        $this->load->view($this->template, $data);
    }

    public function detail()
    {
        $tittle = $this->uri->segment(3);
        $perum = preg_replace("![^a-z0-9]+!i", " ", $tittle);
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data['perumahan']          = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan']      = $this->M_admin->m_area_siteplan();
        $data['jum_UTJ']            = $this->Dashboard_Model->jumlah_UTJ($perum);
        $data['jum_DP']             = $this->Dashboard_Model->jumlah_DP($perum);
        $data['jum_sold']           = $this->Dashboard_Model->jum_sold($perum);
        $data['jum_ready']          = $this->Dashboard_Model->jum_ready($perum);
        $data['bread']              = 'Dashboard/ Detail';
        $data['content']            = 'page/Dashboard_det';
        $data['ambil']              = $this->userdata;
        $data['transaksi_det']      = $this->Dashboard_Model->getperumByBulan($perum);
        $data['Rmh_ready']          = $this->Dashboard_Model->readyByperum($perum);
        $this->load->view($this->template, $data);
    }

    function data_transaksi()
    {
        $draw = $this->input->get('draw');
        $start = ($this->input->get('start') != null) ? $this->input->get('start') : 0;
        $rowperpage = ($this->input->get('length') != null) ? $this->input->get('length') : 10;
        $order = ($this->input->get('order') != null) ? $this->input->get('order') : false;
        $search = ($this->input->get('search') != null && $this->input->get('search')['value'] != null) ? $this->input->get('search') : false;
        $status = $this->input->get('status');

        $model = new Denah_model;

        $totalRows = $model->count();
        $filteredRows = $totalRows;
        $id = $this->uri->segment(3);
        $perum = preg_replace("![^a-z0-9]+!i", " ", $id);

        $sql = "SELECT * FROM perumahan WHERE nama = '$perum'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id_perum = $row->id_perum;
            }
        }

        $model = $model->where('id_perum', $id_perum);

        if ($search) {
            $search = $search['value'];
            $model = $model->where(function ($query) use ($search) {
                $query->Where('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('type', 'LIKE', '%' . $search . '%')
                    ->orWhere('color', 'LIKE', '%' . $search . '%');
            });
        }
        $model = $model->where(function ($query) {
            $query->where('type', '!=', 'Rumah Ready')
                ->where('type', '!=', 'Kosong');
        });

        if ($status) {
            if ($status == 'UTJ' || $status == 'DP') {
                $id_denahs = [];

                // Ambil semua unit berdasarkan perumahan
                $sql = "SELECT transaksi.id_trans_denahs, transaksi.status_trans
                        FROM transaksi
                        JOIN denahs ON denahs.id_denahs = transaksi.id_trans_denahs
                        WHERE denahs.id_perum = '$id_perum'";
                $query = $this->db->query($sql);
                $transData = $query->result();

                // Kelompokkan status per id_denahs
                $grouped = [];
                foreach ($transData as $row) {
                    $grouped[$row->id_trans_denahs][] = $row->status_trans;
                }

                foreach ($grouped as $id_denah => $statusList) {
                    if ($status == 'DP') {
                        if (in_array('DP', $statusList) && !in_array('Sold Out', $statusList)) {
                            $id_denahs[] = $id_denah;
                        }
                    } elseif ($status == 'UTJ') {
                        if (in_array('UTJ', $statusList) && !in_array('DP', $statusList) && !in_array('Sold Out', $statusList)) {
                            $id_denahs[] = $id_denah;
                        }
                    }
                }

                if (empty($id_denahs)) {
                    $id_denahs = [0];
                }

                $model = $model->whereIn('id_denahs', $id_denahs);
            } else {
                $model = $model->where('type', $status);
            }
        }

        $filteredRows = $model->count();
        $model = $model->skip((int)$start);
        $model = $model->take((int)$rowperpage);

        if ($order) {
            foreach ($this->input->get('columns') as $key => $column) {
                $direction = ($order[0]['dir'] == 'asc') ? 'ASC' : 'DESC';
                if ($key == $order[0]['column']) {
                    $model = $model->orderBy($column['name'], $direction);
                }
            }
        }

        $results = $model->select('denahs.*')->get();

        $data_arr = [];
        foreach ($results as $result) {
            $id_denahs = $result->id_denahs;
            $color = '';
            if ($result->progres_berkas >= 1 && $result->progres_berkas <= 15) {
                $color = 'gradient-danger';
            } elseif ($result->progres_berkas > 15 && $result->progres_berkas <= 35) {
                $color = 'gradient-warning';
            } elseif ($result->progres_berkas > 35 && $result->progres_berkas <= 50) {
                $color = 'gradient-info';
            } elseif ($result->progres_berkas > 50 && $result->progres_berkas <= 100) {
                $color = 'gradient-success';
            }

            $data = [
                'code' => $result->code,
                'type' => '<span class="pup" style="background-color:' . $result->color . '"></span> ' . $result->type,
                'color' => '<div id="progres-' . $result->id_denahs . '" class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-sm font-weight-bold">' . $result->progres_berkas . '%</span>
                                    </div>
                                </div>
                                <div>
                                <div class="progress-bar bg-' . $color . '" role="progressbar" aria-valuenow="' . $result->progres_berkas . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $result->progres_berkas . '%;"></div>
                            </div>',
            ];

            $data['tgl_update'] = $result->tgl_update;
            $data['user_admin'] = $result->user_admin;

            $data_trans = [];
            $count = [];
            $performa = [];

            // Ambil transaksi per denah
            $sql = "SELECT * FROM transaksi WHERE id_trans_denahs = $id_denahs";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $tgl_UTJ = null;
                foreach ($query->result() as $row) {
                    if ($row->status_trans == 'UTJ') {
                        $data_trans[] = '<span class="border-transaksi me-1">' . $row->status_trans . '</span>';
                        $tgl_UTJ = strtotime(str_replace('/', '-', $row->tgl_trans));
                    } elseif ($row->status_trans == 'DP') {
                        $data_trans[] = '<span class="border-transaksi me-1">' . $row->status_trans . '</span>';
                    } elseif ($row->status_trans == 'Sold Out') {
                        $tgl_Sold = strtotime(str_replace('/', '-', $row->tgl_trans));
                        $performa = '<span class="badge bg-gradient-primary">' . floor(($tgl_Sold - $tgl_UTJ) / (60 * 60 * 24)) . '  Hari </span>';
                    }
                }

                if ($row->status_trans == 'Sold Out') {
                    $count[] = '<span class="bg-dur-sold-out">' . $row->status_trans . '</span>';
                } else {
                    $tgl = preg_replace("![^a-z0-9]+!i", "-", $row->tgl_trans);
                    date_default_timezone_set('Asia/Jakarta');
                    $awal  = date_create('' . $tgl . '');
                    $akhir = date_create();
                    $diff  = date_diff($akhir, $awal);

                    if ($diff->days >= '0' && $diff->days <= '14') {
                        $count[] = '<span class="badge bg-gradient-success">' . $diff->days . ' Hari</span>';
                    } else if ($diff->days >= '15' && $diff->days <= '22') {
                        $count[] = '<span class="badge bg-gradient-warning">' . $diff->days . ' Hari</span>';
                    } else if ($diff->days >= '23') {
                        $count[] = '<span class="badge bg-gradient-danger">' . $diff->days . ' Hari</span>';
                    }
                }
            }

            // 🔹 Ambil status pembayaran dari denahs
            $status_pembayaran = '';
            if (!empty($result->status_pembayaran)) {
                if ($result->status_pembayaran == 'cash') {
                    $status_pembayaran = '<span class="badge bg-gradient-success position-absolute end-0 top-0 me-2 mt-1">Cash</span>';
                } elseif ($result->status_pembayaran == 'kpr-kom') {
                    $status_pembayaran = '<span class="badge bg-gradient-info position-absolute end-0 top-0 me-2 mt-1">KPR</span>';
                }
            }

            // 🔹 Bungkus kiri-kanan (UTJ/DP kiri, Cash/KPR kanan)
            $data['transaction'] = '
            <div class="position-relative d-flex align-items-center">
                <div class="d-flex flex-wrap gap-1">
                    ' . implode('', $data_trans) . '
                </div>
                ' . $status_pembayaran . '
            </div>';

            $data['duration'] = $count;
            $data['performance'] = $performa;
            $data_arr[] = $data;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'draw' => $draw,
                'recordsTotal' => $totalRows,
                'recordsFiltered' => $filteredRows,
                'data' => $data_arr,
            ]));
    }

    function data_deadline()
    {
        $output = '';
        $this->load->model('dashboard_Model');
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data = $this->Dashboard_Model->data_deadline($role, $id);

        $count = 0;
        $utjDeadlines = [];

        if (!empty($data)) {
            foreach ($data as $row) {
                if ($row->type == 'Dipesan' && $row->status_trans == 'UTJ') {
                    $tgl = preg_replace("![^a-z0-9]+!i", "-", $row->tgl_trans);
                    date_default_timezone_set('Asia/Jakarta');
                    $awal  = date_create('' . $tgl . '');
                    $akhir = date_create();
                    $diff  = date_diff($akhir, $awal);
                    if ($row->progres_berkas <= '50') {
                        if ($diff->days >= 10) { // Perubahan kondisi di sini
                            $utjDeadlines[] = [
                                'row' => $row,
                                'days' => $diff->days
                            ];
                        }
                    }
                }
            }


            usort($utjDeadlines, function ($a, $b) {
                return $b['days'] - $a['days'];
            });

            // $output .= '<tbody>';

            foreach ($utjDeadlines as $deadline) {
                $row = $deadline['row'];
                $color = '';
                $data_trans = [];

                if ($row->progres_berkas >= 0 && $row->progres_berkas <= 15) {
                    $color = 'gradient-danger';
                } elseif ($row->progres_berkas > 15 && $row->progres_berkas <= 35) {
                    $color = 'gradient-warning';
                } elseif ($row->progres_berkas > 35 && $row->progres_berkas <= 50) {
                    $color = 'gradient-info';
                } elseif ($row->progres_berkas > 50 && $row->progres_berkas <= 100) {
                    $color = 'gradient-success';
                }

                $progressBar =
                    '<div>
                    <div>
                        <span class="text-xxs text-dark font-weight-bold">' . $row->progres_berkas . ' %</span>
                    </div>
                    <div class="progress w-90 h-100">
                        <div class="progress-bar bg-' . $color . '" role="progressbar" aria-valuenow="' . $row->progres_berkas . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->progres_berkas . '%;"></div>
                    </div>
                </div>';

                $colorClass = $deadline['days'] >= 10 ? 'bg-gradient-danger' : '';

                $output .= '<tr>';
                $output .= '<td class="code"><span class="border-transaksi">' . $row->code . '</span> <br> <span class="border-perum text-xxs font-weight-bold">' . $row->nama . '</span></td>';
                $output .= '<td class="text-center">';
                if ($row->status_trans == 'UTJ' || $row->status_trans == 'DP') {
                    $data_trans[] = '<span class="border-transaksi">' . $row->status_trans . '</span>';
                }

                if (!empty($data_trans)) {
                    foreach ($data_trans as $data) {
                        $output .= $data;
                    }
                }
                $output .= '</td>';

                $output .= '<td class="text-center">' . $progressBar . '</td>';
                $output .= '<td class="text-center"><span class="badge ' . $colorClass . ' text-xxs font-weight-bold">' . $deadline['days'] . ' Hari</span></td>';
                $whatsappNumber = preg_replace('/[^0-9]/', '', $row->no_wa);
                $formatNumber = '62' . $row->no_wa;
                $output .= '<td class="text-center"><a class="chat-wa" href="https://api.whatsapp.com/send?phone=' . $formatNumber . '"><i class="fa fa-whatsapp"></i></a></td>';
                $output .= '</tr>';

                $count++;

            }

        }

        echo $output;
    }
}