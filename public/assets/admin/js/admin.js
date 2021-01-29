"use strict";

function successAlert(msg, title = null) {
    $.notify({
        title: title ?? 'Success',
        icon: 'fas fa-grin',
        message: msg,
    },{
        type: "success",
        z_index: 1100,
    });
}

function errorAlert(msg, title = null) {
    $.notify({
        title: title ?? 'Oops',
        icon: 'fas fa-grin-tears',
        message: msg,
    },{
        type: "danger",
        z_index: 1100,
    });
}


if (window.active_page !== undefined && window.active_page !== "") {
    console.log(window.active_page)
    $(".nav-item." + window.active_page).addClass('active')
}

$(function () {
    $('body').tooltip({ selector: '[data-toggle="tooltip"]' });
    $('.autocomplete-off').on('focus', function () {
        this.setAttribute('autocomplete', 'new-password');
    })
})
