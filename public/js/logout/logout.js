$("#btnLogout").click(function () {
    $.ajax({
        url: '/api/logout',
        method: 'POST',
        headers: {
            Authorization: 'Bearer ' + getCookie('auth_token')
        },
        success: function () {
            window.location.href = "/login"
        },
        error: function () {
            alert("Error-LOGOUT");
        }
    });
});
