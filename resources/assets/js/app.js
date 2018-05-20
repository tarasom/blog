/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var csrf = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': csrf
    },
    error: function (xhr) {
        if (422 == xhr.status) {
            handleValidationErrors(xhr);
        } else {
            var message = 'undefined' === typeof xhr.responseJSON.message
                ? 'Something went wrong'
                : xhr.responseJSON.message;

            alert(message);
        }
    }
})


function handleValidationErrors(response) {
    $('.has-error').removeClass('has-error');

    for (var key in response.responseJSON.errors) {
        var keyParts = key.split('.');
        var normalizedKey = keyParts.shift() + keyParts.map(function (item) {
            return '[' + item + ']';
        }).join('');

        $('*[name="' + normalizedKey + '"]').parents('div.form-group').addClass('has-error');
    }
}
