$(document.body).on('click', '#cam_link', showCamera);
function showCamera() {
    var cam_id = $(this).attr('cam_id'), int;
    $('#cam_popup').html('Загружаю...');
    $('#cam_popup').html('<img src="api/netping_camera/' + cam_id + '?' + Math.random() + '" alt="" srcset="">');
    int = setInterval(function () {
        $('#cam_popup').html('Обновляю...');
        $('#cam_popup').html('<img src="api/netping_camera/' + cam_id + '?' + Math.random() + '" alt="" srcset="">')
    }, 8000);
    $('#cam_popup').on($.modal.OPEN, function (event, modal) {
        setTimeout(function () {
          $.modal.close();
        }, 120000);
    });
    $('#cam_popup').on($.modal.CLOSE, function (event, modal) {
        $('#cam_popup').html('');
        clearInterval(int);
    });
};

