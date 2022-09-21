$(document).ready(function () {
    powerState();
    doorState();
    alarmState();
    netpingState();
});
function doorState() {
    $('.door_state').each(function (index, value) {
        var that = $(this);
        var id = that.attr('data');
        that.html('Обновляю...')
        $.ajax({
            async: true,
            url: 'api/door/' + id,
            success: function (door_data) {
                switch (door_data) {
                    case '0':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'Закрыта';
                        var state_color = 'green';
                        break;
                    case '1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'Открыта!';
                        var state_color = 'red';
                        break;
                    case '3':
                        if (!that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').addClass('bg-red-400');
                        }
                        var text = 'N/A';
                        var state_color = 'gray';
                        break;
                }
                that.html('<span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Дверь</span><span class="rounded bg-' + state_color + '-400 py-1 px-3 text-xs font-bold">' + text + '</span></td>');
            }
        })
    });

}

function alarmState() {
    $('.alarm_state').each(function (index, value) {
        var that = $(this);
        var id = that.attr('data');
        that.html('Обновляю...');
        $.ajax({
            async: true,
            url: 'api/alarm/' + id,
            success: function (alarm_data) {
            if(alarm_data.revision == 2)
            {
                switch (alarm_data.alarm_state[0]) {
                    case '0':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'ALARM!!!';
                        var state_color = 'red';
                        break;
                    case '1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'Отключена';
                        var state_color = 'green';
                        break;
                    case '3':
                        if (!that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').addClass('bg-red-400');
                        }
                        var text = 'N/A';
                        var state_color = 'gray';
                        break;
                }
            } else if (alarm_data.revision == 4)
            {
                switch (alarm_data.alarm_state[0]) {
                    case '1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'ALARM!!!';
                        var state_color = 'red';
                        break;
                    case '0':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        var text = 'Отключена';
                        var state_color = 'green';
                        break;
                    case '3':
                        if (!that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').addClass('bg-red-400');
                        }
                        var text = 'N/A';
                        var state_color = 'gray';
                        break;
                }
            }
                that.html('<span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Сирена</span><span class="rounded bg-' + state_color + '-400 py-1 px-3 text-xs font-bold">' + text + '</span></td>');
            }

        })
    });

}
function powerState() {
    $('.power_state').each(function (index, value) {
        var that = $(this);
        var id = that.attr('data');
        var text;
        var state_color;
        that.html('Обновляю...');
        $.ajax({
            async: true,
            url: 'api/power/' + id,
            success: function (power_data) {
               switch(power_data)
                {
                    case '0':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text = '220V ON';
                        state_color = 'green';
                        break;
                    case '1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text = '220V OFF';
                        state_color = 'red';
                        break;
                    case '3':
                            if (!that.closest('tr').hasClass('bg-red-400')) {
                                that.closest('tr').addClass('bg-red-400');
                            }
                            var text = 'N/A';
                            var state_color = 'gray';
                            break;
                }
                that.html('<span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Питание</span><span class="rounded bg-' + state_color + '-400 py-1 px-3 text-xs font-bold">' + text + '</span></td>');
            }
        })
    });

}

function netpingState() {
    $('.netping_state').each(function (index, value) {
        var that = $(this);
        var id = that.attr('data');
        var text_span;
        var text_link;
        var state_color;
        that.html('Обновляю...');
        $.ajax({
            async: true,
            url: 'api/secure/' + id,
            success: function (netping_data) {
                console.log(netping_data.secure_state[0]);
            if (netping_data.revision == 2)
            {
                switch(netping_data.secure_state)
                {
                    case 'direction:2':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text_span = 'Включена'
                        text_link = 'Снять с охраны';
                        state_color = 'green';
                        break;
                    case 'direction:1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text_span = 'Отключена'
                        text_link = 'Поставить на охрану';
                        state_color = 'yellow';
                        break;
                    case '3':
                            if (!that.closest('tr').hasClass('bg-red-400')) {
                                that.closest('tr').addClass('bg-red-400');
                            }
                            text_span = 'N/A';
                            text_link = 'Точка недоступна';
                            state_color = 'gray';
                            break;
                }
            } else if (netping_data.revision == 4)
            {
                switch(netping_data.secure_state[0])
                {
                    case '1':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text_span = 'Включена'
                        text_link = 'Снять с охраны';
                        state_color = 'green';
                        break;
                    case '0':
                        if (that.closest('tr').hasClass('bg-red-400')) {
                            that.closest('tr').removeClass('bg-red-400');
                        }
                        text_span = 'Отключена'
                        text_link = 'Поставить на охрану';
                        state_color = 'yellow';
                        break;
                    case '3':
                            if (!that.closest('tr').hasClass('bg-red-400')) {
                                that.closest('tr').addClass('bg-red-400');
                            }
                            text_span = 'N/A';
                            text_link = 'Точка недоступна';
                            state_color = 'gray';
                            break;
                }
            }

                that.html('<span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Охрана</span><span id="alarm_span' + id +'" class="rounded bg-' + state_color + '-400 py-1 px-3 text-xs font-bold">' + text_span + '</span></td>');
                $('#act_link' + id).text(text_link);
            }
        })
    });

}

$(document.body).on('click', '.netping_action', alarmControl);
function alarmControl()
{
    var that = $(this);
    var id = that.attr('data-id');
    var text_span;
    var text_link;
    $.ajax({
        async: true,
        url: 'api/alarm/set/' + id,
        success: function (state) {
            switch (state)
            {
                case '3':
                    toastr.error("Точка недоступна!"); break;
                case 'Снята с охраны':
                    $('#alarm_span' + id).removeClass('bg-green-400');
                    $('#alarm_span' + id).addClass('bg-yellow-400');
                    text_span = 'Отключена'
                    text_link = 'Поставить на охрану';
                    toastr.success(state); break;
                case 'Поставлена на охрану':
                    $('#alarm_span' + id).removeClass('bg-yellow-400');
                    $('#alarm_span' + id).addClass('bg-green-400');
                    text_span = 'Включена'
                    text_link = 'Снять с охраны';
                    toastr.warning(state); break;
            }
            $('#alarm_span' + id).text(text_span);
            $('#act_link' + id).text(text_link);

        }
    });

    return false; //чтобы не скроллило вверх страницы на моб версии

}

setInterval(powerState, 20000);
setInterval(netpingState, 20000);
setInterval(doorState, 20000);
setInterval(alarmState, 20000);
