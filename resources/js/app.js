import './bootstrap';

$(document).ready(function () {

    window.imagePopup = function () {
        $('.image-link').magnificPopup({
            type: 'image',

            gallery: {
                enabled: true
            },

            image: {
                titleSrc: 'img-title'
            },
        });
    }

    imagePopup()

    $('.images-wrapper').on('click', '.delete-icon', function () {
        $(this).closest('form').submit()
    })

    $('.images-wrapper').on('click', '.like-photo-container', function () {
        let url = $(this).data('url')
        let value = $(this).data('value')

        likePhoto(this, url, value)
    })

    $('.images-wrapper').on('click', '.is-public-container', function () {
        let url = $(this).data('url')
        let value = $(this).data('value')

        setPhotoPublic(this, url, value)
    })

    $('.select2').select2();

    $('.select2').on('change', function () {
        $(this).closest('form').submit()
    })

    function setPhotoPublic(element, url, value) {

        axios.patch(url, {
            is_public: value,
        })
            .then(function (response) {
                let data = response.data

                if (data.result === true) {
                    $(element).find('.is-public-icon').toggleClass('active')
                    $(element).data('value', data.isPublic === false ? 0 : 1)

                    if (typeof currentRouteName !== 'undefined' && currentRouteName === 'main') {
                        $(element).closest('.image').remove();
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function likePhoto(element, url, value) {

        axios.post(url, {
            isLiked: value,
        })
            .then(function (response) {
                let data = response.data

                if (data.result === true) {
                    $(element).data('value', data.isLiked)

                    let likesCountElement = $(element).closest('.like-wrapper').find('.likes-count')
                    let likesCount = $(likesCountElement).html()
                    console.log(likesCount)
                    const iElement = $(element).find('i')

                    if ($(iElement).hasClass("bxs-heart")) {
                        $(likesCountElement).html(parseInt(likesCount) - 1)
                        $(iElement).removeClass("bxs-heart")
                        $(iElement).addClass("bx-heart")
                    } else {
                        $(likesCountElement).html(parseInt(likesCount) + 1)
                        $(iElement).removeClass("bx-heart")
                        $(iElement).addClass("bxs-heart")
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }


    // $.ajax({
    //     url: photoLikeRoute,
    //     data: {isLiked: isLiked},
    //     dataType: 'json',
    //     method: 'post',
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function (response) {
    //         if (response.result === true) {
    //             if ($(element).hasClass("bxs-heart")) {
    //                 $(isLikedElement).val('1')
    //                 $(likesCountElement).html(parseInt(likesCount) - 1)
    //                 $(element).removeClass("bxs-heart")
    //                 $(element).addClass("bx-heart")
    //             } else {
    //                 $(isLikedElement).val('0')
    //                 $(likesCountElement).html(parseInt(likesCount) + 1)
    //                 $(element).removeClass("bx-heart")
    //                 $(element).addClass("bxs-heart")
    //             }
    //         }
    //     }
    // })
// }
})
// ;
