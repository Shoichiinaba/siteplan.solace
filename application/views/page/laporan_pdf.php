<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets_adm/img/logo/logo1.png">
    <title>
        Formulir
    </title>
    <style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table td,
    #table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background: #03a9f4;
        color: white;
    }

    .bg-dur-green {
        /* background: #5dcf32; */
        padding: 1px 4px;
        border-radius: 5px;
        color: #5dcf32;
    }

    .bg-dur-orange {
        /* background: #e0ab0e; */
        padding: 1px 4px;
        border-radius: 5px;
        color: #e0ab0e;
    }

    .bg-dur-red {
        /* background: #e00e13; */
        padding: 1px 4px;
        border-radius: 5px;
        color: #e00e13;
    }

    .bg-dur-sold-out {
        border: dashed 2px red;
        padding: 0px 6px;
        border-radius: 5px;
        font-weight: bold;
        color: #f05151;
    }
    </style>

</head>

<body>
    <div style="text-align:center">
        <h3> Laporan Data Penjualan Perumahan </h3>
        <!-- <h3> <?= var_dump($data_test); ?></h3> -->
    </div>
    <?php
    $str_data = [];
    $filter = [];
    $type = $this->input->get('type');
    $payout = $this->input->get('payout');


    ?>

    <table>
        <tr>
            <td>Type Unit </td>
            <td>: <?= $type; ?></td>
        </tr>
        <tr>
            <td>Payout </td>
            <td>: <?= $payout; ?></td>
        </tr>
        <tr>
            <td>Status </td>
            <td>: UTJ, DP</td>
        </tr>
    </table>

    <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Unit</th>
                <th>Type</th>
                <th>Status</th>
                <th>Payout</th>
                <th>UTJ</th>
                <th>DP</th>
                <th>Duration</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            foreach ($data_denahs as $data) {
                $id_denahs = $data->id_denahs;

                $data_tgl_utj = [];
                $data_nominal_dp = [];
                $data_count = [];
                $sql = "SELECT *FROM transaksi WHERE id_trans_denahs = $id_denahs";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        if ($row->status_trans == 'UTJ') {
                            $data_tgl_utj[] = '<span class="border-transaksi">' . $row->tgl_trans . '</span>';
                        }
                        if ($row->status_trans == 'DP') {
                            $data_nominal_dp[] = '<span class="border-transaksi">Rp.' . $row->nominal . '</span>';
                        }
                        if ($data->type == 'Dipesan') {
                            if ($row->status_trans == 'UTJ') {
                                $tgl = preg_replace("![^a-z0-9]+!i", "-", $row->tgl_trans);
                                date_default_timezone_set('Asia/Jakarta');
                                $awal  = date_create('' . $tgl . '');
                                $akhir = date_create(); // waktu sekarang, pukul 06:13
                                $diff  = date_diff($akhir, $awal);
                                if ($diff->days >= '0' && $diff->days <= '14') {
                                    $data_count[] = '<span class="bg-dur-green">' . $diff->days . ' Hari</span>';
                                } else if ($diff->days >= '15' && $diff->days <= '22') {
                                    $data_count[] = '<span class="bg-dur-orange">' . $diff->days . ' Hari</span>';
                                } else if ($diff->days >= '23') {
                                    $data_count[] = '<span class="bg-dur-red">' . $diff->days . ' Hari</span>';
                                }
                            }
                        } else if ($data->type == 'Sold Out') {
                            if ($row->status_trans == 'Sold Out') {
                                $data_count[] = '<span class="bg-dur-sold-out">' . $row->status_trans . '</span>';
                            }
                        }
                    }
                }
            ?>
            <tr>
                <td scope="row"><?= $no++; ?></td>
                <td><?= $data->code; ?></td>
                <td><?= $data->type_unit; ?></td>
                <td><?= $data->type; ?></td>
                <td>
                    <?php if ($data->status_pembayaran == 'cash') {
                            echo 'CASH';
                        } else {
                            echo 'KPR';
                        } ?>
                </td>
                <td>
                    <?php
                        foreach ($data_tgl_utj as $tgl) {
                        ?>
                    <?= $tgl; ?>
                    <?php
                        }
                        ?>
                </td>
                <td>
                    <?php
                        foreach ($data_nominal_dp as $nominal) {
                        ?>
                    <?= $nominal; ?>
                    <?php
                        }
                        ?>
                </td>
                <td>
                    <?php
                        foreach ($data_count as $count) {
                        ?>
                    <?= $count; ?>
                    <?php
                        }
                        ?>
                </td>

                <td><?= $data->progres_berkas; ?> %</td>
            </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
    <script>
    alert('ya')
    </script>
</body>