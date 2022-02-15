$(document).ready(function () {
    $('.filter-switch').click(function () {
        $('.filters').slideToggle(300, function () {
            if ($(this).is(':hidden')) {
                $('.filter-switch').html('Показать фильтры');
            } else {
                $('.filter-switch').html('Скрыть фильтры');
            }
        });
        return false;
    });

    var table = $('#log_table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
        },
        "order": [[ 0, "desc" ]]
    });
    $('.dataTables_length').addClass('px-4 py-5 sm:p-6');

    $('#netping_sort').on('change', function (e) {
        var status = $(this).val();
        table.column(3).search(status).draw();
    })
    $('#user_sort').on('change', function (e) {
        var status = $(this).val();
        table.column(1).search(status).draw();
    })

    $('#dates').on('apply.daterangepicker', function (ev, picker) {
        var start = picker.startDate.format("YYYY-MM-DD");
        var end = picker.endDate.format("YYYY-MM-DD");

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = start;
                var max = end;
                var startDate = moment(new Date(data[0])).format("YYYY-MM-DD");

                if (min == null && max == null) {
                    return true;
                }
                if (min == null && startDate <= max) {
                    return true;
                }
                if (max == null && startDate >= min) {
                    return true;
                }
                if (startDate <= max && startDate >= min) {
                    return true;
                }
                return false;
            }
        );
        table.draw();
        $.fn.dataTable.ext.search.pop();

    });
});

