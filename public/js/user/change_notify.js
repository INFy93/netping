$(document.body).on('click', '.email_span', changeNotify);

function changeNotify()
{
    let that = $(this);
    let id = that.attr('user-id');

    $.ajax({
        url: "/dashboard/user/changeNotify/" + id,
        type: "GET",
        success: function (response) {
           console.log(response);
           that.text(response.text);
           $('#emailed_text-' + id).text(response.tooltip_text);
           toastr.info(response.message);
           that.removeClass(response.old_class);
           that.addClass(response.class);
        }
    });
}
