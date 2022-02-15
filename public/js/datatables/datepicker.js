$('#dates').daterangepicker({
    "showDropdowns": true,
    "locale": {
        "format": "MM.DD.YYYY",
        "separator": " - ",
        "applyLabel": "ОК",
        "cancelLabel": "Отменить",
        "fromLabel": "С",
        "toLabel": "По",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    },
    /*"startDate": "09/02/2021",
    "endDate": "09/08/2021"*/
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});
