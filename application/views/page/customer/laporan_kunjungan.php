<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #data-customer td,
    #data-customer th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #data-customer tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #data-customer tr:hover {
        background-color: #ddd;
    }

    #data-customer th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background: #5BCE32;
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laporan Data Customer</h2><br><br>
        <table id="data-customer" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <?php if ($userdata->role == 'Admin') : ?>
                    <th>Marketing</th>
                    <?php endif; ?>
                    <th>nama</th>
                    <th>Tanggal</th>
                    <th>Telepon</th>
                    <th>Unit</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Sumber</th>
                    <th>Hasil FU</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($filteredData as $cus): ?>
                <tr>
                    <td><?= $no++; ?></td>

                    <?php if ($userdata->role == 'Admin') : ?>
                    <td><?= $cus->nama_marketing;; ?></td>
                    <?php endif; ?>

                    <td><?= $cus->nama_visit; ?></td>
                    <td><?= $cus->tanggal; ?></td>
                    <td><?= $cus->no_tlp; ?></td>
                    <td><?= $cus->nama_perum; ?></td>
                    <td><?= $cus->kategori; ?></td>
                    <td><?= $cus->keterangan; ?></td>
                    <td><?= $cus->sumber; ?></td>
                    <td><?= $cus->hasil_fu; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>