import './bootstrap';

$(document).ready(function () {
    $('.delete-icon').on('click', function () {
        $(this).closest('form').submit()
    })

    $('.like-icon').on('click', function () {
        $(this).closest('form').submit()
    })

    $('body').on('click', '.is-public-icon', function () {
        let form = $(this).closest('form')
        $(form).find('.bx-spin').removeClass('d-none')
        setTimeout(
            function()
            {
                $(form).submit()
            }, 500);

    })
});
