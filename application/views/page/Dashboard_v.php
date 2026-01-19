<style>
/* pagination stile */
@-webkit-keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

@keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

.border-transaksi {
    border: 2px solid #F84350;
    padding: 0px 6px;
    border-radius: 5px;
    font-size: x-small;
    font-weight: bold;
    color: red;
}

.border-perum {
    border: 2px solid #DBF2F2;
    padding: 0px 6px;
    border-radius: 5px;
    font-size: xx-small;
    font-weight: bold;
    color: #0D6EFD;
}

/* atur icon */
.down-icon {
    font-size: 13px;
    margin-top: 0px;
    margin-bottom: 0px;
}

.text-center.mt-3 {
    padding-top: 0px;
    padding-bottom: 0px;
    margin-top: 0px;
}

/* akhir atur icon */


.content-placeholder {
    display: inline-block;
    -webkit-animation-duration: 400ms;
    animation-duration: 900ms;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-name: placeHolderShimmer;
    animation-name: placeHolderShimmer;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
    background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    -webkit-background-size: 800px 104px;
    background-size: 800px 104px;
    height: inherit;
    position: relative;
}


table {
    overflow: scroll;
    border-collapse: collapse;
    color: white;
}

.secondaryContainer {
    overflow: scroll;
    border-collapse: collapse;
    height: 313px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 10px;
}

.container {
    width: 80%;
    display: block;
    margin: auto;
}

th {
    width: 150px;
    white-space: nowrap;
    height: 30px;
    padding: 15px;
    position: sticky;
    top: 0;
    background-color: white;
    color: #3ba6bc;
}

.code {
    /* border-bottom: 1px solid #ddd;
        text-align: center; */
    min-width: 150px;
    /* white-space: nowrap;
        height: 30px; */
    padding-left: 14px;
}

tr {
    height: 60px;
}

::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
}

::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
}
</style>

