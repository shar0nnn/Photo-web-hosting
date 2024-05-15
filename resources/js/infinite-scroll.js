$(document).ready(function () {

    function checkData() {
        if ($(window).scrollTop() + 10 >= $(document).height() - $(window).height()) {
            fetchData();
        }
    }

    checkData();

    $(window).scroll(function () {
        checkData();
    });

    function fetchData() {
        var start = Number($('#start').val());
        var allPhotos = Number($('#all-photos').val());
        var photosPerPage = Number($('#photos-per-page').val());
        var routeScroll = $('#route-scroll').val();
        var groupId = $('#group').val();
        var isPublic = $('#is-public').val();
        var userId = $('#user-id').val();

        start = start + photosPerPage;

        if (start <= allPhotos) {
            $('#start').val(start)

            $.ajax({
                url: routeScroll,
                data: {start: start, group: groupId, isPublic: isPublic, userId: userId},
                dataType: 'json',
                success: function (response) {
                    if (response.result === true) {
                        $(".image:last").after(response.data).show().fadeIn("slow");
                    }
                }
            })
        }
    }
});
