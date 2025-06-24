$("#btnCreateWebsite").click(function () {
    $.ajax({
        url: '/api/website/store',
        method: "POST",
        contentType: 'application/json',
        headers: {
            Authorization: 'Bearer ' + getCookie('auth_token')
        },
        data: JSON.stringify({
            name: $('#name').val(),
        }),
        success: function () {
            window.location.href = '/dashboard'
        },
        error: function () {
            alert('Error Create')
        }
    });
});