<!-- conten -->
<?php
function getChartDataset($id_perum = null, $database)
{
    $id_perum = $id_perum;

    $dataset = $database;

    $dataset_filter = [];

    $bulan_filter = [];

    // $group_filter = [];
    $group_filter = ['UTJ', 'DP', 'Sold Out'];

    foreach ($dataset as $data) {
        if (($id_perum != null) && ($data->id_perum == $id_perum)) {
            $dataset_filter[] = $data;
        } else if ($id_perum == null) {
            $dataset_filter[] = $data;
        }
        if ($data->bulan) {
            if (!in_array($data->bulan, $bulan_filter)) {
                $bulan_filter[] = $data->bulan;
            }
        }
        if ($data->status_trans) {
            if (!in_array($data->status_trans, $group_filter)) {
                $group_filter[] = $data->status_trans;
            }
        }
    }

    arsort($bulan_filter);
    arsort($group_filter);

    $data_results = [];

    foreach ($group_filter as $group) {
        $g = $group;
        if (!array_key_exists($group, $dataset)) {
            $data_results[$g] = [];
        }
        foreach ($bulan_filter as $bulan) {
            $count = 0;
            $b = $bulan;
            foreach ($dataset_filter as $list) {
                if (($list->bulan == $b) && ($list->status_trans == $g)) {
                    $count += $list->jumlah;
                }
            }
            $data_results[$group][] = $count;
        }
    }

    $final_result = [];
    $final_result['label'] = [];
    $final_result['data'] = [];

    $colors = ['red', 'yellow', 'green'];

    foreach ($bulan_filter as $b) {
        $final_result['label'][] = $b;
    }

    $i = 0;
    foreach ($data_results as $key => $result) {
        $final_result['data'][] = [
            'label' => $key,
            'backgroundColor' => $colors[$i],
            'data' => $result,
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'borderWidth' => 1
        ];
        $i++;
    }
    return $final_result;
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i type="button" class="ni ni-building fa-beat text-lg opacity-10" aria-hidden="true"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-container="body"
                                    data-animation="true" title="
                                    <?php
                                    foreach ($tolp_ready as $data) {
                                    ?>
                                        <?= $data->nama; ?> | <?= $data->jumlah_record; ?>
                                    <?php
                                    }
                                    ?>
                                "></i>
                            </div>
                        </div>
                        <div class=" col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rumah Ready</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $jum_ready;  ?>
                                    <span class="text-info text-sm font-weight-bolder">Unit</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-3">
                            <div type="button"
                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-container="body" data-animation="true" title="
                                    <?php
                                    foreach ($tolp_UTJ as $data) {
                                    ?>
                                        <?= $data->nama; ?> | <?= $data->jumlah_record; ?> ||
                                    <?php
                                    }
                                    ?>
                                    "></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">UTJ</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $jum_dipesan;  ?>
                                    <span class="text-warning text-sm font-weight-bolder">Unit</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-3">
                            <div type="button"
                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md btn-tooltip">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-container="body"
                                    data-animation="true" title="
                                    <?php
                                    foreach ($tolp_Sold as $data) {
                                    ?>
                                        <?= $data->nama; ?> | <?= $data->jumlah_record; ?>
                                    <?php
                                    }
                                    ?>">
                                </i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sold Out</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $jum_sold;  ?>
                                    <span class=" text-danger text-sm font-weight-bolder">Unit</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-6">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-3">
                            <div type="button"
                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-container="body" data-animation="true" title="
                                    <?php
                                    foreach ($tolp_DP as $data) {
                                    ?>
                                        <?= $data->nama; ?> | <?= $data->jumlah_record; ?>
                                    <?php
                                    }
                                    ?>
                                "></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sudah DP</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $jum_null;  ?>
                                    <span class="text-success text-sm font-weight-bolder">Unit</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <!-- chart -->
                        <!-- pengembangan fitur baru dalam prosespengerjaan -->
                        <div class="col-lg-6 col-12 ">
                            <div class="card mb-2">
                                <div class="card-body p-1">
                                    <div class="col-lg-12 col-10 mb-0">
                                        <p class="text-sm mb-0 mt-0">
                                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                                            <span class="font-weight-bold ms-1">Transaksi</span> Hampir Melewati
                                            <span class="font-weight-bold ms-0 text-danger">Deadline</span>
                                        </p>
                                    </div>
                                    <div class="card-body px-0 pb-2 mt-0 mb-0 pt-0 pb-0">
                                        <div class="secondaryContainer">
                                            <table class="">
                                                <thead>
                                                    <tr class="">
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                                            Kode Unit
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7  ">
                                                            Transaction
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                                            Progres
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                                            Days
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                                            Hub
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-deadline">

                                                </tbody>
                                            </table>
                                            <div id="load_message"></div>
                                            <!-- <div class="text-center mt-0">
                                                <a href="#" id="down"><i class="fa fa-hand-o-down down-icon"></i></a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- akhir pengembangan fitur baru dalam prosespengerjaan -->
                        <div class="col-lg-6 col-12 ">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="chart">
                                        <canvas id="barChart" class="chart-canvas" height="200px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            foreach ($perumahan as $data) {
                                $id_perum = $data->id_perum;
                        ?>
                        <div class="col-lg-6 col-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <span class="nav-link-text ms-1"><?= $data->nama; ?></span>
                                    <div class="chart">
                                        <canvas id="myChart<?= $data->id_perum; ?>" class="chart-canvas"
                                            height="200px"></canvas>
                                        <?php
                                    foreach ($area_siteplan as $area) :
                                        if ($area->id_perum_siteplan == $id_perum) {
                                            $nama = $data->nama;
                                            $tittle = preg_replace("![^a-z0-9]+!i", "-", $nama);
                                    ?>
                                        <?php if ($ambil->role == 'Admin') : ?>
                                        <a href="<?php echo site_url('Dashboard/detail/' . $tittle); ?>"
                                            class="mask bg-gradient-dark opacity-0"></a>
                                        <?php endif; ?>
                                        <?php
                                        }
                                    endforeach;

                                    $labels = [];
                                    $datasets = [];
                                    foreach ($transaksi as $chart) {
                                        if ($chart->id_perum == $id_perum) {
                                            $index = array_search($chart->bulan, array_column($labels, 'bulan'));
                                            if ($index === false) {
                                                $labels[] = ['bulan' => $chart->bulan];
                                                $index = count($labels) - 1;
                                            }
                                            $datasets[$chart->status_trans][$index] = $chart->jumlah;
                                        }
                                    }

                                    usort($labels, function ($a, $b) {
                                        return strtotime($a['bulan']) - strtotime($b['bulan']);
                                    });
                                    ?>

                                        <script>
                                        window.data_grafik = window.data_grafik || [];

                                        var ctx<?= $data->id_perum; ?> = document.getElementById(
                                            'myChart<?= $data->id_perum; ?>').getContext('2d');

                                        // Ambil dataset dari PHP
                                        window.data_grafik["<?= $data->id_perum ?>"] =
                                            <?php echo json_encode(getChartDataset($data->id_perum, $transaksi)); ?>;

                                        // Inisialisasi Chart.js
                                        var chart = new Chart(ctx<?= $data->id_perum; ?>, {
                                            type: 'bar',
                                            data: {
                                                labels: data_grafik["<?= $data->id_perum ?>"].label,
                                                datasets: data_grafik["<?= $data->id_perum ?>"].data
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true,
                                                            precision: 0, // ✅ angka bulat tanpa koma
                                                            stepSize: 1 // ✅ kelipatan 1
                                                        },
                                                        gridLines: {
                                                            color: 'rgba(200,200,200,0.2)'
                                                        }
                                                    }],
                                                    xAxes: [{
                                                        gridLines: {
                                                            display: false
                                                        }
                                                    }]
                                                },
                                                tooltips: { // ✅ Tooltip custom
                                                    enabled: true,
                                                    mode: 'index',
                                                    intersect: false,
                                                    backgroundColor: 'rgba(0,0,0,0.8)',
                                                    titleFontColor: '#fff',
                                                    bodyFontColor: '#fff',
                                                    cornerRadius: 4,
                                                    callbacks: {
                                                        label: function(tooltipItem, data) {
                                                            const datasetLabel = data.datasets[tooltipItem
                                                                .datasetIndex].label || '';
                                                            const value = tooltipItem.yLabel;
                                                            return datasetLabel + ': ' + value;
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    position: 'top',
                                                    labels: {
                                                        fontSize: 11,
                                                        boxWidth: 12
                                                    }
                                                },
                                                animation: {
                                                    duration: 700
                                                }
                                            }
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                        <!-- akhir chart -->
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- chart rumah ready -->
<script>
var chartData = <?php echo json_encode($ChartData); ?>;
var colors = ['#FFFF00', '#0000FF', '#333333'];
var labels = [];
var data = [];

chartData.forEach(function(item) {
    labels.push(item.label);
    data.push(item.value);
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Rumah Ready',
            data: data,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<!-- data tabel -->
<script>
$(document).ready(function() {

    var limit = 10;
    var start = 0;
    var action = 'inactive';

    function lazy_loader() {
        var output = '';
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 90px;">&nbsp;</span></p>';
        output += '</div>';
        $('#load_message').html(output);
    }

    function load_data(limit, start) {
        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/data_deadline",
            method: "POST",
            data: {
                limit: limit,
                start: start
            },
            cache: false,
            success: function(data) {
                if (data == '') {
                    $('#load_message').html('<h6>&nbsp; &nbsp;Tidak ada data lagi..</h6>');
                    $('#down').hide();
                    action = 'inactive';
                } else {
                    $('#data-deadline').append(data);
                    $('#load_message').html("");
                    action = 'inactive';
                }
            }
        });
    }

    function load_initial_data() {
        lazy_loader();
        load_data(limit, start);
    }

    load_initial_data();

    $(document).on('click', '#down', function() {
        if (action == 'inactive') {
            action = 'active';
            start += limit;
            lazy_loader();
            load_data(limit, start);
        }
    });

});
</script>
<!-- akhir data tabel -->