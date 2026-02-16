<style>
/* btn hover */
.btn-detail-hover {
    background-color: #0d6efd;
    border: none;
    color: #fff;
    text-transform: none;
    transition: all .3s ease;
}

.btn-detail-hover:hover {
    background-color: #cc0c9f !important;
    color: #fff;
}

.btn-detail-hover:active {
    transform: scale(0.97);
}

/* progress bar */
.progress {
    height: 15px;
}

.progress-container {
    position: relative;
}

.progress-bar {
    display: flex;
    height: 100px;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
    color: #fff;
}

.progress-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 12px;
    font-weight: bold;
    color: #000;
    /* biar selalu kelihatan */
}

/* card hover */
.card-hover {
    transition: all .3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* easy loader */
/* Placeholder animation */
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

.content-placeholder {
    display: inline-block;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
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
    position: relative;
    border-radius: 5px;
}

/* Placeholder Container */
.post_data {
    padding: 16px;
    border: 1px solid #f0f0f0;
    border-radius: 10px;
    margin-bottom: 24px;
    background-color: #fff;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

.rounded-bottom-4 {
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
}

.alert-primary,
.alert-primary i {
    color: #fff !important;
}
</style>

<div class="container-fluid py-4">
    <div class="row" id="load_data">
        <div id="load_data_message"></div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5" id="load_data">
    </div>
    <div id="load_data_message"></div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                <li class="page-item prev">
                    <a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item next">
                    <a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>


<script>
$(document).ready(function() {
    var limit = 12;
    var start = 0;
    var action = 'inactive';
    var total_pages = 1;

    function lazzy_loader(limit) {
        var output = '<div class="row">';
        for (var count = 0; count < limit; count++) {
            output += '<div class="col-lg-4 mb-4">';
            output += '<div class="card shadow-lg post_data" style="padding: 20px;">';
            output += '<div class="d-flex align-items-end row">';

            // Placeholder untuk bagian teks
            output += '<div class="col-sm-7 col-lg-7">';
            output += '<div class="card-body pt-0 mt-0">';
            output +=
                '<div class="content-placeholder title-placeholder" style="height: 20px; width: 150px; margin-bottom: 10px;">&nbsp;</div>';
            output +=
                '<div class="content-placeholder sub-title-placeholder" style="height: 15px; width: 100px; margin-bottom: 10px;">&nbsp;</div>';
            output +=
                '<div class="content-placeholder details-placeholder" style="height: 15px; width: 120px; margin-bottom: 10px;">&nbsp;</div>';
            output +=
                '<div class="content-placeholder details-placeholder" style="height: 15px; width: 150px; margin-bottom: 10px;">&nbsp;</div>';
            output +=
                '<div class="content-placeholder details-placeholder" style="height: 15px; width: 120px; margin-bottom: 10px;">&nbsp;</div>';
            output += '</div>';
            output += '</div>';

            // Placeholder untuk bagian gambar
            output += '<div class="col-sm-5 col-lg-5 text-end text-sm-left">';
            output += '<div class="card-body pb-0 px-0 px-md-4 pt-0">';
            output +=
                '<div class="content-placeholder image-placeholder" style="height: 105px; width: 105px; border-radius: 50%;">&nbsp;</div>';
            output += '</div>';
            output += '</div>';

            output += '</div>';
            output += '</div>';
            output += '</div>';
        }
        output += '</div>'; // End row
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Progres_pembangunan/fetch_unit",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                var response = JSON.parse(data);
                $('#load_data').html('');
                if (response.data.trim() === '') {
                    $('#load_data_message').html(
                        '<div class="alert alert-primary alert-dismissible text-white" role="alert">' +
                        '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>' +
                        '<i class="fa fa-folder-open"></i> Belum ada Unit yang deal...' +
                        '</div>'
                    );
                    action = 'active';
                } else {
                    if (start === 0) {
                        $('#load_data').html(response.data);
                    } else {
                        $('#load_data').append(response.data);
                    }
                    $('#load_data_message').html("");
                    action = 'inactive';
                    total_pages = response.total_pages;
                    update_pagination();
                }
            }
        });
    }

    function update_pagination() {
        var paginationHtml =
            '<li class="page-item prev"><a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-left"></i></a></li>';

        for (var i = 1; i <= total_pages; i++) {
            paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
                '"><a class="page-link" href="javascript:void(0);">' + i + '</a></li>';
        }

        paginationHtml +=
            '<li class="page-item next"><a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-right"></i></a></li>';

        $('.pagination').html(paginationHtml);
    }

    $('.pagination').on('click', '.page-item', function() {
        if ($(this).hasClass('prev')) {
            if (start >= limit) {
                start -= limit;
                load_data(limit, start, $('#search-agent').val());
            }
        } else if ($(this).hasClass('next')) {
            if (start + limit < total_pages * limit) {
                start += limit;
                load_data(limit, start, $('#search-agent').val());
            }
        } else {
            var page = parseInt($(this).find('.page-link').text());
            start = (page - 1) * limit;
            load_data(limit, start, $('#search-agent').val());
        }
    });

    load_data(limit, start);

    $('#search-agent').on('input', function() {
        var search = $(this).val();
        $('#load_data').html('');
        start = 0;
        lazzy_loader(limit);
        load_data(limit, start, search);
    });
});

// Fungsi untuk memuat ulang data
var baseUrl = "<?php echo base_url(); ?>";
var limit = 12;
var start = 0;
var total_pages = 0;

function reloadAgentData() {
    var search = $('#search-reels').val();

    $.ajax({
        url: baseUrl + "Progres_pembangunan/fetch_unit",
        method: "POST",
        data: {
            limit: limit,
            start: start,
            search: search
        },
        cache: false,
        success: function(data) {
            var response = JSON.parse(data);
            $('#load_data').html('');
            if (response.data.trim() === '') {
                $('#load_data_message').html(
                    '<div class="alert alert-primary alert-dismissible" role="alert">' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '<i class="fa fa-folder-open"></i> Data Agent Tidak Ditemukan...</div>'
                );
                action = 'active';
            } else {
                if (start === 0) {
                    $('#load_data').html(response.data);
                } else {
                    $('#load_data').append(response.data);
                }
                $('#load_data_message').html("");
                action = 'inactive';
                total_pages = response.total_pages;
                update_pagination();
            }
        }
    });
}

// Fungsi untuk update pagination
function update_pagination() {
    if (total_pages === 0) {
        return;
    }

    var paginationHtml =
        '<li class="page-item prev"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + Math
        .max(
            start - limit, 0) + ');"><i class="fa-solid fa-angle-left"></i></a></li>';

    for (var i = 1; i <= total_pages; i++) {
        paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
            '"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + (i - 1) * limit + ');">' +
            i +
            '</a></li>';
    }

    paginationHtml +=
        '<li class="page-item next"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + Math
        .min(
            start + limit, (total_pages - 1) * limit) + ');"><i class="fa-solid fa-angle-right"></i></a></li>';

    $('.pagination').html(paginationHtml);
}

function changePage(newStart) {
    if (newStart < 0 || newStart >= total_pages * limit) {
        return;
    }
    start = newStart;
    reloadAgentData();
}

$(document).ready(function() {
    reloadAgentData();
});
</script>