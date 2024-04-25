import './bootstrap';

$(document).ready(function () {
    $('.delete-icon').on('click', function () {
        $(this).closest('form').submit()
    })

    $('.like-icon').on('click', function () {
        $(this).closest('form').submit()
    })

    $('.is-public-icon').on('click', function () {
        let form = $(this).closest('form')
        $(form).find('.bx-spin').removeClass('d-none')
        setTimeout(
            function()
            {
                $(form).submit()
            }, 500);

    })
});
