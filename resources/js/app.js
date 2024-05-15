import './bootstrap';

$(document).ready(function () {

    $('.images-wrapper').on('click', '.delete-icon', function () {
        $(this).closest('form').submit()
    })

    $('.images-wrapper').on('click', '.like-icon', function () {
        likePhoto(this)
    })

    $('.images-wrapper').on('click', '.is-public-icon', function () {
        let form = $(this).closest('form')
        $(form).find('.bx-spin').removeClass('d-none')
        setTimeout(
            function () {
                $(form).submit()
            }, 500);

    })

    $('.select2').select2();

    $('.select2').on('change', function () {
        $(this).closest('form').submit()
    })

    function likePhoto(element) {
        var photoLikeRoute = $(element).find('.photo-like-route').val()

        var isLikedElement = $(element).find('.is-liked')
        var isLiked = $(isLikedElement).val()

        var likesCountElement = $(element).closest('div').find('.likes-count')
        var likesCount = $(likesCountElement).html()

        $.ajax({
            url: photoLikeRoute,
            data: {isLiked: isLiked},
            dataType: 'json',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.result === true) {
                    if ($(element).hasClass("bxs-heart")) {
                        $(isLikedElement).val('1')
                        $(likesCountElement).html(parseInt(likesCount) - 1)
                        $(element).removeClass("bxs-heart")
                        $(element).addClass("bx-heart")
                    } else {
                        $(isLikedElement).val('0')
                        $(likesCountElement).html(parseInt(likesCount) + 1)
                        $(element).removeClass("bx-heart")
                        $(element).addClass("bxs-heart")
                    }
                }
            }
        })
    }
});
