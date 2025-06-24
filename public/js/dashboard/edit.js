$(document).on('auth-checked', function () {
    let id;
    $.ajax({
        method: "GET",
        headers: {
            Authorization: "Bearer " + getCookie('auth_token')
        },
        url: $('#website-edit-form').data('getWebsiteDataUrl'),
        success: function (response) {
            $('#container').removeClass('d-none')
            $('#name').val(response.data.name);
            id = response.data.id
        },
        error: function (xhr) {
            alert(JSON.parse(xhr.responseText).message)
            window.location.href = '/dashboard';
        }
    });

    $("#btnUpdateWebsite").click(function () {
        $.ajax({
            url: '/api/website/update',
            method: "POST",
            contentType: 'application/json',
            headers: {
                Authorization: 'Bearer ' + getCookie('auth_token')
            },
            data: JSON.stringify({
                name: $('#name').val(),
                id: id,
            }),
            success: function () {
                window.location.href = '/dashboard'
            },
            error: function () {
                alert('Error Update')
            }
        });
    });
});
