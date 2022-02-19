$(document.body).on("click", ".clear-caches", clear);
$(document.body).on("click", ".simlink", makeSimlink);

function clear()
{
    $.ajax({
        url: '/dashboard/artisan/clear',
        success: function(response) {
            toastr.success(response)
        }
    })
}

function makeSimlink()
{
    $.ajax({
        url: '/dashboard/artisan/simlink',
        success: function(response) {
            toastr.success(response)
        }
    })
}
