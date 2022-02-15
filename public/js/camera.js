$(document.body).on('click', '#cam_link', showCamera);
function showCamera() {
    var cam_id = $(this).attr('cam_id'), int;
    $('.m_body').html('<img src="api/netping_camera/' + cam_id + '?' + Math.random() + '" alt="" srcset="">');
    int = setInterval(function () {
        $('.m_body').html('<img src="api/netping_camera/' + cam_id + '?' + Math.random() + '" alt="" srcset="">');
    }, 8000);
   /* $('#cam_popup').on($.modal.OPEN, function (event, modal) {
        setTimeout(function () {
          $.modal.close();
        }, 120000);
    });
    $('#cam_popup').on($.modal.CLOSE, function (event, modal) {
        $('#cam_popup').html('');
        clearInterval(int);
    });*/
    $('#cam_popup').on('hidden.bs.modal', function (e) {
        $('.m_body').html('');
        clearInterval(int);
      })
};
