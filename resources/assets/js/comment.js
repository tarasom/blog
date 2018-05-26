$(document).ready(function () {

    $('#leave-comment-form').on('submit', function (e) {
        e.preventDefault();

        const url = e.target.getAttribute('action');
        const method = e.target.getAttribute('method');

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (result) {
                $('.text-danger').removeClass('text-danger');
                $('.is-invalid').removeClass('is-invalid');

                $('span.has-error').remove();

                alert('Your comment has been added successfully');

                location.reload();
            }
        });
    })

});