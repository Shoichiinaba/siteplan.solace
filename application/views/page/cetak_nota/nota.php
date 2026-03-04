<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
    @page {
        margin: 10px 15px;
    }

    body {
        margin: 0;
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        color: #333;
    }

    .header {
        border-bottom: 2px solid #04695b;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .title {
        font-size: 16px;
        font-weight: bold;
        color: #04695b;
    }

    .subtitle {
        font-size: 10px;
        color: #777;
    }

    .box {
        border: 1px solid #ddd;
        padding: 6px;
        margin-top: 5px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }

    .table th {
        background: #04695b;
        color: white;
        padding: 5px;
        font-size: 11px;
    }

    .table td {
        border: 1px solid #ddd;
        padding: 5px;
        font-size: 11px;
    }

    .total-box {
        margin-top: 8px;
        padding: 5px;
        background: #f5f5f5;
        border: 1px solid #ddd;
        font-size: 11px;
    }

    .lunas {
        color: green;
        font-weight: bold;
    }

    .signature {
        margin-top: 20px;
        width: 100%;
    }

    .signature td {
        text-align: center;
        padding-top: 30px;
    }

    .watermark {
        position: fixed;
        bottom: 980px;
        left: -100px;
        width: 100%;
        text-align: center;
        opacity: 0.08;
        transform: rotate(-35deg);
        transform-origin: 50% 50%;
        font-size: 80px;
        color: #04695b;
        font-weight: bold;
        z-index: -1000;
    }
    </style>
</head>

<body>
    <div class="watermark">
        SOLACE PROPERTI
    </div>
    <div class="header">
        <table width="100%">
            <tr>
                <td width="70%">
                    <div class="title">NOTA <?= $row->status_trans ?></div>
                    <div class="subtitle">
                        No Nota : TRX- <?= date('d/m/y', strtotime($row->tgl_trans)) ?>-<?= $row->id_trans ?><br>
                        Tanggal : <?= date('d F Y', strtotime($row->tgl_trans)) ?>
                    </div>
                </td>
                <td width="30%" align="right">
                    <img src="<?= base_url('assets_adm/img/logo/logo2.png'); ?>" width="100">
                </td>
            </tr>
        </table>
    </div>
    <div class="box">
        <strong>Data Customer</strong><br><br>

        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="width:150px;">Nama</td>
                <td style="width:10px;">:</td>
                <td><?= $row->nama_cus ?></td>
            </tr>
            <tr>
                <td>No WA</td>
                <td>:</td>
                <td><?= $row->no_wa ?></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td>Blok <?= $row->code ?></td>
            </tr>
            <tr>
                <td>Type Unit</td>
                <td>:</td>
                <td><?= $row->type_unit ?></td>
            </tr>
            <td>Jenis Pembayaran</td>
            <td>:</td>
            <td>
                <?php
                    if($row->status_pembayaran == 'kpr-kom'){
                        echo 'KPR';
                    } else {
                        echo ucfirst($row->status_pembayaran);
                    }
                ?>
            </td>
        </table>
    </div>

    <table class="table">
        <tr>
            <th>Keterangan</th>
            <th>Nominal</th>
        </tr>
        <tr>
            <td>Pembayaran <?= $row->status_trans ?> <?= $row->tahap ?> Blok <?= $row->code ?></td>
            <td><?= 'Rp. ' . number_format($row->nominal,0,',','.') ?></td>
        </tr>
    </table>

    <table class="table" style="margin-top:8px;">
        <tr>
            <th>DP Tahap</th>
            <th>Nominal</th>
        </tr>

        <?php foreach($dp_list as $dp): ?>
        <tr>
            <td>DP Tahap <?= $dp->tahap ?></td>
            <td>Rp. <?= number_format($dp->nominal,0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>

        <tr>
            <td><strong>Total DP Dibayar</strong></td>
            <td><strong>Rp. <?= number_format($total_dp_dibayar,0,',','.') ?></strong></td>
        </tr>

        <tr>
            <td><strong>Nominal DP</strong></td>
            <td><strong>Rp. <?= number_format($row->nominal_dp,0,',','.') ?></strong></td>
        </tr>

        <tr>
            <td><strong>Kekurangan</strong></td>
            <td>
                <strong>
                    <?php if($kekurangan_dp == 0): ?>
                    <span style="color:green;">LUNAS</span>
                    <?php else: ?>
                    <span style="color:red;">
                        Rp. <?= number_format($kekurangan_dp,0,',','.') ?>
                    </span>
                    <?php endif; ?>
                </strong>
            </td>
        </tr>
    </table>

    <table class="signature">
        <tr>
            <td>
                Customer<br><br><br><br>
                ( <?= $row->nama_cus ?> )
            </td>
            <td>
                Marketing<br><br><br><br>
                ( <?= $row->user_admin ?> )
            </td>
        </tr>
    </table>

</body>

</html>