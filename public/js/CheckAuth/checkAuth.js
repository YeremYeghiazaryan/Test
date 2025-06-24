function getCookie(name) {
    let cookies = document.cookie.split(';');
    for (let c of cookies) {
        let [key, value] = c.trim().split('=');
        if (key === name) return decodeURIComponent(value);
    }
    return null;
}

$.ajax({
    method: "GET",
    headers: {
        Authorization: "Bearer " + getCookie('auth_token')
    },
    url: '/api/authenticate',
    success: function (response) {
        if (response.user) {
            window.user = response.user;
            $('body').removeClass('d-none');
            $(document).trigger('auth-checked');
        } else {
            window.location.href = '/login';
        }
    },
    error: function (xhr) {
        console.log(JSON.parse(xhr.responseText).message)
    }
});

