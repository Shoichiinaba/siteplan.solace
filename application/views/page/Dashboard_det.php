<style>
.bg-dur-sold-out {
    border: dashed 2px red;
    padding: 0px 6px;
    border-radius: 5px;
    font-weight: bold;
    color: #f05151;
}

.border-transaksi {
    border: 2px solid #0000002e;
    padding: 0px 6px;
    border-radius: 5px;
    font-size: x-small;
    font-weight: bold;
}
</style>

<!-- conten -->
<div class="container-fluid py-4">
    <div class="row">
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
                                    "></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
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
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">UTJ</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?=$jum_UTJ; ?>
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
                                    data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sold Out</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?=$jum_sold;  ?>
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
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-9 text-end">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sudah DP</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?=$jum_DP;  ?>
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
            <div class="card-header pb-0">
                <div class="row">
                    <!-- chart -->
                    <div class="col-lg-6 col-12 ">
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="chart">
                                    <canvas id="barChart" class="chart-canvas" height="200px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 ">
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="chart">
                                    <canvas id="myChart" class="chart-canvas" height="200px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12">

                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 mt-2">Information Transaction</h6>
                    </div>
                </div>
                <div class="col-sm-9 col-lg-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text text-body">
                            <i class="ni ni-delivery-fast" aria-hidden="true"></i>
                        </span>
                        <select class="form-control" id="status">
                            <option value=""> &nbsp; Filter</option>
                            <option value="Dipesan"> &nbsp; Dipesan</option>
                            <option value="UTJ"> &nbsp; UTJ</option>
                            <option value="DP"> &nbsp; DP</option>
                            <option value="Sold Out"> &nbsp; Sold Out</option>
                        </select>
                    </div>
                    <br>
                </div>
                <div class="table-responsive">
                    <table id="list-data" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-8">
                                    Kode Unit</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-8">
                                    Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-8">
                                    Transaction</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-8">
                                    Progress doc</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-8">
                                    Duration</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                    Duration<br
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Dari UTJ ke Sold out </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- js script -->
<script>
// grafik transaksi by perumahan by bulan

var transaksi = <?php echo json_encode($transaksi_det); ?>;
var groupedData = {};
transaksi.forEach(function(item) {
    var bulan = item.bulan;
    if (!groupedData[bulan]) {
        groupedData[bulan] = {};
    }
    if (!groupedData[bulan][item.status_trans]) {
        groupedData[bulan][item.status_trans] = 0;
    }
    groupedData[bulan][item.status_trans] += parseInt(item.jumlah);
});

// Membuat array bulan dan array data untuk setiap status_trans
var bulanArray = Object.keys(groupedData);
var datasets = [];
var statusTransArray = Object.keys(transaksi.reduce(function(result, item) {
    result[item.status_trans] = true;
    return result;
}, {}));
statusTransArray.forEach(function(statusTrans) {
    var data = [];
    // Tambahkan variabel warna latar belakang
    var backgroundColor = '';
    if (statusTrans === 'UTJ') {
        backgroundColor = 'red';
    } else if (statusTrans === 'DP') {
        backgroundColor = 'green';
    } else if (statusTrans === 'Sold Out') {
        backgroundColor = 'yellow';
    }
    bulanArray.forEach(function(bulan) {
        data.push(groupedData[bulan][statusTrans] || 0);
    });
    datasets.push({
        label: statusTrans,
        data: data,
        backgroundColor: backgroundColor,
    });
});

// Membuat grafik dengan Chart.js
var ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: bulanArray,
        datasets: datasets,
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    },
});
// akhir grafik transaksi by perumahan by bulan

// grafik rumah ready
var chartData = <?php echo json_encode($Rmh_ready); ?>;
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
// akhir grafik rumah ready

// data tabel
window.crud = $('#list-data').DataTable({
    "paging": true,
    "ordering": true,
    "autoWidth": false,
    "responsive": true,
    processing: true,
    serverSide: true,
    ajax: {
        url: "<?php echo base_url('/Dashboard/data_transaksi') ?>/<?= $this->uri->segment(3)?>",
        data: function(d) {
            d.status = $('#status').val();
        }
    },
    columns: [{
            data: 'code',
            name: 'code'
        }, {
            data: 'type',
            name: 'type'
        }, {
            data: 'transaction',
            name: 'transaction'
        }, {
            data: 'color',
            name: 'color'
        },
        {
            data: 'duration',
            name: 'duration'
        },
        {
            data: 'performance',
            name: 'performance'
        },
    ],
});
$('#status').on('change', function() {
    window.crud.ajax.reload();
});
// akhir data tabel
</script>