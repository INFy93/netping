$(document).ready(function () {
    $("#update_info").submit(function (e) {
        e.preventDefault();
    });
});

$(document.body).on('click', '#save', saveData);

function saveData() {
    let id = $(this).attr('data-user-id');
    let name = $('#name').val();
    let email = $('#email').val();
    let is_emailed = $('#order_email').is(":checked") == true ? 1 : 0;
    let _token = $('meta[name="csrf-token"]').attr('content');

    /* some checks... */
    if (name == '' || email == '') {
        if (!$('.info_field').hasClass('text-red-400')) {
            $('.info_field').addClass('text-red-400')
        }
        if ($('.info_field').css('display') == 'none') {
            $('.info_field').css('display', 'block');
        }
        $('.info_field').text('Заполнены не все поля!');
        $('.info_field').fadeOut(2500);
    } else {
        if ($('.info_field').css('display') == 'none') {
            $('.info_field').css('display', 'block');
        }
        $('.info_field').html('<img style="width:32px;" src="/storage/img/load.svg">');
        $.ajax({
            url: "profile/update_user_info",
            type: "POST",
            data: {
                user_id: id,
                name: name,
                email: email,
                is_emailed: is_emailed,
                _token: _token
            },
            success: function (response) {
                $('#name').attr('value', response.name);
                $('#email').attr('value', response.email);
                if (!$('.info_field').hasClass('text-green-400')) {
                    $('.info_field').addClass('text-green-400')
                }
                $('.info_field').text('Данные обновлены');
                setTimeout(function () {
                    $('.info_field').fadeOut(2000)
                }, 1500);
            }
        });
    }
}
