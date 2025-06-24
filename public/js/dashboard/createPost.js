$(document).on('auth-checked', function () {
    let id;
    $.ajax({
        method: "GET",
        headers: {
            Authorization: "Bearer " + getCookie('auth_token')
        },
        url: $('#create-post').data('getWebsiteDataUrl'),
        success: function (response) {
            $('#container').removeClass('d-none')
            id = response.data.id
            console.log(id)
        },
        error: function (xhr) {
            alert(JSON.parse(xhr.responseText).message)
            window.location.href = '/dashboard';
        }
    });
    $("#createPost").click(function () {
        $.ajax({
            url: '/api/post/store',
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                name: $('#name').val(),
                website_id: id,
                title: $('#title').val(),
            }),
            success: function () {
                window.location.href = "/dashboard"
            },
            error: function (xhr) {
                console.error(xhr.status);
                console.error(xhr.responseJSON);

            },

        });
    });


});
