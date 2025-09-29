<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;

// class Home extends AUTH_Controller
class Home extends CI_Controller
{
    public $input;
    public $output;
    public $Denah_model;
    public $M_admin;
    public $uri;
    public $db;
    public $upload;
    public $session;

    var $template = 'templates/index';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Denah_model');
        $this->load->model('M_admin');
        $this->load->helper('url');
    }

    public function visit()
    {
        $tittle = $this->uri->segment(3);
        $area = $this->uri->segment(4);
        $perum = preg_replace("![^a-z0-9]+!i", " ", $tittle);
        $id = $this->session->userdata('userdata')->id;
        $role = $this->session->userdata('userdata')->role;
        $data['perumahan'] = $this->M_admin->m_perumahan($id, $role);
        $data['area_siteplan'] = $this->M_admin->m_area_siteplan();
        $data['siteplan'] = $this->M_admin->m_siteplan($perum, $area);
        $data['type_unit'] = $this->M_admin->m_type_unit($perum, $area);
        $data['bread']          = 'Map Plan ' . $area;
        $data['content']        = 'page/index';
        $this->load->view($this->template, $data);
    }

    public function inputDenah()
    {
        $ids = $this->input->post('id');
        $defaultColor = "#e6e7e8";
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $denah = new Denah_model;
                $denah->code = $id;
                $denah->description = '';
                $denah->type = 'default';
                $denah->color = $defaultColor;
                $denah->save();
            }
        }
    }

    public function allDenahColor()
    {
        $perumahanNama = $this->uri->segment(3);
        $perum = preg_replace("![^a-z0-9]+!i", " ", $perumahanNama);

        $sql = "SELECT *FROM perumahan WHERE nama='$perum'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id = $row->id_perum;
                $ids = Denah_model::where('id_perum', $id)->get();
                // //     $ids = Denah_model::all();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode([
                        'message' => '',
                        'results' => $ids->toArray(),
                    ]));
            }
        }
        // echo $id;
    }

    function change_denah()
    {
        // $this->load_db_connection();
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $type_unit = $this->input->post('type_unit');
        $type = $this->input->post('type');
        $desc = $this->input->post('desc');
        $nama_cus = $this->input->post('nama_cus');
        $no_wa = $this->input->post('no_wa');
        $tgl_trans = $this->input->post('tgl_trans');
        $user_admin = $this->session->userdata('userdata')->nama;
        $tgl_update = date("d/m/Y | H:i:s");

        $color = '#e6e7e8';
        if ($type == 'Dipesan') {
            $color = 'red';
        } elseif ($type == 'Sold Out') {
            $color = 'yellow';
        } elseif ($type == 'Rumah Ready') {
            $color = '#00b4ff';
        }
        if ($type == 'Kosong') {

            $sql = "SELECT *FROM denahs, upload WHERE denahs.id_denahs = upload.id_doc_kapling AND denahs.id_denahs='$id'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $id_upload = $row->id_upload;
                    $id_doc_kapling = $row->id_denahs;
                    $progres = '0';
                    if ($row->ktp == '') {
                    } else {
                        unlink('./upload/doc/' . $row->ktp);
                    }
                    if ($row->kk == '') {
                    } else {
                        unlink('./upload/doc/' . $row->kk);
                    }
                    if ($row->npwp == '') {
                    } else {
                        unlink('./upload/doc/' . $row->npwp);
                    }
                    if ($row->skk == '') {
                    } else {
                        unlink('./upload/doc/' . $row->skk);
                    }
                    if ($row->slip_g == '') {
                    } else {
                        unlink('./upload/doc/' . $row->slip_g);
                    }
                    if ($row->rek_koran == '') {
                    } else {
                        unlink('./upload/doc/' . $row->rek_koran);
                    }
                    if ($row->blanko == '') {
                    } else {
                        unlink('./upload/doc/' . $row->blanko);
                    }
                    if ($row->pas_foto == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->pas_foto);
                    }

                    if ($row->spt == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->spt);
                    }

                    if ($row->doc1 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc1);
                    }

                    if ($row->doc2 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc2);
                    }

                    if ($row->doc3 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc3);
                    }

                    if ($row->doc4 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc4);
                    }

                    if ($row->doc5 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc5);
                    }

                    if ($row->doc6 == '') {
                    } else {
                        unlink('.uppload/doc/' . $row->doc6);
                    }
                }
                $this->M_admin->m_delete_all_document($id_upload);
                // $this->M_admin->m_update_progres($id_doc_kapling, $progres);
            };

            $denah = Denah_model::where('id_denahs', $id)
                ->update([
                    'type_unit' => $type_unit,
                    'type' => $type,
                    'description' => '',
                    'color' => $color,
                    'status_pembayaran' => '',
                    'progres_berkas' => '0',
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ]);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => '',
                    'results' => [
                        'code' => $code,
                        'color' => $color,
                    ],
                ]));
        } else if ($type == 'Sold Out') {

            $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = '$id' AND status_trans = 'Sold Out'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $id_trans = $row->id_trans;
                }
                $this->M_admin->m_update_sold_out($id_trans, $tgl_trans, $user_admin, $tgl_update);
            } else {
                $data = [
                    'id_trans_denahs' => $id,
                    'nama_cus' => $nama_cus,
                    'no_wa' => $no_wa,
                    'status_trans' => 'Sold Out',
                    'tgl_trans' => $tgl_trans,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ];
                $this->M_admin->m_insert_sold_out($data);
            }
            $denah = Denah_model::where('id_denahs', $id)
                ->update([
                    'type_unit' => $type_unit,
                    'type' => $type,
                    'description' => $desc,
                    'color' => $color,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ]);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => '',
                    'results' => [
                        'id_denahs' => $id,
                        'code' => $code,
                        'color' => $color,
                    ],
                ]));
        } else {
            $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = $id";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                }
                $this->M_admin->m_update_nama_cus($id, $nama_cus, $no_wa);
            }

            $denah = Denah_model::where('id_denahs', $id)
                ->update([
                    'type_unit' => $type_unit,
                    'type' => $type,
                    'description' => $desc,
                    'color' => $color,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ]);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => '',
                    'results' => [
                        'id_denahs' => $id,
                        'code' => $code,
                        'color' => $color,
                    ],
                ]));
        }
    }

    function search()
    {
        $draw = $this->input->get('draw');
        $start = ($this->input->get('start') != null) ? $this->input->get('start') : 0;
        $rowperpage = ($this->input->get('length') != null) ? $this->input->get('length') : 10;
        $order = ($this->input->get('order') != null) ? $this->input->get('order') : false;
        $search = ($this->input->get('search') != null && $this->input->get('search')['value'] != null) ? $this->input->get('search') : false;
        $type_unit = $this->input->get('fil_type_unit');
        $payout = $this->input->get('fil_payout');
        $status = $this->input->get('status');
        $tgl_start = $this->input->get('tgl_start');
        $tgl_end = $this->input->get('tgl_end');
        $pdf = $this->input->get('pdf');


        $model = new Denah_model;

        $totalRows = $model->count();
        $filteredRows = $totalRows;
        $id = $this->uri->segment(3);
        $model = $model->where('map',  $id);
        $model = $model->orderBy('id_denahs');

        if ($search) {
            $search = $search['value'];
            $model = $model->where(function ($query) use ($search) {
                $query->Where('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('type', 'LIKE', '%' . $search . '%')
                    ->orWhere('color', 'LIKE', '%' . $search . '%');
            });
        }
        $id_denahs = [];
        if ($status) {
            if ($status == 'UTJ' || $status == 'DP' || $status == 'Sold Out') {
                if ($tgl_start == '') {
                    $sql = "SELECT *FROM transaksi, denahs WHERE transaksi.id_trans_denahs = denahs.id_denahs AND denahs.map = '$id' AND status_trans = '$status'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $id_denahs[] = $row->id_denahs;
                        }
                    }
                    $model = $model->whereIn('id_denahs', $id_denahs);
                } else {
                    date_default_timezone_set("Asia/jakarta");
                    $sql = "SELECT *FROM transaksi, denahs WHERE transaksi.id_trans_denahs = denahs.id_denahs AND denahs.map = '$id' AND status_trans = '$status' AND STR_TO_DATE(tgl_trans, '%d/%m/%Y') BETWEEN STR_TO_DATE('$tgl_start', '%d/%m/%Y') AND STR_TO_DATE('$tgl_end', '%d/%m/%Y')";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $id_denahs[] = $row->id_denahs;
                        }
                    }
                    $model = $model->whereIn('id_denahs', $id_denahs);
                }
            } else {

                $model = $model->where('type', $status);
            }
        }
        if ($type_unit) {
            if ($type_unit == '') {

                $model = $model->where('type', $status);
            } else {

                $model = $model->where('type_unit', $type_unit);
            }
        }
        if ($payout) {
            if ($type_unit == '') {

                if ($payout == 'kpr') {
                    $status_pembayaran = ['kpr-kom', 'kpr-sub'];
                    $model = $model->whereIN('status_pembayaran', $status_pembayaran);
                } else {
                    $status_pembayaran = $payout;
                    $model = $model->where('status_pembayaran', $status_pembayaran);
                }
            } else {
                if ($type_unit == 'Komersil') {
                    if ($payout == 'kpr') {
                        $status_pembayaran = 'kpr-kom';
                    } else {

                        $status_pembayaran = $payout;
                    }
                } else if ($type_unit == 'Subsidi') {
                    if ($payout == 'kpr') {
                        $status_pembayaran = 'kpr-sub';
                    } else {

                        $status_pembayaran = $payout;
                    }
                }
                $model = $model->where('status_pembayaran', $status_pembayaran);
            }
        }

        $filteredRows = $model->count();
        $model = $model->skip((int) $start);
        $model = $model->take((int) $rowperpage);

        if ($order) {
            foreach ($this->input->get('columns') as $key => $column) {
                $direction = ($order[0]['dir'] == 'asc') ? 'ASC' : 'DESC';
                if ($key == $order[0]['column']) {
                    $model = $model->orderBy($column['name'], $direction);
                }
            }
        }
        $resuls = $model->select('denahs.*')->get();

        $data_arr = [];
        foreach ($resuls as $result) {
            $id_denahs = $result->id_denahs;
            $data = [
                'code' => $result->code,
                'description' => $result->description,
                'type' => '<span class="pup" style="background-color:' . $result->color . '"></span> ' . $result->type,
                'color' => '<div id="progres-' . $result->id_denahs . '" class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-sm font-weight-bold">' . $result->progres_berkas . '%</span>
                                    </div>
                                </div>
                                <div >
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $result->progres_berkas . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $result->progres_berkas . '%;"></div>
                                </div>
                            </div>',
            ];

            $data['type_unit'] = $result->type_unit;
            if ($result->status_pembayaran == "kpr-sub" or $result->status_pembayaran == "kpr-kom") {
                $data['status_pembayaran'] = 'KPR';
            } else if ($result->status_pembayaran == "cash") {
                $data['status_pembayaran'] = 'CASH';
            } else {

                $data['status_pembayaran'] = $result->status_pembayaran;
            }
            if ($result->type == "Dipesan" or $result->type == "Sold Out") {
                $data['action'] = '<button onclick="openDataRow(\'' . $result->id_denahs . '\',\'' . $result->type_unit . '\',\'' . $result->code . '\', \'' . $result->type . '\', \'' . $result->description . '\' , \'' . $result->progres_berkas . '\')" class="btn btn-sm bg-gradient-success" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="fa fa-edit" style="font-size:small;"></i> &nbsp;Edit</button>&nbsp;&nbsp;' .
                    '<button type="button" onclick="getDataDoc(\'' . $result->id_denahs . '\',\'' . $result->type_unit . '\' ,\'' . $result->status_pembayaran . '\', \'' . $result->progres_berkas . '\')" id="btn-document-' . $result->id_denahs . '" class="btn-modal-document btn btn-sm bg-gradient-primary" value="' . $result->status_pembayaran . '" data-bs-toggle="modal" data-bs-target="#exampleModalatt"><i class="fa fa-paperclip" style="font-size:small;"></i> &nbsp;Doc</button>';
            } else {
                $data['action'] = '<button onclick="openDataRow(\'' . $result->id_denahs . '\',\'' . $result->type_unit . '\',\'' . $result->code . '\', \'' . $result->type . '\', \'' . $result->description . '\' , \'' . $result->progres_berkas . '\')" class="btn btn-sm bg-gradient-success" data-bs-toggle="modal" data-bs-target="#exampleModaledit"> <i class="fa fa-edit" style="font-size:small;"></i> &nbsp;Edit</button>';
            }
            $data['tgl_update'] = $result->tgl_update;
            $data['user_admin'] = $result->user_admin;
            $data_trans = [];
            $count = [];
            $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = $id_denahs";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    if ($row->status_trans == 'UTJ') {
                        $data_trans[] = '<span class="border-transaksi">' . $row->status_trans . ' || ' . $row->tgl_trans . '</span><br>';
                    }
                    if ($result->type == 'Dipesan') {
                        if ($row->status_trans == 'UTJ') {
                            $tgl = preg_replace("![^a-z0-9]+!i", "-", $row->tgl_trans);
                            date_default_timezone_set('Asia/Jakarta');
                            $awal  = date_create('' . $tgl . '');
                            $akhir = date_create(); // waktu sekarang, pukul 06:13
                            $diff  = date_diff($akhir, $awal);
                            if ($result->progres_berkas < '50') {
                                if ($diff->days >= '0' && $diff->days <= '3') {
                                    $count[] = '<span class="bg-dur-green">' . $diff->days . ' Hari</span>';
                                } else if ($diff->days >= '4' && $diff->days <= '9') {
                                    $count[] = '<span class="bg-dur-orange">' . $diff->days . ' Hari</span>';
                                } else if ($diff->days >= '10') {
                                    $count[] = '<span class="bg-dur-red">' . $diff->days . ' Hari</span>';
                                }
                            } else if ($result->progres_berkas >= '50' && $result->progres_berkas < '100') {
                                if ($result->type_unit == 'Komersil') {
                                    if ($diff->days <= '11' || $diff->days >= '11' && $diff->days <= '14') {
                                        $count[] = '<span class="bg-dur-green">' . $diff->days . ' Hari</span>';
                                    } else if ($diff->days >= '15' && $diff->days <= '19') {
                                        $count[] = '<span class="bg-dur-orange">' . $diff->days . ' Hari</span>';
                                    } else if ($diff->days >= '20') {
                                        $count[] = '<span class="bg-dur-red">' . $diff->days . ' Hari</span>';
                                    }
                                } else if ($result->type_unit == 'Subsidi') {
                                    if ($diff->days <= '11' || $diff->days >= '11' && $diff->days <= '17') {
                                        $count[] = '<span class="bg-dur-green">' . $diff->days . ' Hari</span>';
                                    } else if ($diff->days >= '18' && $diff->days <= '24') {
                                        $count[] = '<span class="bg-dur-orange">' . $diff->days . ' Hari</span>';
                                    } else if ($diff->days >= '25') {
                                        $count[] = '<span class="bg-dur-red">' . $diff->days . ' Hari</span>';
                                    }
                                    // $count[] = '<span class="bg-dur-sold-out">etst</span>';
                                }
                            } else if ($result->progres_berkas == '100') {
                                $count[] = '<span class="bg-dur-sold-out">DONE</span>';
                            }
                        }
                    } else if ($result->type == 'Sold Out') {
                        if ($row->status_trans == 'Sold Out') {
                            $count[] = '<span class="bg-dur-sold-out">' . $row->status_trans . '</span>';
                        }
                    }
                }
            }
            $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = $id_denahs AND status_trans = 'DP' ORDER BY id_trans DESC LIMIT 1";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data_trans[] = '<span class="border-transaksi">' . $row->status_trans . ' || ' . $row->tahap . ' || ' . $row->tgl_trans . '</span><br>';
                }
            }
            $data['transaction'] = $data_trans;
            $data['duration'] = $count;
            $data_arr[] = $data;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'draw'            => $draw,
                'recordsTotal'    => $filteredRows,
                'recordsFiltered' => $filteredRows,
                'data'            => $data_arr,
            ]));
    }

    function get_data_pdf()
    {
        $type_unit = $this->input->get('fil_type_unit');
        $payout = $this->input->get('fil_payout');
        $status = $this->input->get('status');
        $tgl_start = $this->input->get('tgl_start');
        $tgl_end = $this->input->get('tgl_end');
        $id = $this->input->get('map');
        // $id = '6';


        $model = new Denah_model;
        $model = $model->where('map',  $id);

        $id_denahs = [];
        if ($status) {
            if ($status == 'UTJ' || $status == 'DP' || $status == 'Sold Out') {
                if ($tgl_start == '') {
                    $sql = "SELECT *FROM transaksi, denahs WHERE transaksi.id_trans_denahs = denahs.id_denahs AND denahs.map = '$id' AND status_trans = '$status'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $id_denahs[] = $row->id_denahs;
                        }
                    }
                    $model = $model->whereIn('id_denahs', $id_denahs);
                } else {
                    date_default_timezone_set("Asia/jakarta");
                    $sql = "SELECT *FROM transaksi, denahs WHERE transaksi.id_trans_denahs = denahs.id_denahs AND denahs.map = '$id' AND status_trans = '$status' AND STR_TO_DATE(tgl_trans, '%d/%m/%Y') BETWEEN STR_TO_DATE('$tgl_start', '%d/%m/%Y') AND STR_TO_DATE('$tgl_end', '%d/%m/%Y')";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $id_denahs[] = $row->id_denahs;
                        }
                    }
                    $model = $model->whereIn('id_denahs', $id_denahs);
                }
            } else {

                $model = $model->where('type', $status);
            }
        }
        if ($type_unit) {
            if ($type_unit == '') {

                $model = $model->where('type', $status);
            } else {

                $model = $model->where('type_unit', $type_unit);
            }
        }
        if ($payout) {
            if ($type_unit == '') {

                if ($payout == 'kpr') {
                    $status_pembayaran = ['kpr-kom', 'kpr-sub'];
                    $model = $model->whereIN('status_pembayaran', $status_pembayaran);
                } else {
                    $status_pembayaran = $payout;
                    $model = $model->where('status_pembayaran', $status_pembayaran);
                }
            } else {
                if ($type_unit == 'Komersil') {
                    if ($payout == 'kpr') {
                        $status_pembayaran = 'kpr-kom';
                    } else {

                        $status_pembayaran = $payout;
                    }
                } else if ($type_unit == 'Subsidi') {
                    if ($payout == 'kpr') {
                        $status_pembayaran = 'kpr-sub';
                    } else {

                        $status_pembayaran = $payout;
                    }
                }
                $model = $model->where('status_pembayaran', $status_pembayaran);
            }
        }
        $resuls = $model->select('denahs.*')->get();
        // $code = [];
        foreach ($resuls as $result) {
            $code = $result->code;
            echo $code . '-';
        }
    }
    function update_status_pembayaran()
    {
        $id_denahs = $this->input->post('id-denahs');
        $status_pembayaran = $this->input->post('status-pembayaran');
        $update = $this->M_admin->m_update_status_pembayaran($id_denahs, $status_pembayaran);
        echo json_encode($update);
    }

    function select_data_document()
    {
        $status_pembayaran = $this->input->post('status-pembayaran');
        $id_denahs = $this->input->post('id-doc-kapling');
        $sql = "SELECT *FROM upload WHERE id_doc_kapling = $id_denahs";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id_upload = $row->id_upload;
                $user_admin = $row->user_admin;
                $tgl_update = $row->tgl_update;
                $ktp = $row->ktp;
                $kk = $row->kk;
                $npwp = $row->npwp;
                $buku_nikah = $row->buku_nikah;
                $skk = $row->skk;
                $slip_g = $row->slip_g;
                $rek_koran = $row->rek_koran;
                $pas_foto = $row->pas_foto;
                $spt = $row->spt;
                $blanko = $row->blanko;
                $doc1 = $row->doc1;
                $doc2 = $row->doc2;
                $doc3 = $row->doc3;
                $doc4 = $row->doc4;
                $doc5 = $row->doc5;
                $doc6 = $row->doc6;
                if ($status_pembayaran == 'cash') {
                    if ($ktp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KTP</span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $ktp . '" data-flied="ktp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KTP <i class="ni ni-check-bold"></i></span></a> </li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($kk == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KK </span></li></td>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $kk . '" data-flied="kk" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KK <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($npwp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span>NPWP </span></li></td>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $npwp . '" data-flied="npwp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span>NPWP <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($buku_nikah == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span>BUKU NIKAH</span> </li></td>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $buku_nikah . '" data-flied="buku_nikah" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span>BUKU NIKAH <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                } else if ($status_pembayaran == 'kpr-kom') {

                    if ($ktp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KTP</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $ktp . '" data-flied="ktp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KTP <i class="ni ni-check-bold"></i></a></span> </li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($kk == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KK </span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $kk . '" data-flied="kk" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KK <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($npwp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>NPWP </span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $npwp . '" data-flied="npwp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>NPWP <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($buku_nikah == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>BUKU NIKAH</span> </li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $buku_nikah . '" data-flied="buku_nikah" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>BUKU NIKAH <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                    if ($skk == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT KETERANGAN KERJA</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $skk . '" data-flied="skk" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT KETERANGAN KERJA <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($slip_g == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $slip_g . '" data-flied="slip_g" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }

                    if ($rek_koran == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $rek_koran . '" data-flied="rek_koran" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                    if ($pas_foto == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>PAS FOTO</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $pas_foto . '" data-flied="pas_foto" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>PAS FOTO <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                    if ($spt == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SPT</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $spt . '" data-flied="spt" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SPT <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                    if ($blanko == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>BLANKO</span></li>';
                        echo '<td class="text-center"></td>';
                        echo '<td class="text-center"></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $blanko . '" data-flied="blanko" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>BLANKO <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '</tr>';
                    }
                } else if ($status_pembayaran == 'kpr-sub') {

                    if ($ktp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KTP</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $ktp . '" data-flied="ktp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KTP <i class="ni ni-check-bold"></i></a></span> </li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($kk == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>KK </span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $kk . '" data-flied="kk" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>KK <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($npwp == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>NPWP </span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $npwp . '" data-flied="npwp" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>NPWP <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($buku_nikah == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>BUKU NIKAH</span> </li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $buku_nikah . '" data-flied="buku_nikah" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>BUKU NIKAH <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($skk == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT KETERANGAN KERJA</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $skk . '" data-flied="skk" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT KETERANGAN KERJA <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($slip_g == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $slip_g . '" data-flied="slip_g" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($rek_koran == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $rek_koran . '" data-flied="rek_koran" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($pas_foto == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>PAS FOTO</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $pas_foto . '" data-flied="pas_foto" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>PAS FOTO <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($spt == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SPT</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $spt . '" data-flied="spt" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SPT <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($blanko == '') {
                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>BLANKO</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $blanko . '" data-flied="blanko" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>BLANKO <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }

                    if ($doc1 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT PERNYATAAN PERMOHONAN KPR</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc1 . '" data-flied="doc1" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT PERNYATAAN PERMOHONAN KPR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($doc2 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT PERNYATAAN PENGHUNI RUMAH UMUM BERSUBSIDI</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc2 . '" data-flied="doc2" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT PERNYATAAN PENGHUNI RUMAH UMUM BERSUBSIDI <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($doc3 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT KUASA PENDEBETAN DANA</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc3 . '" data-flied="doc3" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT KUASA PENDEBETAN DANA <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($doc4 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT PERMOHONAN SUBSIDI</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc4 . '" data-flied="doc4" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT PERMOHONAN SUBSIDI <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($doc5 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT PENGAKUAN KEKURANGAN BAYAR KPR</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc5 . '" data-flied="doc5" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT PENGAKUAN KEKURANGAN BAYAR KPR <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                    if ($doc6 == '') {

                        echo '<tr class="tr">';
                        echo '<td><li><span><sup>*</sup>SURAT PERINTAH PEMINDAH BUKUAN DANA SBUM</span></li></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td><li class="pdf" data-pdf="' . $doc6 . '" data-flied="doc6" data-id-upload="' . $id_upload . '"><a href="#preview-pdf"><span><sup>*</sup>SURAT PERINTAH PEMINDAH BUKUAN DANA SBUM <i class="ni ni-check-bold"></i></a></span></li></td>';
                        echo '<td class="text-center">' . $tgl_update . '</td>';
                        echo '<td class="text-center">' . $user_admin . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                }

                echo '<input id="id-upload" type="text" hidden  value="' . $row->id_upload . '">';
            }
        } else {
            if ($status_pembayaran == 'cash') {

                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KTP</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KK </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span>NPWP </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span>BUKU NIKAH</span> </li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            } else if ($status_pembayaran == 'kpr-sub') {
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KTP </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KK </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>NPWP </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>BUKU NIKAH</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT KETERANGAN KERJA</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>PAS FOTO</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SPT</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>BLANKO</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT PERNYATAAN PERMOHONAN KPR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT PERNYATAAN PENGHUNI RUMAH UMUM BERSUBSIDI</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT KUASA PENDEBETAN DANA</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT PERMOHONAN SUBSIDI</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT PENGAKUAN KEKURANGAN BAYAR KPR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT PERINTAH PEMINDAH BUKUAN DANA SBUM</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            } else if ($status_pembayaran == 'kpr-kom') {
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KTP </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>KK </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>NPWP </span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>BUKU NIKAH</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SURAT KETERANGAN KERJA</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SLIP GAJI 3 BULAN TERAKHIR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>REKENING KORAN 3 BULAN TERAKHIR</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>PAS FOTO</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>SPT</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
                echo '<tr class="tr">';
                echo '<td><li><span><sup>*</sup>BLANKO</span></li></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            }
            echo '<input id="id-upload" type="text" hidden  value="">';
        }
        echo '<script>
                // $(document).ready(function() {
    // console.log($(".ktp").data("text"));
                    $(".pdf").click(function(e) {
                        // alert("' . base_url('upload') . '/doc/" + $(this).data("pdf") + "&embedded=true")
                        // alert($(this).data("pdf") + "&embedded=true")
                        $("#view-pdf").attr("src", "https://docs.google.com/viewer?url=' . base_url('upload') . '/doc/" + $(this).data("pdf") + "&embedded=true")
                        $("#link-down-pdf").attr("href", "' . base_url('upload') . '/doc/" + $(this).data("pdf"));
                        $("#link-down-pdf").attr("download", $(this).data("pdf"));
                        $("#preview-pdf").removeAttr("hidden", true);
                        $("#id-upload").val($(this).data("id-upload"));
                        $("#flied").val($(this).data("flied"));
                        $("#file-doc").val($(this).data("pdf"));
                    });


                // });
            </script>';
    }

    function upload_document()
    {
        $config['upload_path'] = "./upload/doc/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;
        $id_doc_kapling = $this->input->post('id-doc-kapling');
        $select_pembayaran = $this->input->post('select-pembayaran');
        $select_document = $this->input->post('select-document');
        $user_admin = $this->session->userdata('userdata')->nama;
        $tgl_update = date("d/m/Y | H:i:s");

        if ($select_pembayaran == 'cash') {
            $nilai = [
                'ktp' => '50',
                'kk' => '50',
                'npwp' => '0',
                'buku_nikah' => '0',

            ];
        } else if ($select_pembayaran == 'kpr-kom') {
            $nilai = [
                'ktp' => '10',
                'kk' => '10',
                'npwp' => '10',
                'buku_nikah' => '10',
                'skk' => '10',
                'slip_g' => '10',
                'rek_koran' => '10',
                'pas_foto' => '10',
                'spt' => '10',
                'blanko' => '10',
            ];
        } else if ($select_pembayaran == 'kpr-sub') {
            $nilai = [
                'ktp' => '5',
                'kk' => '5',
                'npwp' => '5',
                'buku_nikah' => '5',
                'skk' => '5',
                'slip_g' => '5',
                'rek_koran' => '10',
                'pas_foto' => '5',
                'spt' => '5',
                'blanko' => '5',
                'doc1' => '5',
                'doc2' => '5',
                'doc3' => '5',
                'doc4' => '10',
                'doc5' => '10',
                'doc6' => '10',
            ];
        }
        $sql = "SELECT *FROM denahs, upload WHERE upload.id_doc_kapling = denahs.id_denahs AND upload.id_doc_kapling = $id_doc_kapling";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->$select_document == '') {
                    $progres = $row->progres_berkas + $nilai[$select_document];
                    echo '<div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-sm font-weight-bold">' . $progres . '%</span>
                                </div>
                        </div>
                        <div >
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $progres . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progres . '%;"></div>
                        </div>';
                    // echo '<div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $progres . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progres . '%;"></div>';
                    $this->M_admin->m_update_progres($id_doc_kapling, $progres);
                } else {
                    echo '<div class="progress-info">
                            <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">' . $row->progres_berkas . '%</span>
                            </div>
                        </div>
                        <div >
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $row->progres_berkas . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->progres_berkas . '%;"></div>
                        </div>';
                    // echo '<div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $row->progres_berkas . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->progres_berkas . '%;"></div>';
                    unlink('./upload/doc/' . $row->$select_document);
                }
                $this->load->library('upload', $config);

                if ($this->upload->do_upload("file-document")) {
                    $data = array('upload_data' => $this->upload->data());
                    $file_document = $data['upload_data']['file_name'];
                    $uploadedImage = $this->upload->data();
                };
            }
            // echo 'ada';

            $this->M_admin->m_update_document($id_doc_kapling, $select_document, $file_document, $user_admin, $tgl_update);
            // echo json_encode($update);
        } else {
            // echo 'tidak ada';
            $progres = '0' + $nilai[$select_document];
            echo '<div class="progress-info">
                    <div class="progress-percentage">
                        <span class="text-sm font-weight-bold">' . $progres . '%</span>
                    </div>
                </div>
                <div >
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $progres . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progres . '%;"></div>
                </div>';
            // echo $progres;
            $this->M_admin->m_update_progres($id_doc_kapling, $progres);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("file-document")) {
                $data = array('upload_data' => $this->upload->data());
                $file_document = $data['upload_data']['file_name'];
                $uploadedImage = $this->upload->data();
                $data = [
                    'id_doc_kapling' => $id_doc_kapling,
                    $select_document => $file_document,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update,

                ];
            };
            $this->M_admin->m_upload_document($data);
            // echo json_encode($insert);
        }
    }

    function delete_document()
    {
        $id_upload = $this->input->post('id-upload');
        $file_doc = $this->input->post('file-doc');
        $flied = $this->input->post('flied');
        $select_pembayaran = $this->input->post('select-pembayaran');
        $user_admin = $this->session->userdata('userdata')->nama;
        $tgl_update = date("d/m/Y | H:i:s");
        unlink('./upload/doc/' . $file_doc);
        if ($select_pembayaran == 'cash') {
            $nilai = [
                'ktp' => '50',
                'kk' => '50',
                'npwp' => '0',
                'buku_nikah' => '0',

            ];
        } else if ($select_pembayaran == 'kpr-kom') {
            $nilai = [
                'ktp' => '10',
                'kk' => '10',
                'npwp' => '10',
                'buku_nikah' => '10',
                'skk' => '10',
                'slip_g' => '10',
                'rek_koran' => '10',
                'pas_foto' => '10',
                'spt' => '10',
                'blanko' => '10',
            ];
        } else if ($select_pembayaran == 'kpr-sub') {
            $nilai = [
                'ktp' => '5',
                'kk' => '5',
                'npwp' => '5',
                'buku_nikah' => '5',
                'skk' => '5',
                'slip_g' => '5',
                'rek_koran' => '10',
                'pas_foto' => '5',
                'spt' => '5',
                'blanko' => '5',
                'doc1' => '5',
                'doc2' => '5',
                'doc3' => '5',
                'doc4' => '10',
                'doc5' => '10',
                'doc6' => '10',
            ];
        }
        $sql = "SELECT *FROM denahs, upload WHERE upload.id_doc_kapling = denahs.id_denahs AND upload.id_upload = $id_upload";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // if ($row->$flied == '') {
                $id_doc_kapling = $row->id_denahs;
                $progres = $row->progres_berkas - $nilai[$flied];
                echo '<div class="progress-info">
                                <div class="progress-percentage">
                                <span class="text-sm font-weight-bold">' . $progres . '%</span>
                                </div>
                        </div>
                        <div >
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $progres . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progres . '%;"></div>
                        </div>';
                // echo '<div class="progress-bar bg-success" role="progressbar" aria-valuenow="' . $progres . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progres . '%;"></div>';
                $select_document = $flied;
                $file_document = '';
                $this->M_admin->m_update_progres($id_doc_kapling, $progres);
                $this->M_admin->m_update_document($id_doc_kapling, $select_document, $file_document, $user_admin, $tgl_update);

                // }
            }
        }
    }

    function load_data_transaksi()
    {
        $id_trans_denahs = $this->input->post('id-trans-denahs');

        $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = $id_trans_denahs ORDER BY status_trans DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nama_cus = $row->nama_cus;
                $no_wa = $row->no_wa;
                $kontak = $this->input->post('kontak');
                //Terlebih dahulu kita trim dl
                $nomorhp = trim($no_wa);
                //bersihkan dari karakter yang tidak perlu
                $nomorhp = strip_tags($nomorhp);
                // Berishkan dari spasi
                $nomorhp = str_replace(" ", "", $nomorhp);
                // bersihkan dari bentuk seperti  (022) 66677788
                $nomorhp = str_replace("(", "", $nomorhp);
                // bersihkan dari format yang ada titik seperti 0811.222.333.4
                $nomorhp = str_replace(".", "", $nomorhp);

                //cek apakah mengandung karakter + dan 0-9
                if (!preg_match('/[^+0-9]/', trim($nomorhp))) {
                    // cek apakah no hp karakter 1-3 adalah +62
                    if (substr(trim($nomorhp), 0, 3) == '+62') {
                        $nomorhp = trim($nomorhp);
                        // echo $nomorhp;
                    }
                    // cek apakah no hp karakter 1 adalah 0
                    elseif (substr($nomorhp, 0, 1) == '0') {
                        $nomorhp = '62' . substr($nomorhp, 1);
                        // $nomorhp1 = str_replace("'", "", $nomorhp);
                    }
                }
                echo $row->status_trans . $row->nama_cus;
                echo '<tr class="tr">
                            <td class="text-center">' . $row->status_trans . '</td>
                            <td class="text-center">' . $row->tgl_trans . '</td>
                            <td class="text-center">' . $row->tahap . '</td>
                            <td class="text-center">' . $row->nominal . '</td>
                            <td class="text-center"><button type="button" class="btn btn-danger btn-small btn-delete-transaksi" data-id-trans="' . $row->id_trans . '">Hapus</button></td>
                            <td class="text-center">' . $row->tgl_update . '</td>
                            <td class="text-center">' . $row->user_admin . '</td>
                        </tr>';
            }
            echo '<tr class="tr">';
            echo '<td style="background: blanchedalmond;">Nominal DP</td>';
            echo '<td colspan="6" style="background: beige;" > : Rp. ' . $row->nominal_dp . '</td>';
            echo '<td class="td-nominal-dp" hidden>' . $row->nominal_dp . '</td>';
            echo '</tr>';
            $sql = "SELECT SUM(nominal) AS total_nominal, nominal_dp FROM transaksi WHERE id_trans_denahs = $id_trans_denahs AND status_trans='DP'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $count) {
                    if ($row->nominal_dp == $count->total_nominal) {

                        echo '<tr class="tr">';
                        echo '<td style="background: blanchedalmond;">DP dibayar</td>';
                        echo '<td colspan="6" style="background: beige;"> : Rp. ' . $count->total_nominal . '  -> LUNAS</td>';
                        echo '</tr>';
                    } else {
                        echo '<tr class="tr">';
                        echo '<td style="background: blanchedalmond;">DP dibayar</td>';
                        echo '<td colspan="6" style="background: beige;"> : Rp. ' . $count->total_nominal . '</td>';
                        echo '</tr>';
                    }
                }
            }
            echo '<script>
                        if ($("#type").val()=="Sold Out") {
                            $(".btn-delete-transaksi").hide();
                        } else {
                            $(".btn-delete-transaksi").show();
                        }
                          $("#nama-cus").val("' . $nama_cus . '");
                                $("#no-wa").val("' . $nomorhp . '");
                                $(".chat-wa").attr("href", "https://api.whatsapp.com/send?phone=' . $nomorhp . '&text=");
                                $(".btn-delete-transaksi").click(function() {
                                    // alert($(this).data("id-trans"));
                                    var el = this;

                                    // Delete id
                                    var confirmalert = confirm("Apakah anda yakin untuk menghapus transaksi ..?");
                                    if (confirmalert == true) {
                                        let formData = new FormData();
                                        formData.append("id-trans", $(this).data("id-trans"));
                                        $.ajax({
                                            type: "POST",
                                            url: "' . site_url("Home/delete_data_transaksi") . '",
                                            data: formData,
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            success: function(msg) {
                                                $(el).closest("tr").css("background", "tomato");
                                                $(el).closest("tr").fadeOut(300, function() {
                                                    $(this).remove();
                                                });
                                                load_data_transaksi();

                                            }
                                        });
                                    }
                                });
                            </script>';
        } else {

            echo '<script>
                                    $("#nama-cus").val("");
                                    $("#no-wa").val("");

                                    </script>';
        }
    }

    function upload_transaksi()
    {
        $id_trans_denahs = $this->input->post('id-trans-denahs');
        $nama_cus = $this->input->post('nama-cus');
        $no_wa = $this->input->post('no-wa');
        $status_trans = $this->input->post('status-trans');
        $tgl_trans = $this->input->post('tgl-trans');
        $nominal = $this->input->post('nominal');
        $nominal_dp = $this->input->post('nominal-dp');
        $user_admin = $this->session->userdata('userdata')->nama;
        $tgl_update = date("d/m/Y | H:i:s");
        $tahap = 0;
        $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = '$id_trans_denahs' AND status_trans = '$status_trans'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id_trans = $row->id_trans;
                $db_nama_cus = $row->nama_cus;
                $db_no_hp = $row->no_wa;
                $db_nominal_dp = $row->nominal_dp;
                $tahap++;
            }
            $count_tahapan = 'Tahap ' . $tahap += 1;
            if ($status_trans == 'UTJ') {
                $this->M_admin->m_update_transaksi($id_trans, $tgl_trans, $nominal, $user_admin, $tgl_update);
            } else {
                $data = [
                    'id_trans_denahs' => $id_trans_denahs,
                    'nama_cus' => $db_nama_cus,
                    'no_wa' => $db_no_hp,
                    'status_trans' => $status_trans,
                    'tgl_trans' => $tgl_trans,
                    'nominal' => $nominal,
                    'nominal_dp' => $db_nominal_dp,
                    'tahap' => $count_tahapan,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ];
                $this->M_admin->m_upload_transaksi($data);
            }
        } else {
            if ($status_trans == 'UTJ') {
                $data = [
                    'id_trans_denahs' => $id_trans_denahs,
                    'nama_cus' => $nama_cus,
                    'no_wa' => $no_wa,
                    'status_trans' => $status_trans,
                    'tgl_trans' => $tgl_trans,
                    'nominal' => $nominal,
                    'tahap' => 'Lunas',
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ];
                $this->M_admin->m_upload_transaksi($data);
            } else {
                $count_tahapan = 'Tahap 1';
                $data = [
                    'id_trans_denahs' => $id_trans_denahs,
                    'nama_cus' => $nama_cus,
                    'no_wa' => $no_wa,
                    'status_trans' => $status_trans,
                    'tgl_trans' => $tgl_trans,
                    'nominal' => $nominal,
                    'nominal_dp' => $nominal_dp,
                    'tahap' => $count_tahapan,
                    'user_admin' => $user_admin,
                    'tgl_update' => $tgl_update
                ];
                $this->M_admin->m_upload_transaksi($data);
            }
        }
    }

    function delete_data_transaksi()
    {
        $id_trans = $this->input->post('id-trans');
        $this->M_admin->m_delete_data_transaksi($id_trans);
    }
}
