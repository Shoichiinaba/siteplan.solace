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

    function update_pagination() {
        var paginationHtml =
            '<li class="page-item prev"><a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a></li>';

        for (var i = 1; i <= total_pages; i++) {
            paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
                '"><a class="page-link" href="javascript:void(0);">' + i + '</a></li>';
        }

        paginationHtml +=
            '<li class="page-item next"><a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a></li>';

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
            start - limit, 0) + ');"><i class="tf-icon bx bx-chevrons-left"></i></a></li>';

    for (var i = 1; i <= total_pages; i++) {
        paginationHtml += '<li class="page-item ' + (i === (start / limit) + 1 ? 'active' : '') +
            '"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + (i - 1) * limit + ');">' +
            i +
            '</a></li>';
    }

    paginationHtml +=
        '<li class="page-item next"><a class="page-link" href="javascript:void(0);" onclick="changePage(' + Math
        .min(
            start + limit, (total_pages - 1) * limit) + ');"><i class="tf-icon bx bx-chevrons-right"></i></a></li>';

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